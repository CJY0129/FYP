<?php
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
    $sql = "SELECT title, poster_path FROM movie WHERE movie_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the movie
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $poster_path = $row["poster_path"];
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
        <h1><a href="../main.php">CineTime</h1>
        <h3>
            <nav>
            <ul>
            <li><a href="Nowshowing.php" class="left-links">Now Showing</a></li>
            <li><a href="Upcoming.php" class="left-links">Upcoming</a></li>
            <li><a href="Comingsoon.php" class="left-links">Coming Soon</a></li>
            <div class="dropdown">
            <button class="dropbtn">
            <i class='fas fa-user-circle'></i><!-- Font Awesome user icon -->
            <?php
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
?>

            </button>
                <div class="dropdown-content">
                    <a href="../customer/Customer.php">View Profile</a>
                    <a href="#" onclick="confirmLogout()">Log out</a>
                </div>
                <script>
                    function confirmLogout() 
                    {
                        var confirmation = confirm("Are you sure you want to log out?");
                        if (confirmation) 
                        {
                            // If user clicks "OK" (true), redirect to the logout page
                            window.location.href = "../main(notlogin).php";
                        } 
                        else 
                        {
                            // If user clicks "Cancel" (false), do nothing
                            return false;
                        }
                }
                </script>
            </div>
            </ul>
            </nav>
        </h3>
    </div>
</header>

            <h1><?php echo $title; ?></h1>
            <div>
                <img src="<?php echo $poster_path; ?>" alt="<?php echo $title; ?>" style="width: 200px;">
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
