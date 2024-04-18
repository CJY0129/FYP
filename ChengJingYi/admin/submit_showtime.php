<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("connect.php");

    $movie_id = $_POST['movie_id'];
    $hall_id = $_POST['hall_id'];
    $show_time = $_POST['show_time'];
    $end_time = $_POST['end_time'];
    $price = $_POST['price'];

    $sql = "INSERT INTO showtime (movie_id, hall_id, show_time, end_time, price) 
            VALUES ('$movie_id', '$hall_id', '$show_time', '$end_time', '$price')";

    if (mysqli_query($conn, $sql)) {
        header("location:home.php?show=showtime&success=1");

    } else {
        header("location:home.php?show=showtime&error=1");
    }

    mysqli_close($conn);
}
?>
