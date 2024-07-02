<?php
session_start();
$error_message = "";

if(isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
    $mysqli = require __DIR__ . "/Returnmysqli.php";
    $sql = "UPDATE user
            SET password_reset_token = ?, token_expiry = ?
            WHERE email = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();

        if ($mysqli->affected_rows) {
            $mail = require __DIR__ . "/mailer.php";

            $mail->setFrom("leeyueheng04@gmail.com");
            $mail->addAddress($email);
            $mail->Subject = "Password Reset";
            $mail->Body = <<<END
            Click <a href="http://localhost/FYP/CineTime/Userpage/reset_password.php?token=$token">here</a> 
            to reset your password.
            END;

            try {
                $mail->send();
                $error_message = "Message sent, please check your inbox.";
            } catch (Exception $e) {
                $error_message ="Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
        } else {
            $error_message ="No user found with that email.";
        }

        $stmt->close();
    } else {
        $error_message = "Error preparing statement: {$mysqli->error}";
    }

    $mysqli->close();
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
    <form id="signupForm" action="forgot_password.php" method="POST">
        <h2 class="profile-heading" style="padding-bottom:30px;">Reset Password</h2> 
        <h6>Enter your email to reset your password</h6>
    <input type="email" name="email" placeholder="Enter your email" required>
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>
<div class="login-signup">
<span class="signup-link"><a href="Login.php">Back</a></span>
    <button type="submit" name="login" class="theme-btn">Send Email</button>
    </div>
</form>
<?php include('footer.php'); ?>
</body>
</html>
