<?php 
include("connection.php"); 
session_start(); 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$sql = "SELECT * FROM user WHERE user_id = $user_id";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

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
    <div id="mainbox">
        <h2>Your Profile</h2>
        <?php
        if(isset($rows[0])) {
            $customer = $rows[0];
        ?>
        <form method="post" action="update_profile.php?user_id=<?php echo $user_id; ?>"> <!-- Modified action to include user_id -->
            <table border="1">
                <tr>
                    <th>First Name / Last name</th>
                    <td>
                        <input type="text" name="first_name" value="<?php echo $customer['first_name']; ?>">
                        <input type="text" name="last_name" value="<?php echo $customer['last_name']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Your Gender</th>
                    <td>
                        <input type="text" name="gender" value="<?php echo $customer['Gender']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" name="email" value="<?php echo $customer['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>
                        <input type="text" name="phone_number" value="<?php echo $customer['phone_number']; ?>">
                    </td>
                </tr>
            </table>
            <button type="submit">Finish edit</button>
        </form>
        <?php 
        } else {
            echo "No customer found";
        }
        ?>
    </div>
</body>
</html>
