<?php 
include("connection.php"); 
session_start(); 
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$sql = "SELECT * FROM user WHERE user_id = $user_id";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Update query
    $update_query = "UPDATE user SET First_Name='$first_name', last_Name='$last_name', Gender='$gender', Email='$email', Phone_number='$phone_number' WHERE user_id=$user_id";

    if ($conn->query($update_query) === TRUE) {
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

<form id="signupForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2 class="profile-heading">Your Profile</h2>
        <?php
        if(isset($rows[0])) {
            $customer = $rows[0];
        ?>
        <form method="post" action="update_profile.php?user_id=<?php echo $user_id; ?>"> <!-- Modified action to include user_id -->
            <table border="1">
                <tr>
                    <th>First Name </th>
                    <td>
                        <input type="text" name="first_name" value="<?php echo $customer['first_name']; ?>">
                        
                    </td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>
                    <input type="text" name="last_name" value="<?php echo $customer['last_name']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Your Gender</th>
                    <td>
                        <input type="text" name="gender" value="<?php echo $customer['Gender']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" name="email" value="<?php echo $customer['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>
                        <input type="tel" name="phone_number" value="<?php echo $customer['phone_number']; ?>">
                    </td>
                </tr>
            </table>
            <div class="login-signup">
        <span class="signup-link"><a href="Customer.php">Back</a></span>
        <button type="submit" name="signup" class="theme-btn">Update Profile</button>
    </div>
        </form>
        <?php 
        } else {
            echo "No customer found";
        }
        ?>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>
