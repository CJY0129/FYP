<?php

// Simulating selected seats from a session for this example

$selected_seats = explode(',', $_SESSION['selected_seats']);
$total_seats = count($selected_seats);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Selection</title>
    <style>
       
        .ticket {

            background-color: #222;
            border-radius: 10px;
            
        }
        .section {
            margin-bottom: 20px;
        }
        .section-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .section-content {
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }
        .item-type {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .item-type div {
            display: flex;
            align-items: center;
        }
        .item-type span {
            margin: 0 10px;
        }
        .item-type .btn {
            background-color: #ff0;
            border: none;
            padding: 5px 10px;
            border-radius: 50%;
            cursor: pointer;
        }
        .item-type .btn:disabled {
            background-color: #666;
            cursor: not-allowed;
        }
        .confirm-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ff0;
            border: none;
            border-radius: 5px;
            color: #000;
            font-size: 1.2em;
            cursor: pointer;
            text-align: center;
        }
        .total-price {
            font-size: 1.5em;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="section">
            
            <div class="section-content">
                You have selected <span id="seat-count"><?php echo $total_seats; ?></span> seat(s).
                <input type="hidden" id="selected-seats" value="<?php echo $total_seats; ?>">
            </div>
        </div>
        <div class="section">
            <div class="section-header">Ticket Price</div>
            <div class="section-content">Adult = RM 20</div>
            <div class="section-content">Children = RM 12</div>
            <div class="section-content">Student = RM 16</div>
            <div class="section-content">Oku = RM 16</div>
        </div>
        <div class="section">
            <div class="section-header">Select Tickets</div>
            <div class="section-content">
                <div class="item-type">
                    <div>Adult</div>
                    <div>
                        <button class="btn" onclick="updateCount('adult', -1)">-</button>
                        <span id="adult-count">1</span>
                        <button class="btn" onclick="updateCount('adult', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Children</div>
                    <div>
                        <button class="btn" onclick="updateCount('children', -1)" disabled>-</button>
                        <span id="children-count">0</span>
                        <button class="btn" onclick="updateCount('children', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Student</div>
                    <div>
                        <button class="btn" onclick="updateCount('student', -1)" disabled>-</button>
                        <span id="student-count">0</span>
                        <button class="btn" onclick="updateCount('student', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Oku</div>
                    <div>
                        <button class="btn" onclick="updateCount('oku', -1)" disabled>-</button>
                        <span id="oku-count">0</span>
                        <button class="btn" onclick="updateCount('oku', 1)">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="section-header">Drinks</div>
            <div class="section-content">
                <div class="item-type">
                    <div>Cola</div>
                    <div>
                        <button class="btn" onclick="updateCount('soda', -1)" disabled>-</button>
                        <span id="soda-count">0</span>
                        <button class="btn" onclick="updateCount('soda', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Water</div>
                    <div>
                        <button class="btn" onclick="updateCount('water', -1)" disabled>-</button>
                        <span id="water-count">0</span>
                        <button class="btn" onclick="updateCount('water', 1)">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="section-header">Food</div>
            <div class="section-content">
                <div class="item-type">
                    <div>Popcorn</div>
                    <div>
                        <button class="btn" onclick="updateCount('popcorn', -1)" disabled>-</button>
                        <span id="popcorn-count">0</span>
                        <button class="btn" onclick="updateCount('popcorn', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Burger</div>
                    <div>
                        <button class="btn" onclick="updateCount('burger', -1)" disabled>-</button>
                        <span id="burger-count">0</span>
                        <button class="btn" onclick="updateCount('burger', 1)">+</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-header">Total Price</div>
            <div class="section-content total-price">RM <span id="total-price">20</span></div>
        </div>     
        <button class="confirm-btn" onclick="confirmSelection()">Confirm</button>
    </div>
    
    <script>
        const prices = {
            adult: <?php echo $_SESSION['price'] ?> +10,

            children: <?php echo $_SESSION['price'] ?> +2,
            student: <?php echo $_SESSION['price'] ?> +5,
            oku: <?php echo $_SESSION['price'] ?> +5,
            soda: <?php echo $_SESSION['price'] ?> -4,
            water: <?php echo $_SESSION['price'] ?> -7,
            popcorn: <?php echo $_SESSION['price'] ?> ,
            burger: <?php echo $_SESSION['price'] ?> +2
        };

        const totalSeats = parseInt(document.getElementById('selected-seats').value);

        function updateCount(itemType, increment) {
            const countElement = document.getElementById(`${itemType}-count`);
            let currentCount = parseInt(countElement.textContent);
            currentCount += increment;

            if (currentCount < 0) {
                currentCount = 0;
            }

            // Calculate total tickets selected
            const totalTickets = getTotalTicketsSelected();

            // Check if the total tickets exceed the total seats
            if (totalTickets + increment > totalSeats) {
                alert("You cannot select more tickets than the number of seats selected.");
                return; // Exit the function if the total tickets exceed total seats
            }

            countElement.textContent = currentCount;

            // Enable/disable the decrement button based on the current count
            const decrementButton = countElement.previousElementSibling;
            if (currentCount > 0) {
                decrementButton.disabled = false;
            } else {
                decrementButton.disabled = true;
            }

            updateTotalPrice();
        }

        function getTotalTicketsSelected() {
            const adultCount = parseInt(document.getElementById('adult-count').textContent);
            const childrenCount = parseInt(document.getElementById('children-count').textContent);
            const studentCount = parseInt(document.getElementById('student-count').textContent);
            const okuCount = parseInt(document.getElementById('oku-count').textContent);
            return adultCount + childrenCount + studentCount + okuCount;
        }

        function updateTotalPrice() {
            const adultCount = parseInt(document.getElementById('adult-count').textContent);
            const childrenCount = parseInt(document.getElementById('children-count').textContent);
            const studentCount = parseInt(document.getElementById('student-count').textContent);
            const okuCount = parseInt(document.getElementById('oku-count').textContent);
            const sodaCount = parseInt(document.getElementById('soda-count').textContent);
            const waterCount = parseInt(document.getElementById('water-count').textContent);
            const popcornCount = parseInt(document.getElementById('popcorn-count').textContent);
            const burgerCount = parseInt(document.getElementById('burger-count').textContent);

            const totalPrice = (adultCount * prices.adult) +
                               (childrenCount * prices.children) +
                               (studentCount * prices.student) +
                               (okuCount * prices.oku) +
                               (sodaCount * prices.soda) +
                               (waterCount * prices.water) +
                               (popcornCount * prices.popcorn) +
                               (burgerCount * prices.burger);

            document.getElementById('total-price').textContent = totalPrice;
            
        }
        function confirmSelection() {
            // Update the total price before navigating
            updateTotalPrice();
            
            // Get the total price
            const totalPrice = parseInt(document.getElementById('total-price').textContent);
            
            // Redirect to the next page with the total price as a query parameter
            window.location.href = 'test.php?totalPrice=' + totalPrice;
        }
    </script>
    
    

    

</body> 
</html>
