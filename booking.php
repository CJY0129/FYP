<?php
// Assuming you have already retrieved the selected seats and stored them in $selectedSeats array

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "cinetime"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare INSERT statement
$stmt = $conn->prepare("INSERT INTO bookings (user_id, show_id, seat_id, ticket_type_id, booking_time, total_price, num_of_tickets) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$user_id = 1; // Assuming the user_id for the booking
$show_id = 1; // Assuming the show_id for the booking
$ticket_type_id = 1; // Assuming the ticket_type_id for the booking
$booking_time = date("Y-m-d H:i:s"); // Current date and time
$total_price = 10.00; // Assuming the total price for the booking
$num_of_tickets = count($selectedSeats); // Number of tickets booked

$stmt->bind_param("iiisdsi", $user_id, $show_id, $seat_id, $ticket_type_id, $booking_time, $total_price, $num_of_tickets);

// Insert each selected seat into the bookings table
foreach ($selectedSeats as $seat_id) {
    $stmt->execute();
}

// Close statement
$stmt->close();

// Close connection
$conn->close();

echo "Booking successful!";
?>
