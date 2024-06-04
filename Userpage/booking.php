<?php

session_start();
if (isset($_GET['show_id']) && $_GET['show_id'] ){
    $_SESSION['show_id'] = $_GET['show_id'];
} else {
    // Handle the case where show_id is not set if needed
}
include('connect.php');

$show_id = $_SESSION['show_id'];

// Fetch movie details, time, date, and poster from the showtime table
$sql = "SELECT s.movie_id, s.show_time, m.title, m.poster_path, h.cinema_id, h.hall_num
        FROM showtime s
        INNER JOIN movie m ON s.movie_id = m.movie_id
        INNER JOIN hall h ON s.hall_id = h.hall_id
        WHERE s.show_id = $show_id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['title'] = $row['title'];
$_SESSION['showtime'] = $row['show_time'];
$poster = $row['poster_path'];
$cinema_id = $row['cinema_id'];
$_SESSION['hall_num'] = $row['hall_num'];

$sql = "SELECT name FROM cinema WHERE cinema_id = $cinema_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];

$sql = "SELECT seat_num FROM booking WHERE show_id = $show_id";
$result = $conn->query($sql);
$booked_seats = array();
while ($row = $result->fetch_assoc()) {
    $seat_nums = explode(',', $row['seat_num']);
    foreach ($seat_nums as $seat_num) {
        $booked_seats[] = trim($seat_num); 
    }
}

$sql = "SELECT price FROM showtime WHERE show_id = $show_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['price'] = $row['price'];

$sql = "SELECT hall_id, number_of_seat FROM hall WHERE hall_id = (SELECT hall_id FROM showtime WHERE show_id = $show_id)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['hall_id'] = $row['hall_id'];
$number_of_seats = $row['number_of_seat'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/seat.css">
    <title>CINETIME</title>
    <link rel="icon" type="image/png" href="assets/img/CT.ico" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <!--[if lt IE 9]>   
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <a href="index.php"><img src="assets/img/CTlogo.png" alt="logo" /></a>
            </div>
            <div class="header-right">
                <form></form>
                <div class="header-right">
                    <ul>
                        <?php
                        if ($_SESSION['user_id'] == 0) {
                            echo '<li>Welcome Guest</li>';
                            echo '<li><a href="Login.php">Login</a></li>';
                        } else {
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            if ($_SESSION['user_id'] == 1) {
                                echo 'Welcome Guest!';
                            } else {
                                if ($_SESSION['Gender'] == 'M') {
                                    echo 'Welcome Mr. ' . $_SESSION['first_name'] . '!';
                                } else {
                                    echo 'Welcome Ms. ' . $_SESSION['first_name'] . '!';
                                }
                            }
                            echo '</a>';
                        }
                        ?>
                        <div class="dropdown-content">
                            <?php
                            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 1) {
                                echo '<a href="customer/Customer.php?userid=' . $_SESSION['user_id'] . '">View Profile</a>';
                            }
                            ?>
                            <a href="logout.php" id="logout">Log out</a>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <li><a href="index.php">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="moviecontainer" style="margin-top: 180px;">
    <?php
    if (!empty($poster)) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($poster) . '" alt="Movie Poster">';
    } else {
        echo 'No Poster Available';
    }
    ?>
    <ul>
        <h3><?php echo $_SESSION['title']; ?></h3><br><br>
        <p class="left-box"><i class="fa fa-home" style="font-size:24px"></i> Hall <?php echo $_SESSION['hall_num']; ?></p>
        <p class="right-box"><i class="fa fa-clock-o" style="font-size:24px"></i> <?php echo $_SESSION['showtime']; ?></p>
        <p class="left-box"><i class="fa fa-map-marker" style="font-size:24px"></i> <?php echo $name; ?></p>
        <?php
        if (isset($_GET['selected_seats']) && $_GET['selected_seats']) {
            $_SESSION['selected_seats'] = $_GET['selected_seats'];
            echo '<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> ' . $_SESSION['selected_seats'] . '</p>';
        } else if (isset($_GET['totalPrice']) && $_GET['totalPrice']) {
            echo '<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> ' . $_SESSION['selected_seats'] . '</p>';
        } elseif (isset($_GET['payment']) && $_GET['payment']) {
            echo '<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> ' . $_SESSION['selected_seats'] . '</p>';
        } elseif (isset($_GET['receipt']) && $_GET['receipt']) {
            echo '<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> ' . $_SESSION['selected_seats'] . '</p>';
        } else {
            echo '<p class="right-box"><i class="glyphicon glyphicon-print" style="font-size:18px"></i> Select your seats</p>';
        }

        if (isset($_GET['payment']) && $_GET['payment']) {
            include('payment main page.php');
        } else {
            // Other logic if needed
        }
        ?>
    </ul>
</div>

<?php
if (isset($_GET['selected_seats']) && $_GET['selected_seats']) {
    include('ticket.php');
} elseif (isset($_GET['totalPrice']) && $_GET['totalPrice']) {
    include('Confirm.php');
} elseif (isset($_GET['payment']) && $_GET['payment']) {
    // Payment related logic if needed
} elseif (isset($_GET['receipt']) && $_GET['receipt']) {
    include('receipt.php');
} else {
    include('seat_select.php');
}

include('footer.php');
?>

</body>
</html>
