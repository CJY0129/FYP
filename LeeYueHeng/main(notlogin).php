<?php 
    session_start();
    $user_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="maindes.css"/>
</head>
<body>
<div id="preloader"></div>
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
    
    <div class="slideshow-container">
        <div class="mySlides fade">
            <a href="Moviedetails/moviedesc.php?id=1&user_id=<?php echo $user_id; ?>">
                <img src="Moviedetails/movie1.jpg" style="width:300px; height: 400px">
            </a>
            <div class="text">Endgame</div>
        </div>

        <div class="mySlides fade">
            <a href="Moviedetails/moviedesc.php?id=2&user_id=<?php echo $user_id; ?>">
                <img src="Moviedetails/movie2.jpg" style="width:300px; height: 400px">
            </a>
            <div class="text">Jaws</div>
        </div>

        <div class="mySlides fade">
            <a href="Moviedetails/moviedesc.php?id=3&user_id=<?php echo $user_id; ?>">
                <img src="Moviedetails/movie3.jpg" style="width:300px; height: 400px">
            </a>
            <div class="text">68</div>
        </div>
    </div>
    <br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
