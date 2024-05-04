<?php
include('connect.php');
session_start();
$user_id = 0;

// Get today's date
$today = date('Y-m-d');

?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Page loader -->
	<div id="preloader"></div>
    <!-- header section start -->
    <header class="header">
        <div class="container">
            <div class="header-area">
                <div class="logo">
                    <a href="index.php"><img src="assets/img/CTlogo.png" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <form action="#">
                        <select>
                            <option value="Movies">Movies</option>
                            <option value="Movies">Movies</option>
                            <option value="Movies">Movies</option>
                        </select>
                        <input type="text" />
                        <button><i class="icofont icofont-search"></i></button>
                    </form>
                    <ul>
                        <li><a class="login-popup" href="#">Login</a></li>
                    </ul>
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
    <div class="login-area">
        <div class="login-box">
            <a href="#"><i class="icofont icofont-close"></i></a>
            <h2>Login</h2>
            <form action="#">
                <h6>Username</h6>
                <input type="text" />
                <h6>Password</h6>
                <input type="text" />
                <div class="login-signup">
                    <span>Signup</span>
                </div>
                <a href="#" class="theme-btn">Log in</a>
            </form>

        </div>
    </div>

    <!-- header section end -->
    <!-- hero area start -->
    <section class="hero-area" id="home">
        <div class="container">
            <div class="hero-area-slider">

			<?php
