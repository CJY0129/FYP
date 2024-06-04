<?php
if (isset($_GET['hall_id'])) {
    include("connect.php");

    $hall_id = (int) $_GET['hall_id'];

    // Delete hall from the database
    $deleteQuery = "DELETE FROM hall WHERE hall_id=$hall_id";

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
