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
    $id = $_GET['id'];

    // Check if user is logged in and get user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } elseif (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    } else {
        $user_id = 1; // Default user_id for guest
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
    } else {
        echo "Movie not found.";
        exit; // Stop script execution if movie is not found
    }
} else {
    echo "No movie ID provided.";
    exit; // Stop script execution if no movie ID is provided
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
</head>

<body>
        <?php
			include('header.php');
		?>

    <h1><?php echo $title; ?></h1>
    <div>
        <?php
        if (!empty($poster_path)) {
            echo '<td>' . displayImage($poster_path) . '</td>';
        } else {
            echo '<td>No Poster Available</td>';
        }
        ?>
        <h3><?php echo "Genre: " . $genre; ?></h3>
        <p><?php echo "Director: " . $director; ?></p>
        <p><?php echo "Cast: " . $cast; ?></p>
        <p><?php echo "Description: " . $desc; ?></p>
        <p><?php echo "Duration: " . $duration; ?></p>
        <p><?php echo "Release Date: " . $release; ?></p>
    </div>
    <button onclick="history.back()">Go Back</button>
</body>

<?php include('footer.php');?>
</html>
