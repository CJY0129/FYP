<?php

include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve movie details from the form
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];
    $synopsis = $_POST['synopsis'];
    $duration = $_POST['duration'];
    $releaseDate = $_POST['release_date'];

    // Check if a file was uploaded
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        // Retrieve file details
        $fileTmpName = $_FILES['poster']['tmp_name'];
        $fileName = $_FILES['poster']['name'];

        // Read file content
        $fp = fopen($fileTmpName, 'rb');
        $posterData = fread($fp, filesize($fileTmpName));
        fclose($fp);

        // Escape special characters to prevent SQL injection
        $posterData = mysqli_real_escape_string($conn, $posterData);

        // Insert movie details into the database, including the poster data
        $insertQuery = "INSERT INTO movie (title, genre, director, cast, synopsis, duration, release_date, poster_path) 
                        VALUES ('$title', '$genre', '$director', '$cast', '$synopsis', '$duration', '$releaseDate', '$posterData')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            header("location: home.php?show=movie&success=1");
            exit();
        } else {
            header("location: home.php?show=movie&error=1");
            exit();
        }
    } else {
        // Insert movie details into the database without the poster data
        $insertQuery = "INSERT INTO movie (title, genre, director, cast, synopsis, duration, release_date) 
                        VALUES ('$title', '$genre', '$director', '$cast', '$synopsis', '$duration', '$releaseDate')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            header("location: home.php?show=movie&success=4");
            exit();
        } else {
            header("location: home.php?show=movie&error=4");
            exit();
        }
    }
} 

// Close the database connection
mysqli_close($conn);
?>