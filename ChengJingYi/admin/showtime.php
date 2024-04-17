<div class="page-content">
  <div class="page-header">
    <div class="container-fluid">
      <h2 class="h5 no-margin-bottom">Showtime</h2>
    </div>
  </div>
  <section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Add Showtime </strong></div>
            <div class="table-responsive"> 
              <div class="block-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="form-group">
                    <label class="form-control-label">Movie</label>
                    <select name="movie_id" class="form-control">
                      <?php
                      include("connect.php");
                      $query = "SELECT movie_id, title FROM movie";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['movie_id'] . '">' . $row['title'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Hall</label>
                    <select name="hall_id" class="form-control">
                      <?php
                      $query = "SELECT hall_id, hall_type_id, cinema_id FROM hall";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        // Display hall name and cinema ID
                        echo '<option value="'. '">Hall: '. $row['hall_id'] . ', Hall Type: ' . $row['hall_type_id'] . ', Cinema ID: ' . $row['cinema_id'] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Show Time</label>
                    <input type="datetime-local" name="show_time" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">End Time</label>
                    <input type="datetime-local" name="end_time" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Add Showtime" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Showtime Details</strong></div>
            <div class="table-responsive"> 
              <?php

              $query = "SELECT * FROM showtime";
              $result = mysqli_query($conn, $query);

              // Check if there are any rows returned
              if (mysqli_num_rows($result) > 0) {
                  echo '<table class="table">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>Show ID</th>';
                  echo '<th>Movie ID</th>';
                  echo '<th>Hall ID</th>';
                  echo '<th>Show Time</th>';
                  echo '<th>End Time</th>';
                  echo '<th>Ticket Type ID</th>';
                  echo '<th>Actions</th>'; // Add column for actions (Edit/Delete)
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';

                  // Loop through each row of the result
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>' . $row['show_id'] . '</td>';
                      echo '<td>' . $row['Movie_id'] . '</td>';
                      echo '<td>' . $row['Hall_id'] . '</td>';
                      echo '<td>' . $row['show_time'] . '</td>';
                      echo '<td>' . $row['end_time'] . '</td>';
                      echo '<td>' . $row['ticket_type_id'] . '</td>';
                      // Add Edit and Delete buttons with links to edit_showtime.php and delete_showtime.php
                      echo '<td><a href="edit_showtime.php?show_id=' . $row['show_id'] . '">Edit</a> | <a href="delete_showtime.php?show_id=' . $row['show_id'] . '">Delete</a></td>';
                      echo '</tr>';
                  }

                  echo '</tbody>';
                  echo '</table>';
              } else {
                  echo 'No showtime details found.';
              }

              mysqli_close($conn);
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

