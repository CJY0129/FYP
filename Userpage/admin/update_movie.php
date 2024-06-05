<?php
include("connect.php");
session_start();
if ($_SESSION['m']==1) {
    $movie = "movie";
} elseif ($_SESSION['m']==2) {
    $movie = "csmovie";
} elseif ($_SESSION['m']==3) {
    $movie = "ucmovie";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movieId = $_POST['movie_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $cast = $_POST['cast'];
    $synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']); // Escape the value of the synopsis variable
    $duration = $_POST['duration'];
    $releaseDate = $_POST['release_date'];
    $trailers_path = $_POST['trailers_path'];

    // Check if a file was uploaded
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $posterData = file_get_contents($_FILES['poster']['tmp_name']);
        $posterData = mysqli_real_escape_string($conn, $posterData);
        $posterQuery = "UPDATE $movie SET title='$title', genre='$genre', director='$director', cast='$cast', synopsis='$synopsis', duration='$duration', release_date='$releaseDate', poster_path='$posterData',trailers_path='$trailers_path' WHERE movie_id=$movieId";
    } else {
        // Update query without poster update
        $posterQuery = "UPDATE $movie SET title='$title', genre='$genre', director='$director', cast='$cast', synopsis='$synopsis', duration='$duration', release_date='$releaseDate', trailers_path='$trailers_path' WHERE movie_id=$movieId";
    }

    // Execute the update query
    $updateResult = mysqli_query($conn, $posterQuery);

    // Check if the update was successful
    if ($updateResult) {
        header("location:home.php?show=$movie&success=2");
        exit();
    } else {
        header("location:home.php?show=$movie&error=2");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
