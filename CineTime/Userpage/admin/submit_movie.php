<?php

include("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve movie details from the form
    $title = $_POST['title'];
    $status = $_POST['status'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];
    $synopsis = $_POST['synopsis'];
    $duration = $_POST['duration'];
    $trailers_path = $_POST['trailers_path'];    
    $releaseDate = $_POST['release_date'];

    // Check if a file was uploaded
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        // Validate file type and size (optional but recommended)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2 MB

        if (!in_array($_FILES['poster']['type'], $allowedTypes)) {
            header("location: home.php?show=movie&error=Invalid file type");
            exit();
        }

        if ($_FILES['poster']['size'] > $maxFileSize) {
            header("location: home.php?show=movie&error=File size exceeds limit");
            exit();
        }

        // Retrieve file details
        $fileTmpName = $_FILES['poster']['tmp_name'];
        $fileName = $_FILES['poster']['name'];

        // Read file content
        $fp = fopen($fileTmpName, 'rb');
        $posterData = fread($fp, filesize($fileTmpName));
        fclose($fp);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO movie (title, status, genre, director, cast, synopsis, duration, release_date, poster_path, trailers_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssss', $title, $status, $genre, $director, $cast, $synopsis, $duration, $releaseDate, $posterData, $trailers_path);

        if ($stmt->execute()) {
            header("location: home.php?show=movie&success=1");
            exit();
        } else {
            header("location: home.php?show=movie&error=Database error");
            exit();
        }

        $stmt->close();
    } else {
        header("location: home.php?show=movie&error=File upload error");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
