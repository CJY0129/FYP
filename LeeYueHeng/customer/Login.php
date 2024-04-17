<?php
include("connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you're using POST method to submit the form

    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password here if needed

    // Query to select user with provided username and password
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If user exists, fetch user data
        $user = $result->fetch_assoc();
    } else {
        // Handle invalid login attempt
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign up</title>
    <link rel="stylesheet" type="text/css" href="design.css"/>
</head>
<body>
    <div id="header">
        <h3>
            <p>Login/Sign up</p>
        </h3>
        <form method="post">
            <table border="1">
                <tr>
                    <th>
                        Username
                    </th>
                    <td>
                        <input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        Password
                    </th>
                    <td>
                        <input type="password" name="password" value="<?php echo isset($user['password']) ? $user['password'] : ''; ?>">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Login">
        </form>
    </div>
    <a href="../main(notlogin).php">Go back to main page</a>
</body>
</html>
