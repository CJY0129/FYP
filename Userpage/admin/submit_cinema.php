<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve cinema details from the form
    $name = $_POST['name'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $num_of_hall = $_POST['num_of_hall'];

    // Escape special characters to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $location = mysqli_real_escape_string($conn, $location);
    $city = mysqli_real_escape_string($conn, $city);
    $num_of_hall = (int) $_POST['num_of_hall'];

    // Insert cinema details into the database
    $insertQuery = "INSERT INTO cinema (name, location, city, num_of_hall) 
                    VALUES ('$name', '$location', '$city', $num_of_hall)";
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
