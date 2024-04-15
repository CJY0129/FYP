<?php
$servername = "localhost";
$database = "theater_cus";

$conn = new mysqli($servername, 'root', '', $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Customers";
$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

?>