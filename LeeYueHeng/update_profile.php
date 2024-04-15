<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];

    // Update query
    $update_query = "UPDATE Customers SET Full_Name='$full_name', Gender='$gender', Email='$email', Phone_No='$phone_no' WHERE ID=1"; // Assuming ID=1 for demonstration

    if ($conn->query($update_query) === TRUE) {
        // Update successful
        echo "<script>alert('Information updated!');</script>";
        echo "<script>window.location.href='customer.php';</script>"; // Redirect back to the customer.php page
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
