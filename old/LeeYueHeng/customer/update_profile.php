<?php
include("connection.php");
session_start(); 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Update query
    $update_query = "UPDATE user SET First_Name='$first_name', last_Name='$last_name', Gender='$gender', Email='$email', Phone_number='$phone_number' WHERE user_id=$user_id";

    if ($conn->query($update_query) === TRUE) {
        // Update successful
        echo "<script>alert('Information updated!');</script>";
        echo "<script>window.location.href='customer.php?user_id=$user_id';</script>"; // Redirect back to the customer.php page

        exit; // Terminate script execution after redirection
    } else {
        // Error handling
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="design.css"/>
</head>
<body>
    <!-- Your HTML content here -->
</body>
</html>
