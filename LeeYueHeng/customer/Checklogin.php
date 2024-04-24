<?php
// Start the session
session_start();

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
        // If user exists, fetch user ID
        $row = $result->fetch_assoc();
        $userid = $row['user_id'];
        
        // Store user ID in session
        $_SESSION['user_id'] = $userid;

        // Redirect to main page with user ID parameter
        header("Location: ../main.php");
        exit();
    } else {
        // If user doesn't exist, set error message
        $error_msg = "Invalid username or password";
        // Redirect back to the login page with error message
        header("Location: login.php?error=" . urlencode($error_msg));
        exit();
    }
} else {
    // If the form is not submitted, redirect back to the login page
    header("Location: login.php");
    exit();
}
?>
