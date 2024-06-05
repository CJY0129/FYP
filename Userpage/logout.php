<?php
session_start();

$_SESSION['user_id'] = 0;
$_SESSION['first_name'] = '';
$_SESSION['Gender'] = '';
header("Location: index.php"); // Redirect to the home page or login page
session_destroy(); // Optionally destroy the session if you want to clear all session variables
exit();
?>
