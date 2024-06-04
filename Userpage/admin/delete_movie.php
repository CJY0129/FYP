<?php
if(isset($_GET['movie_id'])) {
    include("connect.php");

    $movie_id = $_GET['movie_id'];

  
        $sql = "DELETE FROM movie WHERE movie_id = $movie_id";

        if(mysqli_query($conn, $sql)) {
            header("location:home.php?show=movie&success=3");
            exit();
        } else {
            header("location:home.php?show=movie&error=3");
            exit();
        }
    

    mysqli_close($conn);
} 
?>
