   
   <div class="seatcontainer" style="margin-top: 100px;
    margin-bottom: 100px;">
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
            selectedSeats.join(', ');
            console.log(selectedSeats);
            // Redirect to the next page with selected seats as a query parameter
            window.location.href = 'booking.php?selected_seats=' + selectedSeats.join(',');
        }
    }

    // Event listener for book button
    bookBtn.addEventListener('click', bookSeats);

    // Call function to create seats with passed PHP variables
    createSeats(numberOfSeats, bookedSeats);
});

</script>