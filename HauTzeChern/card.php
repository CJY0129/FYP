
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
  
  <section class="payment">
    <div class="container">
      <h2>Make A Payment</h2>
      <form action="payment_process.php" method="POST">

      <div class="form-group">
        <label for="connection">Booking Details<br><br></label>

  <?php include("booking for.php");?>
</div>

      <div class="mode">
        <label for="mode">Card Type</label>
          <select name="mode">
            <option value = "CIMB" >CIMB</option>
            <option value = "Maybank" >Maybank</option>
            <option value = "Public Bank" >Public Bank</option>
            <option value = "RHB" >RHB</option>
</select>

</div>

        <div class="form-group">
          <label for="card-number">Card Number</label>
          <input type="number" id="card-number" name="card-number" placeholder="Enter your card number"  min="16" max="19" >
        </div>
        <div class="form-group">
          <label for="expiration-date">Expiration Date</label>
          <input type="date" id="expiration-date" name="expiration-date" placeholder="DD/MM/YYYY" >
        </div>
        <div class="form-group">
          <label for="cvv">CVV</label>
          <input type="text" id="cvv" name="cvv" placeholder="CVV" >
        </div>
        <div class="form-group">
          <label for="email">Your Email</label>
          <input type="text" id="email" name="email" placeholder="xxxxxxxxxx@gmail.com" >
        </div>
        <button>

        <a href="receipt.php">Pay Now</a>
</button>
      </form>
    </div>
  </section>
  <footer>
    <div class="container">
      <p>&copy; 2024 CineTime</p>
    </div>
  </footer>
</body>
</html>


