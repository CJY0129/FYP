<?php
session_start(); // Start or resume a session

// Logout
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the movie ID from the URL
    $id = intval($_GET['id']); // Use intval to ensure the ID is an integer

    // Check if user is logged in and get user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } elseif (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    } else {
        $user_id = 0; // Default user_id for guest
    }

    // Include the database connection
    include('connect.php');

    // Query to retrieve movie details based on the ID
    $sql = "SELECT * FROM movie WHERE movie_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the movie
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $genre = $row["genre"];
        $director = $row["director"];
        $cast = $row["cast"];
        $desc = $row["synopsis"];
        $duration = $row["duration"];
        $release = $row["release_date"];
        $poster_path = $row["poster_path"];
        $trailers_path = $row["trailers_path"];
    } else {
        echo "Movie not found.";
        exit; // Stop script execution if movie is not found
    }
} else {
    echo "No movie ID provided.";
    exit; // Stop script execution if no movie ID is provided
}

if (isset($_GET['error']) && $_GET['error'] == '1') {
    echo '<script>alert("Error: The following seats are already booked.")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
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
    <!-- Custom CSS -->
    
</head>

<body>
    <?php include('header.php'); ?>
    <?php include('buytickets.php'); ?>

    <section class="hero-area" id="home">
    <div class="container123">
        <div class="movie-card mt-5 extra-margin-top">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="card-body text-center">
                        <!-- Display movie poster -->
                        <div class="img-container">
                            <?php
                            if (!empty($poster_path)) {
                                $poster_data = base64_encode($poster_path); // Convert blob data to base64
                                $poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
                                echo '<img src="' . $poster_src . '" alt="Movie Poster" style="width: auto; height: 325px;">'; // Adjusted size
                            } else {
                                echo '<img src="assets/img/CineTime1.jpg" alt="Movie Poster" style="width: auto; height: 325px;">'; // Adjusted size
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlspecialchars($title); ?></h2>
                        <p class="card-text"><strong>Genre:</strong> <?php echo htmlspecialchars($genre); ?></p>
                        <p class="card-text"><strong>Director:</strong> <?php echo htmlspecialchars($director); ?></p>
                        <p class="card-text"><strong>Cast:</strong> <?php echo htmlspecialchars($cast); ?></p>
                        <p class="card-text"><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?> mins</p>
                        <p class="card-text"><strong>Release Date:</strong> <?php echo htmlspecialchars($release); ?></p>
                        <p class="card-text"><strong>Synopsis:</strong> <?php echo htmlspecialchars($desc); ?></p>
                        <!-- Updated link for the trailer -->
                        <p class="card-text">
                            <a href="<?php echo htmlspecialchars($trailers_path); ?>" class="theme-btn popup-youtube2"><strong>Play Trailer</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 
    

    <button class="btn btn-primary mt-3" onclick="history.back()">Go Back</button>

    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
            if (!confirm('Are you sure you want to log out?')) {
                event.preventDefault();
            }
        });
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/main.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
y