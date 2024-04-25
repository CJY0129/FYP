<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookingDetails = $_POST["booking-details"]; 
    $cardType = $_POST["mode"];
    $cardNumber = $_POST["card-number"];
    $expirationDate = $_POST["expiration-date"];
    $cvv = $_POST["cvv"];
    $email = $_POST["email"];

    // Process the payment - Here you can integrate with a payment gateway or perform any other necessary actions
    // For demonstration purposes, let's just output the received data

    // Display the payment details
    echo "<h2>Payment Details</h2>";
    echo "<p><strong>Booking Details:</strong> $bookingDetails</p>";
    echo "<p><strong>Card Type:</strong> $cardType</p>";
    echo "<p><strong>Card Number:</strong> $cardNumber</p>";
    echo "<p><strong>Expiration Date:</strong> $expirationDate</p>";
    echo "<p><strong>CVV:</strong> $cvv</p>";
    echo "<p><strong>Email:</strong> $email</p>";

    // You can perform additional actions here, such as saving the payment details to a database, sending confirmation emails, etc.

    // For demonstration, redirect back to the payment page after processing
    // You might want to redirect to a success or failure page depending on the payment result
    header("Location: payment_page.php");
    exit;
} else {
    // If the form is not submitted, redirect to the payment page
    header("Location: payment_page.php");
    exit;
}
?>
