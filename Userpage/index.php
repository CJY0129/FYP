
<?php
include('connect.php');
session_start();
$user_id = 0;
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
		<link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
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
						<!--<form action="#">
							<select>
								<option value="Movies">Movies</option>
								<option value="Movies">Movies</option>
								<option value="Movies">Movies</option>
							</select>
							<input type="text"/>
							<button><i class="icofont icofont-search"></i></button>
						</form>-->
						<form >
						</form>
						<ul>
							<li><a class="login-popup" href="customer/Login.php">Login</a></li>
						</ul>
					</div>
					<div class="menu-area">
						<div class="responsive-menu"></div>
					    <div class="mainmenu">
                            <ul id="primary-menu">
                                <li><a class="active" href="index.php">Home</a></li>
                                <li><a href="movies.html">Movies</a></li>
								<!-- <li><a href="#">Pages <i class="icofont icofont-simple-down"></i></a>
									<ul>
										<li><a href="blog-details.html">Blog Details</a></li>
										<li><a href="movie-details.html">Movie Details</a></li>
									</ul>
								</li>-->
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
				<h2>LOGIN</h2>
				<form action="#">
					<h6>USERNAME OR EMAIL ADDRESS</h6>
					<input type="text" />
					<h6>PASSWORD</h6>
					<input type="text" />
					<div class="login-remember">
						<input type="checkbox" />
						<span>Remember Me</span>
					</div>
					<div class="login-signup">
						<span>SIGNUP</span>
					</div>
					<a href="#" class="theme-btn">LOG IN</a>
					<span>Or Via Social</span>
					<div class="login-social">
						<a href="#"><i class="icofont icofont-social-facebook"></i></a>
						<a href="#"><i class="icofont icofont-social-twitter"></i></a>
						<a href="#"><i class="icofont icofont-social-linkedin"></i></a>
						<a href="#"><i class="icofont icofont-social-google-plus"></i></a>
						<a href="#"><i class="icofont icofont-camera"></i></a>
					</div>
				</form>
				
			</div>
		</div>
		<?php


// SQL query to retrieve movies based on show_time
$sql = "SELECT m.movie_id, m.title, m.poster_path, s.show_time, s.end_time, s.price 
FROM movie AS m 
INNER JOIN showtime AS s ON m.movie_id = s.Movie_id 
WHERE s.show_time > DATE_SUB(NOW(), INTERVAL 10 MINUTE)
GROUP BY m.movie_id
ORDER BY s.show_time ASC";

$result = $conn->query($sql);

?>

