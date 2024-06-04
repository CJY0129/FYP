<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connect.php");

    // Prepare SQL statement to check username and password
    $stmt = $conn->prepare("SELECT * FROM admin WHERE  username = ? AND password = ?");
    $stmt->bind_param("ss", $_POST['loginUsername'], $_POST['loginPassword']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful, fetch user data
        $row = $result->fetch_assoc();

        // Store user data in session variables
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['is_super_admin'] = $row['is_super_admin'];

        // Redirect to appropriate page based on user role
        if ($row['is_super_admin'] == 1) {
            // User is a super admin, redirect to admin dashboard
            header("Location: home.php");
            exit();
        } else {
            // User is not a super admin, redirect to admin page with admin ID
            header("Location: home.php");
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
