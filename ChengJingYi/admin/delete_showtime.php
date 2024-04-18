<?php
if(isset($_GET['show_id'])) {
    include("connect.php");

    $show_id = $_GET['show_id'];
    $sql = "DELETE FROM showtime WHERE show_id = $show_id";

    if(mysqli_query($conn, $sql)) {

        header("location:home.php?show=showtime&success=2");
        exit();
    } else {

        header("location:home.php?show=showtime&error=2");
        exit();
    }


    mysqli_close($conn);
} 
?>
