
<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CINETIME</title>
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
		<!-- Main style CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
		<!-- Responsive CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
		<!--[if lt IE 9]>   
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <a href="index.php"><img src="assets/img/CTlogo.png" alt="logo" /></a>
            </div>
            <div class="header-right">
                <form></form>
                <div class="header-right">
                    <ul>
                        <?php
                        if ($_SESSION['user_id'] == 0) {
                            echo '<li>Welcome Guest</li>';
                            echo '<li><a href="Login.php">Login</a></li>';
                        } else {
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
                        }
                        ?>
                        <div class="dropdown-content">
                            <?php
                            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 1) {
                                echo '<a href="customer/Customer.php?userid=' . $_SESSION['user_id'] . '">View Profile</a>';
                            }
                            ?>
                            <a href="logout.php" id="logout">Log out</a>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="movies.html">Movies</a></li>
                        <li><a class="theme-btn" href="#"><i class="icofont icofont-ticket"></i> Buy Tickets</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>