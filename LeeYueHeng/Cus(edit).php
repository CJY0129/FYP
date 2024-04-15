<?php include("connection.php"); ?>

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
        <form method="post" action="update_profile.php"> <!-- Modified action to point to update_profile.php -->
            <table border="1">
                <tr>
                    <th>Your Name</th>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $customer['Full_Name']; ?>">
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
                        <input type="email" name="email" value="<?php echo $customer['Email']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>
                        <input type="text" name="phone_no" value="<?php echo $customer['Phone_No']; ?>">
                    </td>
                </tr>
            </table>
            <button type="submit" >Finish edit</button>
        </form>
        <?php 
        } else {
            echo "No customer found";
        }
        ?>
    </div>
</body>
</html>
