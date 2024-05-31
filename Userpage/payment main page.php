<?php 
include('connect.php');

$selected_seats = explode(',', $_SESSION['selected_seats']);
$conflict_seats = array_intersect($selected_seats, $booked_seats);
if (!empty($conflict_seats)) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?error=1">';
    exit();
}
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

    <section class="booking-details">
      <div class="container">
        <h2>Booking Details</h2>
        <p><strong>Name:</strong> <?= $_SESSION['first_name']?></p>
        <p><strong>Total Price:</strong> RM <?= $_SESSION['totalprice']?></p><br>

        
      </div>
    </section>

    <section class="payment-methods">
  <div class="container">
    <h3>Select payment method</h3>
    <ul>
      <li><button style="color:black" onclick="window.location.href='card.php' ">Credit card/Debit card</button></li>
      <li><button style="color:black"onclick="window.location.href='booking.php?receipt=1'">Pay at counter</button></li>
    </ul>
  </div>
</section>

</body>
</html>

