document.addEventListener('DOMContentLoaded', function() {
    const seatsContainer = document.querySelector('.seats');
    const bookBtn = document.getElementById('bookBtn');
    const message = document.getElementById('message');
    let selectedSeats = [];

    // Function to create seats
    function createSeats() {
        const totalSeats = 120; // Change this as per your requirement
        for (let i = 1; i <= totalSeats; i++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.innerText = i;
            
            // Check if the seat is booked
            if (isSeatBooked(i)) {
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

    function isSeatBooked(seatNumber) {
        // You need to implement this function to check if the seat is booked in the database
        // You can use AJAX to send a request to the server to check the booking status of the seat
        // For now, I'll assume a simple array of booked seats for demonstration purposes
        const bookedSeats = [5, 10, 15]; // Example of already booked seats
        return bookedSeats.includes(seatNumber);
    }

    // Function to handle booking
    function bookSeats() {
        if (selectedSeats.length === 0) {
            alert("Please select at least one seat.");
        } else {
            alert("You have booked seats: " + selectedSeats.join(', '));
            // Here you can send selectedSeats array to backend for processing
            // using AJAX or form submission
        }
    }

    // Event listener for book button
    bookBtn.addEventListener('click', bookSeats);

    // Call function to create seats
    createSeats();
});
