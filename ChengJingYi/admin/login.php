<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cinetime";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to check username and password
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $_POST['loginUsername'], $_POST['loginPassword']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful, check if the user is a super admin
        $row = $result->fetch_assoc();
        if ($row['is_super_admin'] == 1) {
            // User is a super admin, set session variable and redirect to admin dashboard
            $_SESSION['username'] = $_POST['loginUsername'];
            header("Location: super_dashboard.php");
            exit();
        } else {
            // User is not a super admin, redirect back to login page with error
            header("Location: dashboard.html");
            exit();
        }
    } else {
        // Authentication failed, redirect back to login page with error
        header("Location: index.php?error=1");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to login page if accessed directly without form submission
    header("Location: index.php");
    exit();
}
?>
