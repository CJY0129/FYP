<?php
// Include the database connection file
include("connection.php");

// Initialize error message variable
$error_msg = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password here if needed

    // Query to select user with provided username and password
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If user exists, redirect to main page
        header("Location: ../main.php"); // Change "main.php" to the actual main page URL
        exit();
    } else {
        // If user doesn't exist, set error message
        echo $error_msg = "Invalid username or password";
        // Redirect back to the login page with error message
        header("Location: login.php?error=" . urlencode($error_msg)); // Change "login.php" to the actual login page URL
        exit();
    }
} else {
    // If the form is not submitted, redirect back to the login page
    header("Location: login.php"); // Change "login.php" to the actual login page URL
    exit();
}
?>