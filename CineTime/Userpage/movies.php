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
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>   
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php include('header.php'); ?>
    <?php include('buytickets.php'); ?>
    <section class="hero-area" id="home">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6 text-center text-lg-left" style="margin-top: 200px; padding-bottom:50px">
                    <div class="section-title">
                        <h1><i class="icofont icofont-movie"></i> Movies</h1>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right" style="margin-top: 200px; padding-bottom:50px;">
                    <div class="section-title" style=" padding-left:200px;">
                        <ul class="portfolio-menu">
                            <li data-filter=".Latest" class="active">Now Showing</li>
                            <li data-filter=".up">Upcoming</li>
                            <li data-filter=".soon">Coming Soon</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr id="now-showing-line" />
            <div class="row">
                <div class="col-lg-9">
                    <div class="row portfolio-item">
                        <?php
                        // Latest movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=0 LIMIT 3";
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
                                // echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube">';
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

                        // Coming soon movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=2 LIMIT 3";
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
                        
                        // Upcoming movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=1 LIMIT 3";
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
            </div>
        </div>
    </section>

    <!-- Movie Posters outside of hero-area -->
    <section class="portfolio-area pt-60 video ptb-90 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row portfolio-item">
                        <?php
                        // Latest movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=0 LIMIT 3, 18446744073709551615";
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
                                // echo '<a href="' . $row['trailers_path'] . '" class="popup-youtube">';
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

                        // Coming soon movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=2 LIMIT 3, 18446744073709551615";
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
                        
                        // Upcoming movie
                        $sql = "SELECT movie_id, title, poster_path, trailers_path FROM movie WHERE status=1 LIMIT 3, 18446744073709551615";
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
            </div>
        </div>
    </section><!-- portfolio section end -->
        
    <!-- footer section start -->
    <?php include('footer.php'); ?>
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slicknav.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the Buy Ticket button
        var buyTicketButton = document.getElementById('buy-ticket-button');
        
        // Get the line under "Now Showing"
        var nowShowingLine = document.getElementById('now-showing-line');
        
        // Add click event listener to the Buy Ticket button
        buyTicketButton.addEventListener('click', function() {
            // Hide the line
            nowShowingLine.style.display = 'none';
        });
        
        // Logout confirmation
        document.getElementById('logout').addEventListener('click', function(event) {
            if (!confirm('Are you sure you want to log out?')) {
                event.preventDefault();
            }
        });
    });
</script>
</html>
