
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Booking</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active">Booking details            </li>
          </ul>
        </div>
         <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Booking Details</strong></div>
                  <div class="table-responsive"> 
                  <?php
                  // Assuming you have a database connection established
                  include("connect.php");
                  // Fetch data from the booking table
                  $query = "SELECT * FROM booking";
                  $result = mysqli_query($conn, $query);

                  // Check if there are any rows returned
                  if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Booking ID</th>';
                    echo '<th>User ID</th>';
                    echo '<th>Show ID</th>';
                    echo '<th>Seat ID</th>';
                    echo '<th>Booking Time</th>';
                    echo '<th>Total Person</th>';
                    echo '<th>Total Price</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>' . $row['booking_id'] . '</td>';
                      echo '<td>' . $row['user_id'] . '</td>';
                      echo '<td>' . $row['show_id'] . '</td>';
                      echo '<td>' . $row['seat_id'] . '</td>';
                      echo '<td>' . $row['booking_time'] . '</td>';
                      echo '<td>' . $row['total_person'] . '</td>';
                      echo '<td>' . $row['total_price'] . '</td>';
                      echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                  } else {
                    echo 'No bookings found.';
                  }

                  // Close the database connection
                  mysqli_close($conn);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        
    