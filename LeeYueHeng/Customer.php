<?php include("connection.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="design.css"/>
</head>

<body>
    <a href="main.php" style="float: right; color: rgba(255, 255, 255, 0.651);">Back</a>
    <div id="mainbox">
        <h2>Your Profile</h2>
        <?php
        if(isset($rows[0])) {
            $customer = $rows[0];
        ?>
        <table border="1">
            <tr>
                <th>Your Name</th>
                <?php
                foreach ($rows as $row) {
                    echo "<td>" . $row["Full_Name"] . "</td>";
                }
                ?>
            </tr>
            <tr>
                <th>Gender</th>
                <?php
                foreach ($rows as $row) {
                    echo "<td>" . $row["Gender"] . "</td>";
                }
                ?>
            </tr>
            <tr>
                <th>Email</th>
                <?php
                foreach ($rows as $row) {
                    echo "<td>" . $row["Email"] . "</td>";
                }
                ?>
            </tr>
            <tr>
                <th>Phone Number</th>
                <?php
                foreach ($rows as $row) {
                    echo "<td>" . $row["Phone_No"] . "</td>";
                }
                ?>
            </tr>
        </table>
        <p><a href="Cus(edit).php" >edit</a></p>
        <?php
            }
        ?>
    </div>
</body>

</html>
