<?php
$servername = "localhost";

$dbname = "cinetime";
$conn = new mysqli($servername,'root' , '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

// Your existing code for establishing database connection and executing query

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Booking ID: " . $row["booking_id"]. "<br>";
        echo "User ID: " . $row["user_id"]. "<br>";
        echo "Show ID: " . $row["show_id"]. "<br>";
        echo "Seat ID: " . $row["seat_id"]. "<br>";
        echo "Ticket Type ID: " . $row["ticket_type_id"]. "<br>";
        echo "Booking Time: " . $row["booking_time"]. "<br>";
        echo "Total Price: " . $row["total_price"]. "<br>";
        echo "Total Person: " . $row["total_person"]. "<br>";
        echo "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>

?>





