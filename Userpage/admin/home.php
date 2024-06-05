<?php

session_start();


if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
  include("connect.php");
?>

<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CineTime Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/CT.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="home.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Cine</strong><strong>Time</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">C</strong><strong>T</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
            <!-- Log out -->
            <div class="list-inline-item logout">                   <a id="logout" href="index.php" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="img/user.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
            <h1 class="h5">
              <?php
               echo  $_SESSION['admin_name'];  
            $conn->close();
              ?>
            </h1>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
            <li><a href="home.php?show=showtime"><i class="icon-home"></i>Showtime</a></li>
            <!--<li><a href="home.php?show=forms"><i class="icon-grid"></i>Forms</a></li>-->
            <!--<li><a href="home.php?show=tables"><i class="fa fa-bar-chart"></i>Tables</a></li>-->
            <li><a href="home.php?show=booking"><i class="icon-padnote"></i>Booking</a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon icon-computer"></i>Movies</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="home.php?show=movie">Movies Now</a></li>
                    <li><a href="home.php?show=ucmovie">Upcoming Movies</a></li>
                    <li><a href="home.php?show=csmovie">Coming Soon Movies</a></li>
                  </ul>
                </li>
                <?php
                  if ($_SESSION['is_super_admin'] == 1) {
                      echo '<li> <a href="home.php?show=cinema"> <i class="icon-writing-whiteboard"></i>Cinema & Hall </a></li>';
                      echo '<li><a href="register.php"> <i class="icon-logout"></i>Register page </a></li>';  
                    }
                  ?>
                  
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
        <?php
          if (isset($_GET['show']) && $_GET['show'] == 'showtime') {
            include("showtime.php");
          } else if (isset($_GET['show']) && $_GET['show'] == 'forms') {
            include("forms.php");
          } else if (isset($_GET['show']) && $_GET['show'] == 'tables') {
            include("tables.php");
          } else if (isset($_GET['show']) && $_GET['show'] == 'booking') {
            include("booking.php");
          } elseif (isset($_GET['show']) && $_GET['show'] == 'movie') {
            include("movie.php");
          } elseif (isset($_GET['show']) && $_GET['show'] == 'ucmovie') {
            include("ucmovie.php");
          } elseif (isset($_GET['show']) && $_GET['show'] == 'csmovie') {
            include("csmovie.php");
          } elseif (isset($_GET['show']) && $_GET['show'] == 'cinema') {
            include("cinema.php");
          } else {
            include("showtime.php");
          }
        ?>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
               <p class="no-margin-bottom">2024 &copy; CineTime.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>