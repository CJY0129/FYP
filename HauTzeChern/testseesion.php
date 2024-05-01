<?php
session_start();

// Assigning the user ID to the session variable
$_SESSION['user_id'] = 2;

// Check if 'user_id' key is set in the $_SESSION array
if (isset($_SESSION['user_id'])) {
    // Retrieve the user ID from the session variable
    $user_id = $_SESSION['user_id'];

    // Creating the link to the profile page with the user ID
    echo '<a href="receipt.php?userid=' . $user_id . '">View Profile</a>';
} else {
    // Handle the case where 'user_id' is not set
    echo "User ID is not set in the session.";
}
?>
