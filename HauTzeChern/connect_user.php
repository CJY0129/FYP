<?php

$servername = "localhost";

$dbname = "cinetime";
$conn = new mysqli($servername,'root' , '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// Your existing code for establishing database connection and executing query

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="connection">';
        echo "Username: " . $row["username"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Phone Number: " . $row["phone_number"]. "<br>";
        echo "<br>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>