<div class="buy-ticket">
    <div class="container">
        <div class="buy-ticket-area">
            <a href="#"><i class="icofont icofont-close"></i></a>
            <div class="row">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-lg-3">'; // Set col-lg-6 for half width on large screens
                        echo '<div class="buy-ticket-box">';
                        
						if (!empty($row['poster_path'])) {
							$poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
							$poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
							echo '<img src="' . $poster_src . '" alt="Movie Poster" width="165" height="325">';
						} else {
							echo '<p>No poster available</p>';
						}
                        echo '<p><strong>' . $row["title"] . '</strong></p>';
                        
                        // Query to get all upcoming showtimes for this movie
                        $movieId = $row["movie_id"];
                        $showtimesQuery = "SELECT show_id,show_time, end_time, price
                                           FROM showtime
                                           WHERE Movie_id = $movieId AND show_time > NOW()
                                           ORDER BY show_time ASC";
                        $showtimesResult = mysqli_query($conn, $showtimesQuery);
                        if (mysqli_num_rows($showtimesResult) > 0) {
							echo '<p>SHOWTIME</p>';
                            while ($showtimeRow = mysqli_fetch_assoc($showtimesResult)) {
								echo '<p><a href="seat_select.php?show_id=' . $showtimeRow["show_id"] . '">' . $showtimeRow["show_time"] . '</a></p>';
                            }
							
                        } else {
                            echo "<p>No upcoming showtimes found for this movie.</p>";
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
					echo "<p style='color: red; font-weight: bold;'>No movies found with upcoming showtimes within 10 minutes before the current time.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>




<!-- header section end -->
		<!-- hero area start -->
		<section class="hero-area" id="home">
			<div class="container">
				<div class="hero-area-slider">
				<?php
                // Get current date and time


// SQL query to retrieve movies based on show_time
$sql = "SELECT DISTINCT m.*
        FROM showtime s
        INNER JOIN movie m ON s.movie_id = m.movie_id
        WHERE s.show_time > DATE_SUB(NOW(), INTERVAL 10 MINUTE)
        ORDER BY s.show_time";



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
            echo '<img src="' . $poster_src . '" alt="Movie Poster" width="265" height="425">';
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
        echo '<a class="theme-btn theme-btn2" href="../LeeYueHeng/Moviedetails/moviedesc.php?id=' . $row['movie_id'] . '"> More information</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="row hero-area-slide">';
    echo '<div class="col-lg-6 col-md-5">';
    echo '<div class="hero-area-content">';
    // Display movie poster
    if (!empty($row['poster_path'])) {
        $poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
        $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
        echo '<img src="' . $poster_src . '" alt="Movie Poster" width="265" height="425">';
    } else {
        echo '<img src="assets/img/CineTime1.jpg" alt="Movie Poster" width="265" height="425">';
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="col-lg-6 col-md-7">';
    echo '<div class="hero-area-content pr-50">';
    echo '<h2>No Movies Today</h2>';
    echo '<p></p>';
    echo '<h3>Cast: </h3>';
    echo '<div class="slide-trailor">';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

            ?>
</div>
<div class="hero-area-thumb">
					<div class="thumb-prev">
						<div class="row hero-area-slide">
							<div class="col-lg-6">
								<div class="hero-area-content">
									<img src="assets/img/CineTime1.jpg" alt="about" />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="hero-area-content pr-50">
									<h2>Last Avatar</h2>
									<p>She is a devil princess from the demon world. She grew up sheltered by her parents and doesn't really know how to be evil or any of the common actions,   She is unable to cry due to Keita's accidental first wish, despite needed for him to wish...</p>
									<h3>Cast:</h3>
									
									<div class="slide-trailor">
										<h3>Watch Trailer</h3>
										<a class="theme-btn theme-btn2" href="#"><i class="icofont icofont-play"></i> Tickets</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="thumb-next">
						<div class="row hero-area-slide">
							<div class="col-lg-6">
								<div class="hero-area-content">
									<img src="assets/img/CineTime1.jpg" alt="about" />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="hero-area-content pr-50">
									<h2>The Deer God</h2>
									<p>She is a devil princess from the demon world. She grew up sheltered by her parents and doesn't really know how to be evil or any of the common actions,   She is unable to cry due to Keita's accidental first wish, despite needed for him to wish...</p>
									<h3>Cast:</h3>
									
									<div class="slide-trailor">
										<h3>Watch Trailer</h3>
										<a class="theme-btn theme-btn2" href="#"><i class="icofont icofont-play"></i> Tickets</a>
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
								<li data-filter=".Latest" class="active">Latest</li>
								<li data-filter=".up">Upcoming</li>
								<li data-filter=".soon">Coming Soon</li>
							</ul>
						</div>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col-lg-9">
						<div class="row portfolio-item">
							<?php
							//Latest movie
							$sql = "SELECT m.* FROM movie m
							INNER JOIN showtime s ON m.movie_id = s.Movie_id
							WHERE s.show_time > DATE_SUB(NOW(), INTERVAL 10 MINUTE)
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
									//echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube">';
                                    echo '<a href="../LeeYueHeng/Moviedetails/moviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
                                    echo '</a>'; 
									echo '</div>';
									echo '<div class="portfolio-content">';
									echo '<h2>' . $row['title'] . '</h2>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
								}
							}

							//Coming soon movie
							$sql = "SELECT * FROM csmovie";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
    							while ($row = $result->fetch_assoc()) {
        							echo '<div class="col-md-4 col-sm-6 soon">';
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
									echo '<a href="../LeeYueHeng/Moviedetails/moviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
                                    echo '</a>'; 
									echo '</div>';
									echo '<div class="portfolio-content">';
									echo '<h2>' . $row['title'] . '</h2>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
    							}
							}
								
							//Upcoming movie
							$sql = "SELECT * FROM ucmovie";
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo '<div class="col-md-4 col-sm-6 up">';
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
									echo '<a href="../LeeYueHeng/Moviedetails/moviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
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
					
				</div>
			</div>
		</section><!-- portfolio section end -->
		
					
		<!-- footer section start -->
		<footer class="footer">
			<div class="container">
				<div class="row">
                    <div class="col-lg-3 col-sm-6">
						<div class="widget">
							<img src="assets/img/CTlogo.png" alt="about" />
							<p>MMU,Melaka</p>
							<h6><span>Call us: </span>(+60) 111 222 3456</h6>
						</div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
						<div class="widget">
							<h4>Legal</h4>
							<ul>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Security</a></li>
							</ul>
						</div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
						<div class="widget">
							<h4>Account</h4>
							<ul>
								<li><a href="#">My Account</a></li>
								<li><a href="#">Watchlist</a></li>
								<li><a href="#">Collections</a></li>
								<li><a href="#">User Guide</a></li>
							</ul>
						</div>
                    </div>
                    
				</div>
				<hr />
			</div>
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 text-center text-lg-left">
							<div class="copyright-content">
							<p class="no-margin-bottom">2024 &copy; CineTime.</p>
							</div>
						</div>
						<div class="col-lg-6 text-center text-lg-right">
							<div class="copyright-content">
								<a href="#" class="scrollToTop">
									Back to top<i class="icofont icofont-arrow-up"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- footer section end -->
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
	</body>
<?php
$conn->close();

?>
</html>