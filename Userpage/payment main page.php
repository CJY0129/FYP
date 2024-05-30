<?php 
session_start();
include('connect.php');


$user_id = $_SESSION['user_id'];

if($user_id != 0) {
    $sql = "SELECT email, phone_number FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone_number'];
    } else {
        echo "Error: User details not found.";
        exit();
    }
} else {
  $_SESSION['first_name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone'] = $_POST['phone'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Website - Payment</title>
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
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


        
        <p><strong>Name:</strong> <?= $_SESSION['first_name']?></p>
        <p><strong>Movie Title:</strong> <?=$_SESSION['title']; ?></p>
        <p><strong>Price:</strong> <?= $_SESSION['totalprice']?></p>
        <p><strong>Hall:</strong> <?= $_SESSION['hall_id'] ?></p>
        <p><strong>Seats:</strong> <?= $_SESSION['selected_seats'] ?></p>
          
      </div>
    </section>

    <section class="payment-methods">
  <div class="container">
    <h3>Select payment method</h3>
    <ul>
      <li><button onclick="window.location.href='card.php' ">Credit card/Debit card</button></li>
      <li><button onclick="window.location.href='receipt.php'">Pay at counter</button></li>
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

