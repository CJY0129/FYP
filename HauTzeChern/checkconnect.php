<?php
// Establish database connection
include("testseesion.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    // Retrieve user ID from form submission
    $user_id = 2;

    // Prepare SQL statement to fetch bookings for the given user ID
    $sql = "SELECT * FROM booking WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Booking ID: " . $row["booking_id"] . "<br>";
            echo "Show ID: " . $row["show_id"] . "<br>";
            echo "Seat Number: " . $row["seat_num"] . "<br>";
            echo "Booking Time: " . $row["booking_time"] . "<br>";
            echo "Total Price: " . $row["total_price"] . "<br>";
            echo "Total Person: " . $row["total_person"] . "<br>";
            echo "Status: " . $row["status"] . "<br><br>";
        }
}
?>