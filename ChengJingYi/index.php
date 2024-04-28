<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Screen</h2>
        <div class="seats">
            <!-- Seats will be dynamically generated here -->
        </div>
        <button id="bookBtn">Book Selected Seats</button>
        
    </div>
    <?php


    $conn = new mysqli("localhost", "root", "", "cinetime");
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve hall information
    $hall_id = 3; // Assuming hall_id is hardcoded for demonstration purposes
    $sql = "SELECT number_of_seat FROM hall WHERE hall_id = $hall_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $number_of_seats = $row['number_of_seat'];

   
    // Retrieve booked seats for the selected showtime
    $show_id = 2; // Assuming show_id is hardcoded for demonstration purposes
    $sql = "SELECT seat_id FROM booking WHERE show_id = $show_id";
    $result = $conn->query($sql);
    $booked_seats = array(); // Initialize an empty array to store booked seats
    while ($row = $result->fetch_assoc()) {
        $booked_seats[] = $row['seat_id']; // Add each booked seat to the array
    }

    
// Handle booking request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // You can process the selected seats here and store them in the database
    $selectedSeats = $_POST['seats'];
    // Assuming you have a database connection established
    // Code to insert $selectedSeats into your database
    // Example: INSERT INTO bookings (seat_number) VALUES ($selectedSeat);
    echo json_encode(['success' => true]);
    exit;
}
?>

<script>
    const bookedSeats   = <?php echo json_encode($booked_seats, JSON_NUMERIC_CHECK) ?>;
    const numberOfSeats = <?php echo $number_of_seats; ?>;
    
    document.addEventListener('DOMContentLoaded', function() {
    const seatsContainer = document.querySelector('.seats');
    const bookBtn = document.getElementById('bookBtn');
    const message = document.getElementById('message');
    let selectedSeats = [];

    // Function to create seats
    function createSeats(totalSeats, bookedSeats) {
        for (let i = 1; i <= totalSeats; i++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.innerText = i;
            
            // Check if the seat is booked
            if (bookedSeats.includes(i)) {
                seat.classList.add('booked');
                seat.removeEventListener('click', toggleSeat); // Remove click event listener
            } else {
                seat.addEventListener('click', toggleSeat);
            }
            
            seatsContainer.appendChild(seat);
        }
    }

    // Function to toggle seat selection
    function toggleSeat() {
        this.classList.toggle('selected');
        const seatNumber = parseInt(this.innerText);
        if (selectedSeats.includes(seatNumber)) {
            selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
        } else {
            selectedSeats.push(seatNumber);
        }
    }

    // Function to handle booking
    function bookSeats() {
        if (selectedSeats.length === 0) {
            alert("Please select at least one seat.");
        } else {
            alert("You have booked seats: " + selectedSeats.join(', '));
            // Here you can send selectedSeats array to backend for processing
            // using AJAX or form submission
            // For demonstration, I'll just log selectedSeats to console
            console.log(selectedSeats);
        }
    }

    // Event listener for book button
    bookBtn.addEventListener('click', bookSeats);

    // Call function to create seats with passed PHP variables
    createSeats(numberOfSeats, bookedSeats);
});

</script>


</body>
</html>
