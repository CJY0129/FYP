<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form class="payment-form">
            <div class="section">
                <h2>Payment</h2>
                <label>
                    Full Name:
                    <input type="text" name="fullName" placeholder="Jacob Aiden">
                </label>
                <label>
                    Email:
                    <input type="email" name="email" placeholder="example@example.com">
                </label>
                
            </div>
            <div class="section">
                
                <div class="cards-accepted">
                    <p>Cards Accepted:</p>
                    <img src="paypal.png" alt="PayPal">
                    <img src="mastercard.png" alt="MasterCard">
                    <img src="visa.png" alt="Visa">
                    
                </div>
                <label>
                    Name On Card:
                    <input type="text" name="nameOnCard" placeholder="Mr. Jacob Aiden">
                </label>
                <label>
                    Credit Card Number:
                    <input type="text" name="creditCardNumber" placeholder="1111 2222 3333 4444" min="16">
                </label>
                <label>
                    Exp. Month:
                    <input type="text" name="expMonth" placeholder="August">
                </label>
                <label>
                    Exp. Year:
                    <input type="text" name="expYear" placeholder="2025">
                </label>
                <label>
                    CVV:
                    <input type="text" name="cvv" placeholder="123">
                </label>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
