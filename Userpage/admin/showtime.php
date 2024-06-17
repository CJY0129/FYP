<div class="page-content">
  <div class="page-header">
    <div class="container-fluid">
      <h2 class="h5 no-margin-bottom">Showtime</h2>
    </div>
  </div>
  <div class="tilted-container">
    <?php
    if (isset($_GET['show']) && $_GET['show'] == 'showtime') 
    {
      if (isset($_GET['success']) && $_GET['success'] == '1') 
      {
        echo '<div class="alert alert-success">New Showtime added successfully.</div>';
      }
      else if(isset($_GET['success']) && $_GET['success'] == '2') 
      {
        echo '<div class="alert alert-success">Showtime deleted successfully.</div>';
      }
      else if(isset($_GET['success']) && $_GET['success'] == '3') 
      {
        echo '<div class="alert alert-success">Showtime updated successfully.</div>';
      }


      if (isset($_GET['error']) && $_GET['error'] == '1') 
      {
        echo '<div class="alert alert-danger">Error adding new Showtime.</div>';
      }
      else if(isset($_GET['error']) && $_GET['error'] == '2') 
      {
        echo '<div class="alert alert-danger">Error deleting Showtime.</div>';
      }
      else if(isset($_GET['error']) && $_GET['error'] == '3') 
      {
        echo '<div class="alert alert-danger">Error updating Showtime.</div>';
      }
    }
    ?>

    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="block margin-bottom-sm tilted-content">
              <div class="title"><strong>Showtime Details</strong></div>
              <div class="table-responsive"> 
                <!-- Showtime details table -->
                <?php include("connect.php");

                // Query to fetch showtime details
                $query = "SELECT * FROM showtime";
                $result = mysqli_query($conn, $query);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Show ID</th>';
                    echo '<th>Movie</th>';
                    echo '<th>Hall</th>';
                    echo '<th>Show Time</th>';
                    echo '<th>End Time</th>';
                    echo '<th>Price</th>';  
                    echo '<th>Actions</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Fetch movie title
                        $movieQuery = "SELECT title FROM movie WHERE movie_id = " . $row['Movie_id'];
                        $movieResult = mysqli_query($conn, $movieQuery);
                        $movieRow = mysqli_fetch_assoc($movieResult);

                        // Fetch hall details
                        $hallQuery = "SELECT hall_num, cinema_id FROM hall WHERE hall_id = " . $row['Hall_id'];
                        $hallResult = mysqli_query($conn, $hallQuery);
                        $hallRow = mysqli_fetch_assoc($hallResult);

                        // Fetch cinema name
                        $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $hallRow['cinema_id'];
                        $cinemaResult = mysqli_query($conn, $cinemaQuery);
                        $cinemaRow = mysqli_fetch_assoc($cinemaResult);

                        // Display table row
                        echo '<tr>';
                        echo '<td>' . $row['show_id'] . '</td>';
                        echo '<td>' . $movieRow['title'] . '</td>';
                        echo '<td>' . 'Hall: ' . $hallRow['hall_num'] . ' |  Cinema: ' . $cinemaRow['name'] . '</td>';
                        echo '<td>' . $row['show_time'] . '</td>';
                        echo '<td>' . $row['end_time'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>
                                <button type="button" data-toggle="modal" data-target="#editModal' . $row['show_id'] . '" class="close" ><i class="fa fa-edit" style="color:#ff4759;"></i></button> 
                                <a class="fa fa-trash-o" style="font-size:25px" href="delete_showtime.php?show_id='. $row['show_id'].'" onclick="return confirmDelete();"></a>
                              </td>';                 
                        echo '</tr>';

                        echo '<div class="modal fade" id="editModal' . $row['show_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $row['show_id'] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="editModalLabel' . $row['show_id'] . '">Edit Showtime</h5>';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form method="post" action="update_showtime.php">';
                        echo '<input type="hidden" name="show_id" value="' . $row['show_id'] . '">';
                        echo '<div class="form-group">';
                        echo '<label class="form-control-label">Movie</label>';
                        echo '<select name="movie_id" class="form-control">';
                        // Fetch movie options from database
                        $movieQuery = "SELECT movie_id, title FROM movie";
                        $movieResult = mysqli_query($conn, $movieQuery);
                        while ($movieRow = mysqli_fetch_assoc($movieResult)) {
                            $selected = ($movieRow['movie_id'] == $row['Movie_id']) ? 'selected' : '';
                            echo '<option value="' . $movieRow['movie_id'] . '" ' . $selected . '>' . $movieRow['title'] . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="form-control-label">Hall</label>';
                        echo '<select name="hall_id" class="form-control">';
                        // Fetch hall options from database
                        $hallQuery = "SELECT hall_id, hall_num, cinema_id FROM hall";
                        $hallResult = mysqli_query($conn, $hallQuery);
                        while ($hallRow = mysqli_fetch_assoc($hallResult)) {
                            // Fetch cinema name
                            $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $hallRow['cinema_id'];
                            $cinemaResult = mysqli_query($conn, $cinemaQuery);
                            $cinemaRow = mysqli_fetch_assoc($cinemaResult);

                            $selected = ($hallRow['hall_id'] == $row['Hall_id']) ? 'selected' : '';
                            echo '<option value="' . $hallRow['hall_id'] . '" ' . $selected . '>Hall: ' . $hallRow['hall_num'] . ' |  Cinema: ' . $cinemaRow['name'] . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="form-control-label">Show Time</label>';
                        echo '<input type="datetime-local" name="show_time" class="form-control" value="' . date('Y-m-d\TH:i', strtotime($row['show_time'])) . '" required>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="form-control-label">End Time</label>';
                        echo '<input type="datetime-local" name="end_time" class="form-control" value="' . date('Y-m-d\TH:i', strtotime($row['end_time'])) . '" required>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="form-control-label">Price</label>';
                        echo '<input type="number" name="price" class="form-control" value="' . $row['price'] . '" required>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo 'No showtime details found.';
                }
                ?>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
                  function confirmDelete() {
                    return confirm("Are you sure you want to delete this movie?");  
                  }
              </script>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Add Showtime</strong></div>
              <div class="table-responsive"> 
                <div class="block-body">
                  <form method="post" action="submit_showtime.php">
                    <div class="form-group">
                      <label class="form-control-label">Movie</label>
                      <select name="movie_id" class="form-control">
                        <?php
                          // Fetch movie options from database
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
                          // Fetch hall options from database
                          $query = "SELECT hall_id, hall_num, cinema_id FROM hall";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                            // Get the cinema name based on the cinema_id
                            $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $row['cinema_id'];
                            $cinemaResult = mysqli_query($conn, $cinemaQuery);
                            $cinemaRow = mysqli_fetch_assoc($cinemaResult);
                          
                            // Display hall number and cinema name
                            echo '<option value="'. $row['hall_id']. '">Hall: '. $row['hall_num'] . ' |  Cinema: ' . $cinemaRow['name'] . '</option>';
                          }
                          mysqli_close($conn);
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">Show Time</label>
                      <input type="datetime-local" name="show_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">End Time</label>
                      <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">Price</label>
                      <input type="number" name="price" class="form-control" required>
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
  </div>
</div>
