<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="payment/styles.css">
</head>
<body>
    <div class="container">
    <form action="booking.php?receiptcounter=1" method="POST" class="payment-form">
            <div class="section">
                <h2>Payment</h2>
                <label>
                    Full Name:
                    <input type="text" name="fullName" placeholder="Jacob Aiden" required>
                </label>
                <label>
                    Email:
                    <input type="email" name="email" placeholder="example@example.com" required>
                </label>
                
            </div>
            <div class="section">
                
                <div class="cards-accepted">
                    <p>Cards Accepted:</p>
                    <img src="payment/paypal.png" alt="PayPal">
                    <img src="payment/mastercard.png" alt="MasterCard">
                    <img src="payment/visa.png" alt="Visa">
                    
                </div>
                <label>
                    Name On Card:
                    <input type="text" name="nameOnCard" placeholder="Mr. Jacob Aiden" required>
                </label>
                <label>
                    Credit Card Number:
                    <input type="number" name="creditCardNumber" placeholder="1111 2222 3333 4444" min="16"   required>
                </label>
                <label>
                    Exp. Month:
                    <input type="text" name="expMonth" placeholder="August" required>
                </label>
                <label>
                    Exp. Year:
                    <input type="number" name="expYear" placeholder="2025" min="2024" max="2026" step="1" required>
                </label>
                <label>
                    CVV:
                    <input type="number" name="cvv" placeholder="123" min="001" max="999" required>
                </label>
            </div>
            
            <button type=submit>Make A Payment</button>
      
    
  
        </form>
    </div>
</body>
</html>
