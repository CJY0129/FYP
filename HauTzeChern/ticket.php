

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
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
        .ticket-type {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .ticket-type div {
            display: flex;
            align-items: center;
        }
        .ticket-type span {
            margin: 0 10px;
        }
        .ticket-type .btn {
            background-color: #ff0;
            border: none;
            padding: 5px 10px;
            border-radius: 50%;
            cursor: pointer;
        }
        .ticket-type .btn:disabled {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="section">
            <div class="section-header">Seat(s)</div>
            
        </div>
        <div class="section">
            <div class="section-header">Ticket Price</div>
            <div class="section-content">Adult = RM 15</div>
            <div class="section-content">Children = RM 15</div>
            <div class="section-content">Student = RM 15</div>
            <div class="section-content">Oku = RM 15</div>
            
        </div>
        <div class="section">
            <div class="section-header">Select Tickets</div>
            <div class="section-content">
                <div class="ticket-type">
                    <div>Adult</div>
                    <div>
                        <button class="btn" onclick="updateCount('adult', -1)">-</button>
                        <span id="adult-count">1</span>
                        <button class="btn" onclick="updateCount('adult', 1)">+</button>
                    </div>
                </div>
                <div class="ticket-type">
                    <div>Children</div>
                    <div>
                        <button class="btn" onclick="updateCount('children', -1)" disabled>-</button>
                        <span id="children-count">0</span>
                        <button class="btn" onclick="updateCount('children', 1)">+</button>
                    </div>
                </div>
                
                <div class="ticket-type">
                    <div>Student</div>
                    <div>
                        <button class="btn" onclick="updateCount('student', -1)" disabled>-</button>
                        <span id="student-count">0</span>
                        <button class="btn" onclick="updateCount('student', 1)">+</button>
                    </div>
                </div>
                <div class="ticket-type">
                    <div>Oku</div>
                    <div>
                        <button class="btn" onclick="updateCount('oku', -1)" disabled>-</button>
                        <span id="oku-count">0</span>
                        <button class="btn" onclick="updateCount('oku', 1)">+</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="confirm-btn">Confirm</button>
    </div>
    <script>
        function updateCount(ticketType, increment) {
            const countElement = document.getElementById(`${ticketType}-count`);
            let currentCount = parseInt(countElement.textContent);
            currentCount += increment;

            if (currentCount < 0) {
                currentCount = 0;
            }

            countElement.textContent = currentCount;

            // Enable/disable the decrement button based on the current count
            const decrementButton = countElement.previousElementSibling;
            if (currentCount > 0) {
                decrementButton.disabled = false;
            } else {
                decrementButton.disabled = true;
            }
        }
    </script>
</body>
</html>
