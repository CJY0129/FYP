<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    if (isset($_POST["card-number"]) && isset($_POST["expiration-date"]) && isset($_POST["cvv"]) && isset($_POST["email"])) {
       
        $cardNumber = $_POST["card-number"];
        $expirationDate = $_POST["expiration-date"];
        $cvv = $_POST["cvv"];
        $email = $_POST["email"];

       
        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            
            echo "<h2>Payment Successful!</h2>";
            echo "<p>Thank you for your purchase. You will receive a confirmation email shortly.</p>";
        } else {
            
            echo "<h2>Payment Failed</h2>";
            echo "<p>There was an error processing your payment. Please try again later.</p>";
        }
    } else {
        
        echo "<h2>Error</h2>";
        echo "<p>Please fill out all required fields.</p>";
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>
