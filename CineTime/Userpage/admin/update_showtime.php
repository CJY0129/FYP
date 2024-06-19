<?php
    include("connect.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $showId = $_POST['show_id'];
        $movieId = $_POST['movie_id'];
        $hallId = $_POST['hall_id'];
        $showTime = $_POST['show_time'];
        $endTime = $_POST['end_time'];
        $price = $_POST['price'];
    
        $updateQuery = "UPDATE showtime SET movie_id = $movieId, hall_id = $hallId, show_time = '$showTime', end_time = '$endTime', price = $price WHERE show_id = $showId";
        $updateResult = mysqli_query($conn, $updateQuery);
    
        if ($updateResult) {
            header("location:home.php?show=showtime&success=3");
        } else {
            header("location:home.php?show=showtime&error=3");
        }
    }
?>