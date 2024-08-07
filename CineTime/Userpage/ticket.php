<?php
// Simulating selected seats from a session for this example

$selected_seats = explode(',', $_SESSION['selected_seats']);
$_SESSION['total_seats'] = count($selected_seats);
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
            color: #fff;
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
                You have selected <span id="seat-count"><?php echo $_SESSION['total_seats']; ?></span> seat(s).
                <input type="hidden" id="selected-seats" value="<?php echo $_SESSION['total_seats']; ?>">
            </div>
        </div>
        <div class="section">
            <div class="section-header">Select Tickets</div>
            <div class="section-content">
                <div class="item-type">
                    <div>Adult (RM 20)</div>
                    <div>
                        <button class="btn" onclick="updateCount('adult', -1)">-</button>
                        <span id="adult-count">1</span>
                        <button class="btn" onclick="updateCount('adult', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Children (RM 12)</div>
                    <div>
                        <button class="btn" onclick="updateCount('children', -1)">-</button>
                        <span id="children-count">0</span>
                        <button class="btn" onclick="updateCount('children', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Student (RM 16)</div>
                    <div>
                        <button class="btn" onclick="updateCount('student', -1)">-</button>
                        <span id="student-count">0</span>
                        <button class="btn" onclick="updateCount('student', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Oku (RM 16)</div>
                    <div>
                        <button class="btn" onclick="updateCount('oku', -1)">-</button>
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
                    <div>Cola (RM 6)</div>
                    <div>
                        <button class="btn" onclick="updateCount('soda', -1)">-</button>
                        <span id="soda-count">0</span>
                        <button class="btn" onclick="updateCount('soda', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Mineral Water (RM 3)</div>
                    <div>
                        <button class="btn" onclick="updateCount('water', -1)">-</button>
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
                    <div>Popcorn (RM 10)</div>
                    <div>
                        <button class="btn" onclick="updateCount('popcorn', -1)">-</button>
                        <span id="popcorn-count">0</span>
                        <button class="btn" onclick="updateCount('popcorn', 1)">+</button>
                    </div>
                </div>
                <div class="item-type">
                    <div>Burger (RM 12)</div>
                    <div>
                        <button class="btn" onclick="updateCount('burger', -1)" >-</button>
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
        <button style="margin-bottom:50px;" class="confirm-btn" onclick="confirmSelection()">Confirm</button>
    </div>
    <script>
        const prices = {
            adult: 20,
            children: 12,
            student: 16,
            oku: 16,
            soda: 6,
            water: 3,
            popcorn: 10,
            burger: 12
        };

        const totalSeats = parseInt(document.getElementById('selected-seats').value);

        function updateCount(itemType, increment) {
            const countElement = document.getElementById(`${itemType}-count`);
            let currentCount = parseInt(countElement.textContent);

            // Calculate total tickets selected
            const totalTickets = getTotalTicketsSelected() + increment;

            // Check if the total tickets exceed the total seats
            if (!['soda', 'water', 'popcorn', 'burger'].includes(itemType) && (totalTickets > totalSeats || totalTickets < 0)) {
                alert("Please select the same number of tickets as the number of seats selected.");
                return;
            }

            currentCount += increment;
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
            if (getTotalTicketsSelected() !== totalSeats) {
                alert("Please select the same number of tickets as the number of seats selected.");
                return;
            }
            alert("Selection completed! ");
            const totalPrice = parseInt(document.getElementById('total-price').textContent);

            const items = {
                adult: parseInt(document.getElementById('adult-count').textContent),
                children: parseInt(document.getElementById('children-count').textContent),
                student: parseInt(document.getElementById('student-count').textContent),
                oku: parseInt(document.getElementById('oku-count').textContent),
                soda: parseInt(document.getElementById('soda-count').textContent),
                water: parseInt(document.getElementById('water-count').textContent),
                popcorn: parseInt(document.getElementById('popcorn-count').textContent),
                burger: parseInt(document.getElementById('burger-count').textContent)
            };

            const queryParams = new URLSearchParams(items).toString();
            
            window.location.href = `booking.php?${queryParams}&totalPrice=${totalPrice}`;
        }
    </script>
</body>
</html>
