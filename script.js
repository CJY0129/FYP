document.addEventListener("DOMContentLoaded", function () {
    const seatMap = document.getElementById("seat-map");
    const checkoutBtn = document.getElementById("checkout-btn");
    const seats = 45; // Number of seats in the cinema

    // Create seats
    for (let i = 1; i <= seats; i++) {
        const seat = document.createElement("div");
        seat.className = "seat";
        seat.dataset.seatNumber = i;
        seatMap.appendChild(seat);

        seat.addEventListener("click", function () {
            this.classList.toggle("selected");
        });
    }

    // Checkout button click event
    checkoutBtn.addEventListener("click", function () {
        const selectedSeats = document.querySelectorAll(".seat.selected");

        if (selectedSeats.length > 0) {
            const seatNumbers = Array.from(selectedSeats).map(seat => seat.dataset.seatNumber);
            
            // Send selected seat numbers to the server using AJAX or fetch
            // You'll handle this part in PHP
            // Example: sendSelectedSeatsToServer(seatNumbers);
            alert(`Selected Seats: ${seatNumbers.join(", ")}`);
        } else {
            alert("Please select a seat before checking out.");
        }
    });
});
