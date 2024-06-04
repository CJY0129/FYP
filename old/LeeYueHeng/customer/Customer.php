<?php 
session_start(); // Start or resume a session
include("connection.php");

// Check if the 'userid' parameter is set in the URL
if(isset($_GET['userid'])) {
    // Retrieve the user ID from the URL
    $user_id = $_GET['userid'];
    
    // Fetch user data from the database based on the user ID
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
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
    <a href="../main.php?user_id=" style="float: right; color: rgba(255, 255, 255, 0.651);">Back</a>
    <div id="mainbox">
        <h2>Your Profile</h2>
        <?php
        if(isset($rows[0])) {
            $customer = $rows[0];
        ?>
        <table border="1">
            <tr>
                <th>Your Name</th>
                <td><?php echo $customer["first_name"] ." ". $customer["last_name"]; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $customer["Gender"]; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $customer["email"]; ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo $customer["phone_number"]; ?></td>
            </tr>
        </table>
        <?php
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != NULL) {
                            echo '<a href="Cus(edit).php?userid='. $_SESSION['user_id'].'">Edit</a>';
                        }
                        ?>
        <?php
        } else {
            echo "User not found";
        }
        ?>
    </div>
</body>

</html>
