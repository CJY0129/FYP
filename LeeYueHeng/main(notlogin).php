<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="maindes.css"/>
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
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <form method="post">
                                <li><button type="submit" name="logout" class="right-links">Logout</button></li>
                            </form>
                        <?php else: ?>
                            <li><a href="customer/Login.php" class="right-links">Login/Sign up</a></li>
                        <?php endif; ?>
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
            <img src="Moviedetails/movie3.jpg" style="width:300px; height: 400px">
            <div class="text">68</div>
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
