<?php
session_start(); // Start or resume a session

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the movie ID from the URL
    $id = $_GET['id'];
    
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        // Now you can use $user_id as the logged-in user's ID
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
        $poster_path = $row["poster_path"];
        $genre=$row["genre"];
        $director=$row["director"];
        $cast=$row["cast"];
        $desc=$row["synopsis"];
        $duration=$row["duration"];
        $release=$row["release_date"];
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $title; ?></title>
            <link rel="stylesheet" type="text/css" href="design.css"/>
        </head>
        <body>
        <header>
        <div id="container">
        <h1><a href="../main.php">CineTime</a></h1>
        <h3>
            <nav>
            <ul>
            <li><a href="Nowshowing.php" class="left-links">Now Showing</a></li>
            <li><a href="Upcoming.php" class="left-links">Upcoming</a></li>
            <li><a href="Comingsoon.php" class="left-links">Coming Soon</a></li>
            <?php 
            if($user_id == 0)
            {
                echo '<li><a href="../customer/Login.php" class="right-links">Login/Sign up</a></li>';
            }
            else
            {
                echo '<div class="dropdown">
                <button class="dropbtn">
                <i class="fas fa-user-circle"></i><!-- Font Awesome user icon -->';

                // Assuming you have established a database connection
                include("../customer/connection.php");

                // Assuming you have a session or some other means of identifying the user
                if(isset($user_id) && $user_id != NULL) {
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
            $firstname="Guest";
            echo $firstname;
        }
    }
    ?>

            </button>
                <div class="dropdown-content">
                    <a href="../customer/Customer.php">View Profile</a>
                    <a href="#" onclick="confirmLogout()">Log out</a>
                </div>
                </div>
                </li> <!-- Missing closing tag -->
                </ul>
            </nav>
        </h3>
    </div>
    <?php
    function displayImage($imageData) {
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
            echo '<td>' . displayImage($row['poster_path']) . '</td>';
            ?>
                <h3><?php echo "Genre: " . $genre; ?></h3>
                <p><?php echo "Director: " . $director; ?></p>
                <p><?php echo "Cast: " . $cast; ?></p>
                <p><?php echo "Description: " . $desc; ?></p>
                <p><?php echo "Duration: " . $duration; ?></p>
                <p><?php echo "Release Date: " . $release; ?></p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Movie not found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "No movie ID provided.";
}

?>
