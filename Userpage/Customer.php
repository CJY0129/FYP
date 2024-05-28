<?php 
session_start(); // Start or resume a session
include("connection.php");

// Check if the 'userid' parameter is set in the URL
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$sql = "SELECT * FROM user WHERE user_id = $user_id";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="assets/img/CT.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
    <!-- Slick nav CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
    <!-- Iconfont CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
    <!-- Owl carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <!-- Popup CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
    <!-- Responsive CSS -->
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
            <div class="header-right">
                <ul>
                    <?php
                        echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        if ($_SESSION['user_id'] == 1) {
                            echo 'Welcome Guest!';
                        } else {
                            if ($_SESSION['Gender'] == 'M') {
                                echo 'Welcome Mr. ' . $_SESSION['first_name'] . '!';
                            } else {
                                echo 'Welcome Ms. ' . $_SESSION['first_name'] . '!';
                            }
                        }
                        echo '</a>';
                    ?>
                    <div class="dropdown-content">
                        <a href="logout.php" id="logout">Log out</a>
                    </div>
                </ul>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <?php 
                        if ($_SESSION['user_id'] == 0) {
                            echo '<li><a class="active" href="index.php">Home</a></li>';
                        }
                        if ($_SESSION['user_id'] != 0) {
                            echo '<li><a class="active" href="main.php?user_id=">Home</a></li>';
                        }
                        ?>
                        <li><a href="movies.php">Movies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<form id="signupForm" method="post" action="#">
    <div id="mainbox">
        <h2 class="profile-heading">Your Profile</h2>
        <?php
        if(isset($rows[0])) {
            $customer = $rows[0];
        ?>
        <table border="1">
            <tr>
                <th>Your Name</th>
                <td><?php echo $customer["first_name"] ." ". $customer["last_name"]; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $customer["Gender"]; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $customer["email"]; ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo $customer["phone_number"]; ?></td>
            </tr>
        </table>
        <div class="login-signup">
        <?php
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != NULL) {
                echo '<a class="theme-btn" href="Cus(edit).php?userid='. $_SESSION['user_id'].'" >Edit</a>';
            }
        ?>
        </div>
        <?php
        } else {
            echo "User not found";
        }
        ?>
    </div>
</form>

<?php include('footer.php');?>
</body>

<script>
    document.getElementById('logout').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to log out?')) {
            event.preventDefault();
        }
    });
	
</script>
</html>



