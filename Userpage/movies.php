<?php 
session_start(); // Start or resume a session
include("connection.php");

// Check if the 'userid' parameter is set in the URL
if(isset($_GET['userid'])) {
    // Retrieve the user ID from the URL
    $user_id = $_GET['userid'];
    
    // Fetch user data from the database based on the user ID
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE HTML>
<html lang="zxx">
	
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Movies</title>
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
    <link rel="stylesheet" type="text/css" href="assets/css/movies.css" media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>   
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>
		<!-- header section start -->
		<?php include('header.php'); ?>
		<section class="hero-area" id="home">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left" style="margin-top: 200px; margin-bottom:-100px;">
                <div class="section-title" >
                    <h1><i class="icofont icofont-movie"></i> Movies</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right" style="margin-top: 200px; margin-bottom:-100px;">
                <div class="section-title"style="padding-bottom:20px;">
                    <ul class="portfolio-menu">
                        <li id="nowShowingFilter" data-filter=".Latest" class="active">Now Showing</li>
                        <li data-filter=".up">Upcoming</li>
                        <li data-filter=".soon">Coming Soon</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('buytickets.php'); ?>	
				
				<hr style="margin-top: 200px; margin-bottom:-230px;"/>
				<section class="portfolio-area pt-60 video ptb-90 ">
			<div class="container">
				<div class="row flexbox-center">
					
					<div class="col-lg-6 text-center text-lg-right">
					    <div class="portfolio-menu">
						<ul>
                        <!-- Add id="nowShowingFilter" to target it with JavaScript -->
                        
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
							$sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie";
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
										echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 240px; height: 400px;">';
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
		</section>
					<!-- hero area end -->
		<!-- portfolio section start -->
		

        <?php
			include('footer.php');
		?>
    </body>
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