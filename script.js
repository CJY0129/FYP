// Mock seat data (replace with your actual data)
const seats = [];
const rows = 8;
const cols = 10;

for (let row = 1; row <= rows; row++) {
    for (let col = 1; col <= cols; col++) {
        seats.push({ row, col });
    }
}

const selectedSeats = [];

// Function to generate seat map
function generateSeatMap() {
    const seatMap = document.getElementById('seat-map');

    seats.forEach((seat) => {
        const seatButton = document.createElement('button');
        seatButton.classList.add('seat');
        seatButton.innerText = `${String.fromCharCode(64 + seat.row)}${seat.col}`;
        seatButton.addEventListener('click', () => toggleSeatSelection(seat));
        seatMap.appendChild(seatButton);
    });
}

// Function to toggle seat selection
function toggleSeatSelection(seat) {
    const index = selectedSeats.findIndex((selectedSeat) => selectedSeat.row === seat.row && selectedSeat.col === seat.col);

    if (index !== -1) {
        selectedSeats.splice(index, 1);
    } else {
        selectedSeats.push(seat);
    }

    updateSeatButtons();
}

// Function to update seat button styles
function updateSeatButtons() {
    const seatButtons = document.querySelectorAll('.seat');

    seatButtons.forEach((button) => {
        const seat = getSeatInfoFromButton(button);
        const isSelected = selectedSeats.some((selectedSeat) => selectedSeat.row === seat.row && selectedSeat.col === seat.col);

        button.classList.toggle('selected', isSelected);
    });
}

// Function to extract seat information from button
function getSeatInfoFromButton(button) {
    const seatCode = button.innerText;
    const row = seatCode.charCodeAt(0) - 64;
    const col = parseInt(seatCode.substring(1), 10);
    return { row, col };
}

// Function to simulate booking action (replace with your actual booking logic)
function bookSeats() {
    if (selectedSeats.length === 0) {
        alert('Please select at least one seat.');
    } else {
        const seatCodes = selectedSeats.map((seat) => `${String.fromCharCode(64 + seat.row)}${seat.col}`);
        alert(`Booked seats: ${seatCodes.join(', ')}`);
        // Implement your actual booking logic here
    }
}

// Generate seat map on page load
generateSeatMap();
