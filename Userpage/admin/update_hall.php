<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hallId = (int) $_POST['hall_id'];
    $cinema_id = (int) $_POST['cinema_id'];
    $hall_num = (int) $_POST['hall_num'];
    $number_of_seat = (int) $_POST['number_of_seat'];

    // Update hall details in the database
    $updateQuery = "UPDATE hall SET cinema_id=$cinema_id, hall_num=$hall_num, number_of_seat=$number_of_seat 
                    WHERE hall_id=$hallId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("location: home.php?show=cinema&success=2");
        exit();
    } else {
        header("location: home.php?show=cinema&error=2");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
