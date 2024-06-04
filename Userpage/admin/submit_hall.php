<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve hall details from the form
    $cinema_id = (int) $_POST['cinema_id'];
    $hall_num = (int) $_POST['hall_num'];
    $number_of_seat = (int) $_POST['number_of_seat'];

    // Insert hall details into the database
    $insertQuery = "INSERT INTO hall (cinema_id, hall_num, number_of_seat) 
                    VALUES ($cinema_id, $hall_num, $number_of_seat)";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        header("location: home.php?show=cinema&success=1");
        exit();
    } else {
        header("location: home.php?show=cinema&error=1");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
