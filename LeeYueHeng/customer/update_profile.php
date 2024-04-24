<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Check if the 'userid' parameter is set in the URL
    if(isset($_GET['userid'])) {
        // Retrieve the user ID from the URL
        $user_id = $_GET['userid'];
        
        // Update query
        $update_query = "UPDATE user SET first_name='$first_name', last_name='$last_name', Gender='$gender', email='$email', phone_number='$phone_number' WHERE user_id=$user_id";

        if ($conn->query($update_query) === TRUE) {
            // Update successful
            echo "<script>alert('Information updated!');</script>";
            echo "<script>window.location.href='Customer.php?userid=$user_id';</script>"; // Redirect back to the Customer.php page
            exit; // Terminate script execution after redirection
        } else {
            // Error handling
            echo "Error updating record: " . $conn->error;
        }
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
