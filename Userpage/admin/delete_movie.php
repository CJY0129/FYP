<?php
session_start();

if(isset($_GET['movie_id'])) {
    include("connect.php");

    $movie_id = $_GET['movie_id'];

        if ($_SESSION['m']==1) {
            $sql = "DELETE FROM movie WHERE movie_id = $movie_id";
            if(mysqli_query($conn, $sql)) {
                header("location:home.php?show=movie&success=3");
                exit();
            } else {
                header("location:home.php?show=movie&error=3");
                exit();
            }
        } elseif ($_SESSION['m']==2) {
            $sql = "DELETE FROM csmovie WHERE movie_id = $movie_id";
            if(mysqli_query($conn, $sql)) {
                header("location:home.php?show=csmovie&success=3");
                exit();
            } else {
                header("location:home.php?show=csmovie&error=3");
                exit();
            }
        } elseif ($_SESSION['m']==3) {
            $sql = "DELETE FROM ucmovie WHERE movie_id = $movie_id";
            if(mysqli_query($conn, $sql)) {
                header("location:home.php?show=ucmovie&success=3");
                exit();
            } else {
                header("location:home.php?show=ucmovie&error=3");
                exit();
            }
        }

        
     mysqli_close($conn);

} 
?>
