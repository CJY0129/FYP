<?php
include ("connect.php");
require "vendor/autoload.php"; 

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;




$numbers = explode(',', $_SESSION['selected_seats']);
        $total = count($numbers);

        $sql = "INSERT INTO booking (user_id, show_id, seat_num, booking_time, total_price, total_person, status) 
                VALUES ('".$_SESSION['user_id']."', '".$_SESSION['show_id']."', '".$_SESSION['selected_seats']."', '".date('Y-m-d H:i:s')."', '".$_SESSION['price']."', '".$total."', 1)";


        if ($conn->query($sql) === TRUE) {
            $booking_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        

if(($_SESSION['user_id'])==0){

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        $text = "Booking ID: $booking_id\nName: $name\nEmail: $email\nPhone: $phone\nHall:".$_SESSION['hall_id']."\nShowTime:".$_SESSION['show_id']."\n";
        $qr_code = QrCode::create($text);
        $writer = new PngWriter();
        $result = $writer->write($qr_code);
        
        header("Content-Type: " . $result->getMimeType());
        echo $result->getString();
        $result->saveToFile("QR.png");
        $conn->close();
    

    } else {
        header("Location: index.php?error=Unauthorized Access");
        exit();
    }

}else if(($_SESSION['user_id'])!=0){


        $text = "Booking ID: $booking_id\nName: ".$_SESSION['first_name']."\nHall:".$_SESSION['hall_id']."\nShowTime:".$_SESSION['show_id']."\n";
        $qr_code = QrCode::create($text);
        $writer = new PngWriter();
        $result = $writer->write($qr_code);
        
        header("Content-Type: " . $result->getMimeType());
        echo $result->getString();
        $result->saveToFile("QR.png");
        $conn->close();
}else{
    header("Location: index.php?error=Unauthorized Access");
    exit();
}


?>
