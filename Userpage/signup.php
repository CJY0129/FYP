<?php
session_start();
include('connection.php');
$error_message = '';
$error_message_username = '';
$error_message_email = '';
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
            // Check if username already exists
            $check_username_sql = "SELECT * FROM user WHERE username = ?";
            $check_username_stmt = $conn->prepare($check_username_sql);
            $check_username_stmt->bind_param("s", $username);
            $check_username_stmt->execute();
            $result_username = $check_username_stmt->get_result();

            if ($result_username->num_rows > 0) {
                $error_message_username = "Username already exists";
            }

            // Check if email already exists
            $check_email_sql = "SELECT * FROM user WHERE email = ?";
            $check_email_stmt = $conn->prepare($check_email_sql);
            $check_email_stmt->bind_param("s", $email);
            $check_email_stmt->execute();
            $result_email = $check_email_stmt->get_result();

            if ($result_email->num_rows > 0) {
                $error_message_email = "Email already exists";
            }

            // If no errors, insert the data into the database
            if (empty($error_message_username) && empty($error_message_email)) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insert the data into the database
                $sql = "INSERT INTO user (username, password, first_name, last_name, gender, email, phone_number) 
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
    <?php if ($error_message_username): ?>
    <div class="error-message"><?php echo $error_message_username; ?></div>
    <?php endif; ?>
    <h6>Password</h6>
    <div style="position: relative;">
        <input type="password" name="password" id="password" required>
        <span class="password-toggle" data-target="password" onclick="togglePasswordVisibilitypass()" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>
    <h6>Confirm Password</h6>
    <div style="position: relative;">
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <span class="password-toggle" data-target="password_confirmation" onclick="togglePasswordVisibilityconf()" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%);">Show</span>
    </div>
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
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
    <?php if ($error_message_email): ?>
    <div class="error-message"><?php echo $error_message_email; ?></div>
    <?php endif; ?>
    <h6>Phone Number</h6>
    <input type="number" name="phone" min="111111111" max="999999999" required>
    <div class="login-signup">
        <span class="signup-link"><a href="Login.php">Back</a></span>
        <button type="submit" name="signup" class="theme-btn">Sign Up</button>
    </div>
</form>

<!-- Include your footer if needed -->
<?php include('footer.php'); ?>

<script>
function togglePasswordVisibilitypass() {
    var passwordField = document.getElementById("password");
    var togglePasswordField = document.querySelector(".password-toggle[data-target='password']");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePasswordField.textContent = "Hide";
    } else {
        passwordField.type = "password";
        togglePasswordField.textContent = "Show";
    }
}

function togglePasswordVisibilityconf() {
    var passwordConfirmField = document.getElementById("password_confirmation");
    var togglePasswordConfirmField = document.querySelector(".password-toggle[data-target='password_confirmation']");

    if (passwordConfirmField.type === "password") {
        passwordConfirmField.type = "text";
        togglePasswordConfirmField.textContent = "Hide";
    } else {
        passwordConfirmField.type = "password";
        togglePasswordConfirmField.textContent = "Show";
    }
}

<?php if ($signup_success): ?>
alert("Registration successful. Redirecting to login page...");
window.location.href = 'login.php';
<?php endif; ?>
</script>

</body>
</html>
