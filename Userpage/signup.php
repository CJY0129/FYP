<?php
session_start();
include('connection.php');
$error_message = '';
$signup_success = false;

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // Fetch form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone'];

        // Check if passwords match
        if ($password !== $password_confirmation) {
            $error_message = "Passwords must match";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // You may want to add validation and sanitization here

            // Insert the data into the database
            $sql = "INSERT INTO user (username, password, first_name, last_name, Gender, email, phone_number) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $username, $hashed_password, $first_name, $last_name, $gender, $email, $phone_number);

            if ($stmt->execute()) {
                // Registration successful
                $signup_success = true;
            } else {
                // Error occurred while registering
                $error_message = "Error: " . $stmt->error;
            }
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

<form id="signupForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2 class="profile-heading">Sign Up</h2>
    <h6>Username</h6>
    <input type="text" name="username" required>
    <h6>Password</h6>
    <div style="position: relative;">
        <input type="password" name="password" id="password" required>
        <span class="toggle-password" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>
    <h6>Confirm Password</h6>
    <div style="position: relative;">
    <input type="password" id="password_confirmation" name="password_confirmation" required>
        <span class="toggle-password" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>
    <h6>First Name</h6>
    <input type="text" name="firstname" required>
    <h6>Last Name</h6>
    <input type="text" name="lastname" required>
    <h6>Gender</h6>
    <select name="gender" required>
        <option value="M">Male</option>
        <option value="F">Female</option>
        <option value="N">Other</option>
    </select>
    <h6>Email</h6>
    <input type="email" name="email" required>
    <h6>Phone Number</h6>
    <input type="tel" name="phone" pattern="\d*" required>
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="login-signup">
        <span class="signup-link"><a href="Login.php">Back</a></span>
        <button type="submit" name="signup" class="theme-btn">Sign Up</button>
    </div>
</form>

<!-- Include your footer if needed -->
<?php include('footer.php'); ?>

<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var passwordConfirmField = document.getElementById("password_confirmation");
    var toggleText = document.querySelectorAll(".toggle-password");

    toggleText.forEach(toggle => {
        if (passwordField.type === "password" || passwordConfirmField.type === "password") {
            passwordField.type = "text";
            passwordConfirmField.type = "text";
            toggle.textContent = "Hide";
        } else {
            passwordField.type = "password";
            passwordConfirmField.type = "password";
            toggle.textContent = "Show";
        }
    });
}

<?php if ($signup_success): ?>
alert("Registration successful. Redirecting to login page...");
window.location.href = 'login.php';
<?php endif; ?>
</script>

</body>
</html>
