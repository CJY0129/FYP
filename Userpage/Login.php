<?php
session_start();
include('connection.php');
$error_message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Fetch username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database to check if the username exists
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password
            if ($password == $row['password']) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['user_id'];
                // Redirect to index.php
                header("Location: main.php");
                exit();
            } else {
                // Password is incorrect
                $error_message = "Incorrect username or password. Please try again.";
            }
        } else {
            // Username not found
            $error_message = "Incorrect username or password. Please try again.";
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign up</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
    <link rel="icon" type="image/png" href="assets/img/CT.ico" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <a href="index.php"><img src="assets/img/CTlogo.png" alt="logo" /></a>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <li><a class="active" href="index.php">Home</a></li>
                        <?php echo '<li><a href="movies.php?userid=' . $_SESSION['user_id'] . '">Movies</a></li>' ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<h2 class="profile-heading">Login</h2> 
<h6>Username</h6>
    <input type="text" name="username" required>
    <h6>Password</h6>
    <input type="password" name="password" required>
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>
        <div class="login-signup">
            <span class="signup-link"><a href="signup.php">Sign Up</a></span>
            <button type="submit" name="login" class="theme-btn">Log In</button>
        </div>

</form>

<?php include('footer.php'); ?>
</body>
</html>
