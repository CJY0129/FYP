<?php
$conn = new mysqli("localhost", "root", "", "cinetime");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$show_id = $_GET['show_id'];

// Fetch movie details, time, date, and poster from the showtime table
$sql = "SELECT s.movie_id, s.show_time, m.title, m.poster_path, h.cinema_id 
        FROM showtime s
        INNER JOIN movie m ON s.movie_id = m.movie_id
        INNER JOIN hall h ON s.hall_id = h.hall_id
        WHERE s.show_id = $show_id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$title = $row['title'];
$showtime = $row['show_time'];
$poster = $row['poster_path'];
$cinema_id = $row['cinema_id'];

// Fetch cinema name from the cinema table using cinema ID
$sql = "SELECT name FROM cinema WHERE cinema_id = $cinema_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];

// Fetch booked seats
$sql = "SELECT seat_num FROM booking WHERE show_id = $show_id";
$result = $conn->query($sql);
$booked_seats = array(); // Initialize an empty array to store booked seats
while ($row = $result->fetch_assoc()) {
    $booked_seats[] = $row['seat_num']; // Add each booked seat to the array
}

// Fetch hall details
$sql = "SELECT hall_id, number_of_seat FROM hall WHERE hall_id = (SELECT hall_id FROM showtime WHERE show_id = $show_id)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hall_id = $row['hall_id'];
$number_of_seats = $row['number_of_seat'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Booking</title>
    <link rel="stylesheet" href="assets/css/seats.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<div class="moviecontainer">
<?php
if (!empty($poster)) {
    echo '<img src="data:image/jpeg;base64,' . base64_encode($poster) . '" alt="Movie Poster">';
} else {
    echo 'No Poster Available';
}
?>
        <ul>
            
                <h3>  <?php echo $title; ?></h3><br><br>
                <p><i class="fa fa-home" style="font-size:24px"></i> Hall <?php echo $hall_id; ?></p>
                <p><i class="fa fa-clock-o" style="font-size:24px"></i> <?php echo $showtime; ?></p>
                <p><i class="fa fa-map-marker" style="font-size:24px"></i> <?php echo $name; ?></p>
            
        </ul>
    </div>

        
    <div class="container">
    <h2>screen</h2>
        <div class="seats">
            <!-- Seats will be dynamically generated here -->
        </div>
        <button id="bookBtn">Book Selected Seats</button>
    </div>

   

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
