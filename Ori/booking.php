<?php
session_start();
if (isset($_GET['show_id']) && $_GET['show_id'] ){
    $_SESSION['show_id'] = $_GET['show_id'];
}else{
    
}
include('connect.php');


$show_id = $_SESSION['show_id'];
$_SESSION['user_id'] = 0;//$_GET['user_id'];

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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/seat.css">
    
    
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
                <p class="left-box"><i class="fa fa-home" style="font-size:24px"></i> Hall <?php echo $hall_id; ?></p>
                <p class="right-box"><i class="fa fa-clock-o" style="font-size:24px"></i> <?php echo $showtime; ?></p>
                <p class="left-box"><i class="fa fa-map-marker" style="font-size:24px"></i> <?php echo $name; ?></p>
                <?php
                    if (isset($_GET['selected_seats']) && $_GET['selected_seats'] ) {
                        $_SESSION['selected_seats'] = $_GET['selected_seats'];
                        echo'<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> '.$_SESSION['selected_seats'].'</p>';
                    }else{
                        
                    }
                ?>
            
        </ul>
    </div>

    <?php
    if (isset($_GET['selected_seats']) && $_GET['selected_seats'] ) {
        include('Comfirm.php');
    }else{
        include('seat_select.php');
    }

    ?>

    

    

</body>
</html>
