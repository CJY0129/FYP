


<?php

$servername = "localhost";

$dbname = "cinetime";
$conn = new mysqli($servername,'root' , '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM booking";
"SELECT title FROM movie WHERE movie_id = " . $row['Movie_id'];
$result = $conn->query($sql);

// Your existing code for establishing database connection and executing query

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="connection">';
        echo "Booking ID: " . $row["booking_id"]. "<br>";
        echo "User ID: " . $row["user_id"]. "<br>";
        echo "Show ID: " . $row["show_id"]. "<br>";
        echo "Seat Num: " . $row["seat_num"]. "<br>";
        
        echo "Booking Time: " . $row["booking_time"]. "<br>";
        echo "Total Price: " . $row["total_price"]. "<br>";
        echo "Total Person: " . $row["total_person"]. "<br>";
        echo "<br>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>






