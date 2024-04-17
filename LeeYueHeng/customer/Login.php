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
        <form method="post" action="Checklogin.php">
            <table border="1">
                <tr>
                    <th>
                        Username
                    </th>
                    <td>
                        <input type="text" name="username" value="">
                    </td>
                </tr>
                <tr>
                    <th>
                        Password
                    </th>
                    <td>
                        <input type="password" name="password" value="">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Login">
        </form>
    </div>
    <a href="../main(notlogin).php">Go back to main page</a>

    <script>
        // Check if there's an error query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        if (error) {
            // Display an alert with the error message
            alert(error);
        }
    </script>
</body>
</html>
