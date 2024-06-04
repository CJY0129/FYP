<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cinemaId = (int) $_POST['cinema_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $num_of_hall = (int) $_POST['num_of_hall'];

    // Escape special characters to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $location = mysqli_real_escape_string($conn, $location);
    $city = mysqli_real_escape_string($conn, $city);

    // Update cinema details in the database
    $updateQuery = "UPDATE cinema SET name='$name', location='$location', city='$city', num_of_hall=$num_of_hall 
                    WHERE cinema_id=$cinemaId";
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
