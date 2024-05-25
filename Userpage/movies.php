<?php 
session_start(); 
include("connection.php");

if(isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
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
    <link rel="icon" type="image/png" href="assets/img/CT.ico" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/movies.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>   
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php include('header.php'); ?>
    <section class="hero-area" id="home">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6 text-center text-lg-left" style="margin-top: 200px; margin-bottom:-100px; padding-bottom:50px">
                    <div class="section-title">
                        <h1><i class="icofont icofont-movie"></i> Movies</h1>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right" style="margin-top: 200px; margin-bottom:-100px; padding-bottom:50px;">
                    <div class="section-title" style="padding-bottom:20px; padding-left:200px;">
                        <ul class="portfolio-menu">
                            <li id="nowShowingFilter" data-filter=".Latest" class="active">Now Showing</li>
                            <li data-filter=".up">Upcoming</li>
                            <li data-filter=".soon">Coming Soon</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row portfolio-item">
                <?php
                $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie LIMIT 4";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 col-sm-6 Latest">';
                        echo '<div class="single-portfolio">';
                        echo '<div class="single-portfolio-img">';
                        if (!empty($row['poster_path'])) {
                            $poster_data = base64_encode($row['poster_path']);
                            $poster_src = 'data:image/jpg;base64,' . $poster_data;
                            echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 100%; height: auto; margin-top: 50px;">';
                        } else {
                            echo '<p>No poster available</p>';
                        }
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
                ?>
            </div>
        </div>
    </section>

    <!-- Movie Posters outside of hero-area -->
    <section class="portfolio-area pt-60 video ptb-90">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6 text-center text-lg-right">
                    
                </div>
            </div>
            <!-- Movie Posters -->
            <div class="row portfolio-item">
                <?php
                // Fetch movie posters based on different categories
                // Note: Adjust SQL queries based on your database structure
                // For demonstration purposes, I'll assume you have separate tables for different categories of movies.
                
                // Now Showing
                $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie LIMIT 4, 18446744073709551615";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 col-sm-6 Latest">';
                        echo '<div class="single-portfolio">';
                        echo '<div class="single-portfolio-img">';
                        if (!empty($row['poster_path'])) {
                            $poster_data = base64_encode($row['poster_path']);
                            $poster_src = 'data:image/jpg;base64,' . $poster_data;
                            echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 100%; height: auto;">';
                        } else {
                            echo '<p>No poster available</p>';
                        }
                        echo '<a href="moviedesc.php?id=' . $row['movie_id'] . '" class="popup-2">';
                        echo '<i><b>Movie Description</b></i>';
                        echo '</a>';
                        echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube2">';
                        echo '<i><b>Play Trailer</b></i>';
                        echo '</a>'; 
                        echo '</div>';
                        echo '<div class="portfolio-content">';
                        echo '<h2>' .$row['title'] . '</h2>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						}
						}
						            // Coming Soon
									$sql = "SELECT * FROM csmovie";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo '<div class="col-md-3 col-sm-6 soon">';
											echo '<div class="single-portfolio">';
											echo '<div class="single-portfolio-img">';
											if (!empty($row['poster_path'])) {
												$poster_data = base64_encode($row['poster_path']);
												$poster_src = 'data:image/jpg;base64,' . $poster_data;
												echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 100%; height: auto;">';
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
						
									// Upcoming
									$sql = "SELECT * FROM ucmovie";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo '<div class="col-md-3 col-sm-6 up">';
											echo '<div class="single-portfolio">';
											echo '<div class="single-portfolio-img">';
											if (!empty($row['poster_path'])) {
												$poster_data = base64_encode($row['poster_path']);
												$poster_src = 'data:image/jpg;base64,' . $poster_data;
												echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: 100%; height: auto;">';
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
						</section>
						<?php include('footer.php'); ?>
						</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slicknav.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
    $(document).ready(function(){
        $('.portfolio-menu li').on('click', function(){
            var filterValue = $(this).attr('data-filter');
            $('.portfolio-menu li').removeClass('active');
            $(this).addClass('active');
            
            // Hide all posters initially
            $('.portfolio-item > div').hide();
            
            // Show posters based on the selected filter
            $('.portfolio-item > div' + filterValue).show('1000');
        });
    });
    document.getElementById('logout').addEventListener('click', function(event) {
        if (!confirm('Are you sure you want to log out?')) {
            event.preventDefault();
        }
    });
</script>
</html>
						
