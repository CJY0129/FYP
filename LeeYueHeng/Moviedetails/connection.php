<?php
$servername = "localhost";
$database = "cinetime";

$conn = new mysqli($servername, 'root', '', $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>