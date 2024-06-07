<?php 
include("connection.php"); 
session_start(); 

// Ensure user_id is set either from session or GET parameter
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    die("User ID not set.");
}

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $error_message = "Passwords must match";
    } else {
        // Plain text password from the form
        $password = $_POST["password"];
    }

    // Hash the password if it's set
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE user SET First_Name = ?, Last_Name = ?, Gender = ?, Email = ?, Phone_number = ?, Username = ?, Password = ? WHERE user_id = ?");
        $update_stmt->bind_param("sssssssi", $first_name, $last_name, $gender, $email, $phone_number, $username, $hashed_password, $user_id);
    } else {
        $update_stmt = $conn->prepare("UPDATE user SET First_Name = ?, Last_Name = ?, Gender = ?, Email = ?, Phone_number = ?, Username = ? WHERE user_id = ?");
        $update_stmt->bind_param("ssssssi", $first_name, $last_name, $gender, $email, $phone_number, $username, $user_id);
    }

    if ($update_stmt->execute()) {
        // Update successful
        echo "<script>alert('Information updated!');</script>";
        echo "<script>window.location.href='customer.php?user_id=$user_id';</script>"; // Redirect back to the customer.php page
        exit; // Terminate script execution after redirection
    } else {
        // Error handling
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
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
<form id="signupForm" method="post" action="Cus(edit).php?user_id=<?php echo $user_id;?>"> <!-- Modified action to include user_id -->
<h2 class="profile-heading">Your Profile</h2>
<?php
if(isset($rows[0])) {
    $customer = $rows[0];
?>

    <table border="1">
        <tr>
            <th>First Name </th>
            <td>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>">
            </td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>">
            </td>
        </tr>
        <tr>
            <th>Username</th>
            <td>
                <input type="text" name="username" value="<?php echo htmlspecialchars($customer['username']); ?>">
            </td>
        </tr>
        <tr>
            <th>Your Gender</th>
            <td>
                <select name="gender" required>
                    <option value="M" <?php echo ($customer['Gender'] == 'M') ? 'selected' : ''; ?>>Male</option>
                    <option value="F" <?php echo ($customer['Gender'] == 'F') ? 'selected' : ''; ?>>Female</option>
                    <option value="N" <?php echo ($customer['Gender'] == 'N') ? 'selected' : ''; ?>>Other</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>">
            </td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>
                <input type="tel" name="phone_number" value="<?php echo htmlspecialchars($customer['phone_number']); ?>">
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="text-align: center;">
                <button type="button" onclick="showPasswordField()">Change Password</button>
           
                </td>
        </tr>
        <tr id="password-field" style="display: none;">
        <th>Password</th>
    <td>
        <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">
        <span class="toggle-password" onclick="togglePasswordVisibility('password')">Show</span>
        </td>
        </tr>
        <tr id="password-confirmation-field" style="display: none;">
            <th>Confirm Password</th>
            <td>
                <input type="password" id="password_confirmation" name="password_confirmation">
                <span class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')" >Show</span>
            </td>
        </tr>
    </table>
    <div class="login-signup">
        <span class="signup-link"><a href="customer.php">Back</a></span>
        <button type="submit" class="theme-btn">Update Profile</button>
    </div>
</form>
<?php 
} else {
    echo "No customer found";
}
?>
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

<?php include('footer.php'); ?>
</body>
</html>
