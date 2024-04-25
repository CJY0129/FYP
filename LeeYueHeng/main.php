<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Now you can use $user_id as the logged-in user's ID
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="maindes.css"/>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            <div class="dropdown">
            <button class="dropbtn">
            <i class='fas fa-user-circle'></i><!-- Font Awesome user icon -->
            <?php
// Assuming you have established a database connection
include("customer/connection.php");

// Assuming you have a session or some other means of identifying the user

if (isset($_GET['user_id']) && $_GET['user_id'] !=0 ) {
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
        // If no user found, assume it's a guest
        $firstname = "Guest";
        echo $firstname;
    }
} else {
    // If user_id is not set, assume it's a guest
    $firstname="Guest";
    echo $firstname;
}

?>

            </button>
                <div class="dropdown-content">
                    <?php
                    if(isset($user_id) && $user_id != NULL) {
                        echo'<a href="customer/Customer.php?userid='. $user_id .'">View Profile</a>';
                    }
                    ?>
                    <a href="customer/Logout.php">Log out</a>
                </div>
            </div>
            </ul>
            </nav>
        </h3>
    </div>
</header>
<div class="slideshow-container">

<div class="mySlides fade">
    <a href="Moviedetails/moviedesc.php?id=1">
        <img src="Moviedetails/movie1.jpg" style="width:300px; height: 400px">
    </a>
    <div class="text">Endgame</div>
</div>

<div class="mySlides fade">
    <a href="Moviedetails/moviedesc.php?id=2">
        <img src="Moviedetails/movie2.jpg" style="width:300px; height: 400px">
    </a>
    <div class="text">Jaws</div>
</div>

<div class="mySlides fade">
    <a href="Moviedetails/moviedesc.php?id=3">
        <img src="Moviedetails/movie3.jpg" style="width:300px; height: 400px">
    </a>
    <div class="text">Jaws</div>
</div>

</div>
    <br>


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            slides[slideIndex-1].style.display = "block";  
            setTimeout(showSlides, 5000); // Change image every 5 seconds
        }
    </script>

</body>
</html>
