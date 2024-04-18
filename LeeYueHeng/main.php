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
            <li><a href="customer/Customer.php" class="right-links">Profile</a></li>
            </ul>
            </nav>
        </h3>
    </div>
</header>
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="movie1.jpg" style="width:300px; height: 400px">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <a href="main.php">
              <img src="movie2.jpg" style="width:300px; height: 400px">
            </a>
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="movie3.jpg" style="width:300px; height: 400px">
            <div class="text">Caption Three</div>
        </div>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }
    </script>
</body>
</html>
