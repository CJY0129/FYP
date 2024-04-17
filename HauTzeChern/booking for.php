<?php
$servername = "localhost";

$dbname = "cinetime";
$conn = new mysqli($servername,'root' , '', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

?>





