<?php 
session_start();
include("admin/connect.php"); // Include your database connection file here
$user_id = 0;

// Check if the user is logged in and get their user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Fetch showtimes from the database
$now = date('Y-m-d H:i:s'); // Get the current date and time
$showtime_query = "SELECT * FROM showtime WHERE end_time > '$now'";
$showtime_result = mysqli_query($conn, $showtime_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="asdf.css"/>
</head>
<body>
    <header>
        <div id="container">
            <h1>CineTime</h1>
            <h3>
                <nav>
                    <ul>
                        <li><a href="Nowshowing.php" class="left-links">Now Showing</a></li>
                        <li><a href="Upcoming.php" class="left-links">Upcoming</a></li>
                        <li><a href="Comingsoon.php" class="left-links">Coming Soon</a></li>
                        <?php if($user_id == 0): ?>
                            <li><a href="customer/Login.php" class="right-links">Login/Sign up</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </h3>
        </div>
    </header>

    <div class="horizontal-scroll-wrapper squares">
    <?php 
    // Fetch all movies from the database
    $movie_query = "SELECT * FROM movie";
    $movie_result = mysqli_query($conn, $movie_query);

    // Loop through each movie to display its poster and title
    while ($movie_row = mysqli_fetch_assoc($movie_result)): ?>
        <div class="movie-item">
            <?php
            // Display movie poster if available
            if (!empty($movie_row['poster_path'])) {
                $poster_data = base64_encode($movie_row['poster_path']); // Convert blob data to base64
                $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
                echo '<img src="' . $poster_src . '" alt="" >';
            } else {
                echo '<p>No poster available</p>';
            }
            ?>
            <div class="title-in">
                <h6><a href="#"><?php echo $movie_row['title']; ?></a></h6>
            </div>
        </div>
    <?php endwhile; ?>
</div>

    </section>
</body>
</html>
