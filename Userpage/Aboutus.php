<?php 
session_start(); // Start or resume a session
include("connection.php");

// Check if the 'userid' parameter is set in the URL
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
    <style>
        p{
            color: #fff;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .container p{
            font-size: 20px;
            text-align: center;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        nav .logo {
            font-size: 1.5rem;
        }
        nav .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 1rem;
        }
        nav .nav-links li {
            display: inline;
        }
        nav .nav-links a {
            color: #fff;
            text-decoration: none;
        }
        nav .nav-buttons {
            display: flex;
            gap: 0.5rem;
        }
        nav .nav-buttons button {
            background: #fff;
            color: #004aad;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
        section {
            padding: 1.5rem 0;
        }
        .team {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: space-around;
        }
        .team .member {
            text-align: center;
            margin: 1rem;
        }
        .team img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .contact {
            background: #e2e2e2;
            padding: 1rem;
        }
        .contact h3, .contact p {
            margin: 0;
        }
       
    </style>
</head>
<body>
<?php include('header.php'); ?>
<?php include('buytickets.php'); ?>
    
    <div class="container">
        <h1>About Us</h1>
        <section class="introduction">
            <h2>Who We Are</h2>
            <p>Welcome to Cinetime. We are dedicated to delivering the best quality and value to our customers. With a passion for innovation and excellence, our team strives to exceed your expectations.</p>
        </section>
        <h2>Team Member</h2>
        <section class="team">
            
            <div class="member">
                <img src="Superadmin.png" alt="Team Member">
                <h3>Cheng Jing Yi</h3>
                <p>CEO & Founder</p>
            </div>
            <div class="member">
                <img src="Admin2.jpg" alt="Team Member">
                <h3>Lee Yue Heng</h3>
                <p>Chief Operating Officer</p>
            </div>
            <div class="member">
                <img src="Admin1.jpg" alt="Team Member">
                <h3>Hau Tze Chern</h3>
                <p>Chief Operating Officer</p>
            </div>
        </section>


    </div>

    <?php include('footer.php'); ?>
</body>
<!-- footer section end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jquery main JS -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Slick nav JS -->
<script src="assets/js/jquery.slicknav.min.js"></script>
<!-- owl carousel JS -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- Popup JS -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- Isotope JS -->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!-- main JS -->
<script src="assets/js/main.js"></script>
</html>
