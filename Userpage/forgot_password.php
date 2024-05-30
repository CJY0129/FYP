<?php
session_start();
include('connection.php');
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['forgot_password'])) {
        $username = $_POST['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Generate a random password reset token
            $token = bin2hex(random_bytes(16));
            $sql = "UPDATE user SET password_reset_token = '$token' WHERE username = '$username'";
            $conn->query($sql);

            // Send an email to the user with a link to reset their password
            $to = $row['email'];
            $subject = 'Password Reset';
            $message = 'Click on this link to reset your password: <a href="reset_password.php?token='. $token. '">Reset Password</a>';
            $headers = 'From: your_email@example.com'. "\r\n".
                'Reply-To: your_email@example.com'. "\r\n".
                'X-Mailer: PHP/'. phpversion();
            mail($to, $subject, $message, $headers);

            $error_message = 'An email has been sent to your registered email address with a link to reset your password.';
        } else {
            $error_message = 'Username not found.';
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

<form id="signupForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2 class="profile-heading">Forgot Password</h2>
    <h6>Enter your username to reset your password</h6>
    <input type="text" name="username" required>
    <?php if ($error_message):?>
        <div class="error-message"><?php echo $error_message;?></div>
    <?php endif;?>
    <button type="submit" name="forgot_password" class="theme-btn">Send Reset Link</button>
</form>

<?php include('footer.php');?>
</body>
</html>