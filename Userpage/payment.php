<?php
require "vendor/autoload.php"; // Autoload Composer dependencies

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $text = "Name: $name\nEmail: $email\nPhone: $phone\nHall:".$_SESSION['hall_id']."\nShowTime:".$_SESSION['show_id']."\n";
    $qr_code = QrCode::create($text);
    $writer = new PngWriter();
    $result = $writer->write($qr_code);
    
    header("Content-Type: " . $result->getMimeType());
    echo $result->getString();
    $result->saveToFile("QR.png");

} else {
    header("Location: index.php");
    exit();
}
?>
