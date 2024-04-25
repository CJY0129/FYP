<?php ?>

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

  <main>
    <section class="booking-details">
      <div class="container">
        <h2>Booking Details</h2>
        <?php include("booking for.php"); 
          include("connect_user.php");
          ?>
      </div>
    </section>

    <section class="payment-methods">
      <div class="container">
        <h3>Select payment method</h3>
        <ul>
          <li><a href="online banking.php">Online Banking</a></li>
          <li><a href="card.php">Credit card/Debit card</a></li>
          <li><a href="receipt.php">Pay at counter</a></li>
        </ul>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2024 CineTime</p>
    </div>
  </footer>
</body>
</html>
