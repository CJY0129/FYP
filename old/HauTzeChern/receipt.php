


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Website - Payment</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <header>
    <div class="container">
      <h1>CineTime</h1>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="movies.html">Movies</a></li>
          <li><a href="booking.html">Booking</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

<body>

<section class="payment">
<div class="container">
  
<h2>Below is Your Receipt. Enjoy Your Time.</h2>
        

  <?php 
  
  include("connect_user.php");
  include("booking for.php");
  
   ?>
</div>
</section>
<footer>
    <div class="foot_container">
      <p>&copy; 2024 CineTime</p>
    </div>
  </footer>
</body>
</html>