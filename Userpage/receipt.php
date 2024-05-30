<?php
include ("connect.php");
require "vendor/autoload.php"; 

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

session_start();

$show_id = $_SESSION['show_id'];
$selected_seats = explode(',', $_SESSION['selected_seats']);
$total = count($selected_seats);

// Check for already booked seats
$sql = "SELECT seat_num FROM booking WHERE show_id = $show_id";
$result = $conn->query($sql);
$booked_seats = array();
while ($row = $result->fetch_assoc()) {
    $seat_nums = explode(',', $row['seat_num']);
    foreach ($seat_nums as $seat_num) {
        $booked_seats[] = trim($seat_num); 
    }
}


// Check if any selected seats are already booked
$conflict_seats = array_intersect($selected_seats, $booked_seats);
if (!empty($conflict_seats)) {
    echo "Error: The following seats are already booked: " . implode(', ', $conflict_seats);
    header("Location: index.php?error=1.");
    exit();
}
$user_id = $_SESSION['user_id'];

if($user_id != 0) {
    $sql = "SELECT email, phone_number FROM user WHERE user_id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $phone = $row['phone_number'];
    } else {
        echo "Error: User details not found.";
        exit();
    }
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
}

$sql = "INSERT INTO booking (user_id, show_id, seat_num, booking_time, total_price, total_person, status) 
        VALUES ('$user_id', '$show_id', '".$_SESSION['selected_seats']."', '".date('Y-m-d H:i:s')."', '".$_SESSION['price']."', '".$total."', 1)";

if ($conn->query($sql) === TRUE) {
    $booking_id = $conn->insert_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}

// Determine name based on session or input
$name = isset($_POST['name']) ? $_POST['name'] : $_SESSION['first_name'];

// Generate QR code
$text = "Booking ID: $booking_id\nName: $name\nEmail: $email\nPhone: $phone\nHall:".$_SESSION['hall_id']."\nShowTime:".$_SESSION['show_id']."\n";
$qr_code = QrCode::create($text);
$writer = new PngWriter();
$result = $writer->write($qr_code);
$qr_code_base64 = base64_encode($result->getString());

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arial:wght@400;700&display=swap');
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #24262d;
            color: #fff;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #24262d; /* Ensure the background color is set */
        }
        .qr-code {
            margin-top: 20px;
        }
        .details {
            text-align: left;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <div class="details">
            <p><strong>Booking ID:</strong> <?= $booking_id ?></p>
            <p><strong>Name:</strong> <?= $name ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Phone:</strong> <?= $phone ?></p>
            <p><strong>Hall:</strong> <?= $_SESSION['hall_id'] ?></p>
            <p><strong>Show Time:</strong> <?= $_SESSION['show_id'] ?></p>
        </div>
        <div class="qr-code">
            <img src="data:image/png;base64,<?= $qr_code_base64 ?>" alt="QR Code">
        </div>
        <button id="download">Download Ticket</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById('download').addEventListener('click', function() {
            html2canvas(document.querySelector('.container'), {
                backgroundColor: '#24262d' // Ensure the background color is set
            }).then(function(canvas) {
                var link = document.createElement('a');
                link.download = 'Ticket.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
    </script>
</body>
</html>
