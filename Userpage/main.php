<?php
// Prevent the browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

include('connect.php');
session_start();

// Check if user is logged in and session variables are set
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT Gender, first_name FROM user WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Set session variables based on retrieved data
    $row = $result->fetch_assoc();
    $_SESSION['Gender'] = $row['Gender'];
    $_SESSION['first_name'] = $row['first_name'];
} else {
    // Handle case where user details are not found
    // Redirect to login page or display an error message
}

if (isset($_GET['error']) && $_GET['error'] == '1') 
{
	echo '<script>alert("Error: The following seats are already booked.")</script>';
}

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
		<?php include('header.php'); ?>
		




<?php include('buytickets.php'); ?>




<!-- header section end -->
		<!-- hero area start -->
		
		<section class="hero-area" id="home">
			<div class="container">
				<div class="row flexbox-center">
					<div class="col-lg-6 text-center text-lg-left"  style="margin-top: 200px; margin-bottom:-190px;">
					    <div class="section-title">
							<h1><i class="icofont icofont-movie"></i> Spotlight Of The Month</h1>
						</div>
					</div>
					<div class="col-lg-6 text-center text-lg-right">
					    <div class="portfolio-menu">
							
						</div>
					</div>
				</div>
				<hr style="margin-top: 200px; margin-bottom:-230px;"/>
				
				<div class="hero-area-slider">
					
				<?php
                // Get current date and time


// SQL query to retrieve movies based on show_time
// SQL query to select one random movie
$sql = "SELECT movie_id, title, poster_path, synopsis, cast FROM movie ORDER BY RAND() LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
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
    echo '<h2>' . $row['title'] . '</h2>';
    echo '<p>' . $row['synopsis'] . '</p>';
    echo '<h3>Cast: ' . $row['cast'] . '</h3>';
    echo '<div class="slide-trailor">';
    echo '<a class="theme-btn theme-btn2" href="moviedesc.php?id=' . $row['movie_id'] . '"> More information</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="row hero-area-slide">';
    echo '<div class="col-lg-6 col-md-5">';
    echo '<div class="hero-area-content">';
    echo '<img src="assets/img/CineTime1.jpg" alt="Movie Poster" width="265" height="425">';
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
		<section class="portfolio-area pt-60 video ptb-90 ">
			<div class="container">
				<div class="row flexbox-center">
					<div class="col-lg-6 text-center text-lg-left">
					    <div class="section-title">
						<h1><i class="icofont icofont-movie"></i> Movies</h1>
						</div>
					</div>
					<div class="col-lg-6 text-center text-lg-right">
					    <div class="portfolio-menu">
							<ul>
								<li data-filter=".Latest" class="active">Now Showing</li>
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
							$sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie ORDER BY RAND() LIMIT 3";
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
                                    echo '<a href="moviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
                                    echo '</a>'; 
									echo '</div>';
									echo '<div class="portfolio-content">';
									echo '<h2>' . $row['title'] . '</h2>';
									echo '<a href="movies.php" class="btn-view-all">View All</a>';
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
									echo '<a href="csmoviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
                                    echo '</a>'; 
									echo '</div>';
									echo '<div class="portfolio-content">';
									echo '<h2>' . $row['title'] . '</h2>';
									echo '<a href="movies.php" class="btn-view-all">View All</a>';
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
									echo '<a href="ucmoviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                                    echo '<i><b>Movie Description</b></i>';
									echo '</a>';
                                    echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
									echo '<i><b>Play Trailer</b></i>';
                                    echo '</a>'; 
									echo '</div>';
									echo '<div class="portfolio-content">';
									echo '<h2>' . $row['title'] . '</h2>';
									echo '<a href="movies.php" class="btn-view-all">View All</a>';
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
		<?php include('footer.php');?>
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
<script>
    document.getElementById('logout').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to log out?')) {
            event.preventDefault();
        }
    });
	
</script>
</html>

<?php
$conn->close();

?>
</html>