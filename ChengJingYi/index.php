<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Screen</h2>
        <div class="seats">
            <!-- Seats will be dynamically generated here -->
        </div>
        <button id="bookBtn">Book Selected Seats</button>
        
    </div>
    <?php
// Handle booking request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // You can process the selected seats here and store them in the database
    $selectedSeats = $_POST['seats'];
    // Assuming you have a database connection established
    // Code to insert $selectedSeats into your database
    // Example: INSERT INTO bookings (seat_number) VALUES ($selectedSeat);
    echo json_encode(['success' => true]);
    exit;
}
?>

    <script src="booking.js"></script>
</body>
</html>
