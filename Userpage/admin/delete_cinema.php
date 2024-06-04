<?php
if (isset($_GET['cinema_id'])) {
    include("connect.php");

    $cinema_id = (int) $_GET['cinema_id'];

    // Delete cinema from the database
    $deleteQuery = "DELETE FROM cinema WHERE cinema_id=$cinema_id";

    if (mysqli_query($conn, $deleteQuery)) {
        header("location: home.php?show=cinema&success=3");
        exit();
    } else {
        header("location: home.php?show=cinema&error=3");
        exit();
    }

    mysqli_close($conn);
}
?>
