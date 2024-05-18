<?php
session_start();
$_SESSION['user_id'] = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Implement login validation here
    } elseif (isset($_POST['guest'])) {
        $_SESSION['user_id'] = -1; // Assign guest user ID
        header("Location: index.php");
        exit;
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
 <div class="login-area">
        <div class="container">
            <div class="login-box">
                <h2>LOGIN</h2>
                <form method="post" action="checklogin.php">
                    <h6>USERNAME</h6>
                    <input type="text" name="username" required>
                    <h6>PASSWORD</h6>
                    <input type="password" name="password" required>
                    <div class="login-signup">
                        <span><a href="signup.php">SIGNUP</a></span>
                    </div>
                    <button type="submit" name="login" class="theme-btn">LOG IN</button>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    if (error) {
        alert(decodeURIComponent(error));
    }
</script>
</body>
</html>
