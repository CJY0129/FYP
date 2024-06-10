<?php
session_start();
$error_message = "";

// Database connection
$mysqli = require __DIR__ . "/Returnmysqli.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST["token"];
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM user WHERE password_reset_token = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare statement failed: " . $mysqli->error);
    }
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        echo "<script>alert('Token not found. Please request a new password reset link.'); window.location.href='login.php';</script>";
        exit;
    }

    $expiry_column_name = "token_expiry"; // Use the correct column name

    // Check if the token has expired
    if (strtotime($user[$expiry_column_name]) <= time()) {
        // Token has expired, display alert and redirect to login page
        echo "<script>alert('Token has expired. Please request a new password reset link.'); window.location.href='login.php';</script>";
        exit;
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $error_message = "Passwords must match";
    } else {
        // Plain text password from the form
        $password = $_POST["password"];
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE user
                SET password = ?,
                    password_reset_token = NULL,
                    $expiry_column_name = NULL
                WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare statement failed: " . $mysqli->error);
        }
        // Bind hashed password and user ID
        $stmt->bind_param("si", $hashed_password, $user["user_id"]);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            die("Password update failed");
        }

        // Password update successful, display alert
        echo "<script>alert('Password updated. You can now login.'); window.location.href='Login.php';</script>";
        exit;
    }
}

if (isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare statement failed: " . $mysqli->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}

// Handle token verification when the page loads
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM user WHERE password_reset_token = ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Prepare statement failed: " . $mysqli->error);
}
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    // Token not found, display alert and redirect
    echo "<script>alert('Token not found. Please request a new password reset link.'); window.location.href='login.php';</script>";
    exit;
}

$expiry_column_name = "token_expiry"; // Use the correct column name

// Check if the token has expired
if (strtotime($user[$expiry_column_name]) <= time()) {
    // Token has expired, display alert and redirect
    echo "<script>alert('Token has expired. Please request a new password reset link.'); window.location.href='login.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
    <link rel="icon" type="image/png" href="assets/img/CT.ico" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
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
    
<form id="signupForm" method="post" action="">
    <h2 class="profile-heading">Reset Password</h2> 
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label for="password">New password</label>
    <div style="position: relative;">
        <input type="password" name="password" id="password" required>
        <span class="toggle-password" onclick="togglePasswordVisibility('password')" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>

    <label for="password_confirmation">Confirm new password</label>
    <div style="position: relative;">
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <span class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>
    
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <button type="submit" name="login" class="theme-btn">Reset Password</button>
</form>
<?php include('footer.php'); ?>

<script>
function showPasswordField() {
        document.getElementById('password-field').style.display = 'table-row';
        document.getElementById('password-confirmation-field').style.display = 'table-row';
    }

    function togglePasswordVisibility(id) {
        var passwordField = document.getElementById(id);
        var togglePasswordField = passwordField.nextElementSibling;

        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePasswordField.textContent = "Hide";
        } else {
            passwordField.type = "password";
            togglePasswordField.textContent = "Show";
        }
    }
</script>

</body>
</html>