// Fetch movies with showtimes for today or after
$sql = "SELECT m.* FROM movie m
        INNER JOIN showtime s ON m.movie_id = s.Movie_id
        WHERE s.show_time >= '$today'
        GROUP BY m.movie_id
        LIMIT 1"; // Limit the result to only one movie
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="row hero-area-slide">';
        echo '<div class="col-lg-6 col-md-5">';
        echo '<div class="hero-area-content">';
        // Display movie poster
        if (!empty($row['poster_path'])) {
            $poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
            $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
            echo '<img src="' . $poster_src . '" alt="Movie Poster">';
        } else {
            echo '<p>No poster available</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="col-lg-6 col-md-7">';
        echo '<div class="hero-area-content pr-50">';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p>' . $row['synopsis'] . '</p>';
        echo '<h3>Cast: ' . $row['cast'] . '</h3>';
        echo '<div class="slide-trailor">';
        echo '<a class="theme-btn theme-btn2" href="../LeeYueHeng/Moviedetails/moviedesc.php?id=' . $row['movie_id'] . '"><i class="icofont icofont-play"></i> More information</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        // Break the loop after displaying the first movie
        break;
    }
} else {
    echo "No movies found.";
}
?>

            </div>
            <div class="hero-area-thumb">
                <div class="thumb-prev">
                    <div class="row hero-area-slide">
                        <div class="col-lg-6">
                            <div class="hero-area-content">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-area-content pr-50">
                                <h2></h2>
                                <p></p>
                                <h3></h3>
                                <div class="slide-trailor">
                                    <a class="theme-btn theme-btn2" href="../LeeYueHeng/Moviedetails/moviedesc.php"><i class="icofont icofont-play"></i> Buy now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="thumb-next">
                    <div class="row hero-area-slide">
                        <div class="col-lg-6">
                            <div class="hero-area-content">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-area-content pr-50">
                                <h2></h2>
                                <p></p>
                                <h3></h3>
                                <div class="slide-trailor">
                                    <a class="theme-btn theme-btn2" href="#"><i class="icofont icofont-play"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- hero area end -->
    <!-- portfolio section start -->
    <section class="portfolio-area pt-60">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6 text-center text-lg-left">
                    <div class="section-title">
                        <h1><i class="icofont icofont-movie"></i> Spotlight This Month</h1>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="portfolio-menu">
                        <ul>
                            <li data-filter=".Latest" class="active">Now Showing</li>
                            <li data-filter=".soon">Upcoming</li>
                            <li data-filter=".up">Coming Soon</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-9">
                    <div class="row portfolio-item">
                        <?php
                        // Latest movies
                        $sql = "SELECT m.* FROM movie m
                        INNER JOIN showtime s ON m.movie_id = s.Movie_id
                        WHERE s.show_time >= '$today'
                        GROUP BY m.movie_id"; // Group by movie to avoid duplicates if multiple showtimes exist for a movie
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-4 col-sm-6 Latest">';
                                echo '<div class="single-portfolio">';
                                echo '<div class="single-portfolio-img">';
                                // Display movie poster
                                if (!empty($row['poster_path'])) {
                                    $poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
                                    $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
                                    echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 265px; height: 425px;">';
                                } else {
                                    echo '<p>No poster available</p>';
                                }
                                echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube">';
                                echo '<i class="icofont icofont-ui-play"></i>';
                                echo '</a>';
                                echo '</div>';
                                echo '<div class="portfolio-content">';
                                echo '<h2>' . $row['title'] . '</h2>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 text-center text-lg-left">
                    <div class="portfolio-sidebar">
                        <img src="assets/img/sidebar/sidebar1.png" alt="sidebar" />
                        <img src="assets/img/sidebar/sidebar2.png" alt="sidebar" />
                        <img src="assets/img/sidebar/sidebar3.png" alt="sidebar" />
                        <img src="assets/img/sidebar/sidebar4.png" alt="sidebar" />
                    </div>
                </div>
            </div>
            <?php
            // Upcoming movies
            $sql = "SELECT * FROM ucmovie";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="row portfolio-item">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 col-sm-6 soon released">';
                    echo '<div class="single-portfolio">';
                    echo '<div class="single-portfolio-img" style="width: 265px; height: 425px;">';
                    // Display movie poster
                    if (!empty($row['poster_path'])) {
                        $poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
                        $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
                        echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 265px; height: 425px;">';
                    } else {
                        echo '<p>No poster available</p>';
                    }
                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube">';
                    echo '<i class="icofont icofont-ui-play"></i>';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="portfolio-content">';
                    echo '<h2>' . $row['title'] . '</h2>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section><!-- portfolio section end -->
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title pb-20">
                        <h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-9">
                    <div class="video-area">
                        <img src="assets/img/video/video1.png" alt="video" />
                        <a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
                            <i class="icofont icofont-ui-play"></i>
                        </a>
                        <div class="video-text">
                            <h2>Angle of Death</h2>
                            <div class="review">
                                <div class="author-review">
                                    <i class="icofont icofont-star"></i>
                                    <i class="icofont icofont-star"></i>
                                    <i class="icofont icofont-star"></i>
                                    <i class="icofont icofont-star"></i>
                                    <i class="icofont icofont-star"></i>
                                </div>
                                <h4>180k voters</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="video-area">
                                <img src="assets/img/video/video2.png" alt="video" />
                                <a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
                                    <i class="icofont icofont-ui-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="video-area">
                                <img src="assets/img/video/video3.png" alt="video" />
                                <a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube">
                                    <i class="icofont icofont-ui-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- video section end -->

    <!-- footer section start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <img src="assets/img/CTlogo.png" alt="about" />
                        <p>MMU, Melaka</p>
                        <h6><span>Call us: </span>(+60) 111 222 3456</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4>Buy Tickets</h4>
                        <ul>
                            <li><a href="#">Buy movie tickets</a></li>
                            <li><a href="#">Book a Show</a></li>
                            <li><a href="#">Online Tickets</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4>Social Links</h4>
                        <ul class="social">
                            <li><a href="#"><i class="icofont icofont-facebook"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-twitter"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-pinterest"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- footer section end -->
    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Slick nav js -->
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Magnific popup js -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- jquery.ajaxchimp.min js -->
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Main slider carousel
        $(".hero-area-slider").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 4000,
            nav: true,
            dots: false,
            mouseDrag: true,
            items: 1,
            navText: [
                '<i class="icofont icofont-long-arrow-left"></i>',
                '<i class="icofont icofont-long-arrow-right"></i>',
            ],
        });
        // Thumbnail carousel
        $(".hero-area-thumb").owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            items: 1,
            thumbs: true,
            thumbImage: true,
            thumbContainerClass: 'owl-thumbs',
        });
    </script>
</body>

</html>
