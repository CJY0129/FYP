<?php

$servername = "localhost";
$dbname = "cinetime";
$conn = new mysqli($servername, 'root', '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM booking";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="connection">';
        echo "Booking ID: " . $row["booking_id"] . "<br>";
        $user_query = "SELECT username FROM user WHERE user_id = " . $row['user_id'];
        $user_result = $conn->query($user_query);
        $user_row = $user_result->fetch_assoc();
        echo "User: " . $user_row["username"] . "<br>";
        echo "Show ID: " . $row["show_id"] . "<br>";

        $showtime_query = "SELECT movie_id FROM showtime WHERE show_id = " . $row['show_id'];
        $showtime_result = $conn->query($showtime_query);
        $showtime_row = $showtime_result->fetch_assoc();
        $movie_query = "SELECT title FROM movie WHERE movie_id = " . $showtime_row['movie_id'];
        $movie_result = $conn->query($movie_query);
        $movie_row = $movie_result->fetch_assoc();
        echo "Movie: " . $movie_row["title"] . "<br>";
        
        $showtime_query = "SELECT hall_id FROM showtime WHERE show_id = " . $row['show_id'];
        $showtime_result = $conn->query($showtime_query);
        $showtime_row = $showtime_result->fetch_assoc();
        $hall_query = "SELECT * FROM hall WHERE hall_id = " . $showtime_row['hall_id'];
        $hall_result = $conn->query($hall_query);
        $hall_row = $hall_result->fetch_assoc();
        echo "Hall Num: " . $hall_row["hall_id"] . "<br>";
        echo "Hall Type: " . $hall_row["hall_type_id"] . "<br>";
        
        echo "Seat Num: " . $row["seat_num"] . "<br>";
        echo "Booking Time: " . $row["booking_time"] . "<br>";
        echo "Total Price: " . $row["total_price"] . "<br>";
        echo "Total Person: " . $row["total_person"] . "<br>";
        echo "<br>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>