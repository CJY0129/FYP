<?php
include("dataconnect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedSeats = $_POST["selectedSeats"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE seats SET status = 'booked' WHERE seat_number IN (" . implode(",", $selectedSeats) . ")");
    $stmt->execute();

    // You can also perform additional validation and processing here

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
