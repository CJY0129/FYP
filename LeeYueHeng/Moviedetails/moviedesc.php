<?php
session_start(); // Start or resume a session

// Logout
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_unset();
    session_destroy();
    header("Location: ../../Userpage/index.php");
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
    include("connection.php");

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
    <link rel="stylesheet" type="text/css" href="design.css" />
</head>

<body>
    <header>
        <div id="container">
            <?php
            if (isset($_GET['user_id']) && $_GET['user_id'] ==0 ):
            ?>
                <h1><a href="../main(notlogin).php">CineTime</a></h1>
            <?php else : ?>
                <h1><a href="../main.php?user_id=<?php echo $user_id; ?>">CineTime</a></h1>
            <?php endif; ?>
            <h3>
                <nav>
                    <ul>
                        <li><a href="Nowshowing.php" class="left-links">Now Showing</a></li>
                        <li><a href="Upcoming.php" class="left-links">Upcoming</a></li>
                        <li><a href="Comingsoon.php" class="left-links">Coming Soon</a></li>
                        <?php
                        if (isset($_GET['user_id']) && $_GET['user_id'] !=0 ){
                            echo '<div class="dropdown">
                            <button class="dropbtn">
                            <i class="fas fa-user-circle"></i><!-- Font Awesome user icon -->';


                            // Assuming you have a session or some other means of identifying the user
                            if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] != 0 && $_SESSION['user_id'] != 1)) {
                                // Assuming you have established a database connection
                                include("../customer/connection.php");
                            
                                // Fetch user data from the database
                                $sql = "SELECT * FROM user WHERE user_id = $user_id"; // Adjust this query according to your database structure
                                $result = $conn->query($sql);
                            
                                // Check if the query returned any rows
                                if ($result->num_rows > 0) {
                                    // Fetch the data from the result set
                                    $row = $result->fetch_assoc();
                            
                                    // Extract gender and first name information from the fetched row
                                    $gender = $row['Gender'];
                                    $firstname = $row['first_name'];
                            
                                    // Output Mr. or Ms. followed by the first name
                                    if ($gender == 'M') {
                                        echo 'Mr. ' . $firstname;
                                    } else {
                                        echo 'Ms. ' . $firstname;
                                    }
                                } else {
                                    echo "No user found"; // Handle case where no user is found
                                }
                            } else {
                                $firstname = "Guest";
                                echo $firstname;
                            }
                            
                        } else {
                            echo '<li><a href="../customer/Login.php" class="right-links">Login/Sign up</a></li>';
                        }
                        ?>
                    </button>
                    <div class="dropdown-content">
                    <?php
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != NULL) {
                            echo '<a href="../customer/Customer.php?userid=' . $_SESSION['user_id'] . '">View Profile</a>';
                        }
                        ?>
                        <a href="?logout=1">Log out</a>

                    </div>
            </div>
            </li>
            </ul>
            </nav>
            </h3>
        </div>
        <?php include("connection.php"); ?>
        <?php
        function displayImage($imageData)
        {
            if (!empty($imageData)) {
                return '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Movie Poster" width="100" height="150">';
            } else {
                return 'No Poster Available';
            }
        }
        ?>
    </header>

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

</html>
