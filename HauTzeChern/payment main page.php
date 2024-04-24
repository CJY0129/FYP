<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Website - Payment</title>
  <link rel="stylesheet" type="text/css" href="cs2.css">
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

  <div class="form-group">
        <label for="connection">Booking Details</label>
  <?php include("booking for.php");?>
</div>
  <section class="payment">
    <div class="container">
      <h3>Select payment method</h3>
      <button type="button" class="pay-now-btn">
      
        <a href="online banking.php">Online Banking</a>

    </button>

    <button type="button" class="pay-now-btn">
      
        <a href="card.php">Credit card/Debit card</a>
        </button>
       

    

    <button type="button" class="pay-now-btn">
        
        <a href="receipt.php">Pay at counter</a>
    </button>
      
    </div>
  </section>
  <footer>
    <div class="foot_container">
      <p>&copy; 2024 CineTime</p>
    </div>
  </footer>
</body>
</html>