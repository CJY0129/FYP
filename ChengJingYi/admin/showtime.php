
<div class="page-content">
  <div class="page-header">
    <div class="container-fluid">
      <h2 class="h5 no-margin-bottom">Showtime</h2>
    </div>
  </div>
  <?php
if (isset($_GET['show']) && $_GET['show'] == 'showtime') 
{
  if (isset($_GET['success']) && $_GET['success'] == '1') 
  {
    echo '<div class="alert alert-danger">New Showtime added succesfully.</div>';
  }
  else if(isset($_GET['success']) && $_GET['success'] == '2') 
  {
    echo '<div class="alert alert-danger">Showtime deleted succesfully.</div>';
  }
  else if(isset($_GET['success']) && $_GET['success'] == '3') 
  {
    echo '<div class="alert alert-danger">Showtime updated succesfully.</div>';
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
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Showtime Details</strong></div>
            <div class="table-responsive"> 
              
              <?php
              include("connect.php");
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
                echo '<th>Actions</th>'; // Add column for actions (Edit/Delete)
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Loop through each row of the result
                while ($row = mysqli_fetch_assoc($result)) {
                  // Get the movie title based on the movie_id
                  $movieQuery = "SELECT title FROM movie WHERE movie_id = " . $row['Movie_id'];
                  $movieResult = mysqli_query($conn, $movieQuery);
                  $movieRow = mysqli_fetch_assoc($movieResult);

                  // Get the hall and cinema details based on the hall_id
                  $hallQuery = "SELECT hall_type_id, cinema_id FROM hall WHERE hall_id = " . $row['Hall_id'];
                  $hallResult = mysqli_query($conn, $hallQuery);
                  $hallRow = mysqli_fetch_assoc($hallResult);

                  // Get the cinema name based on the cinema_id
                  $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $hallRow['cinema_id'];
                  $cinemaResult = mysqli_query($conn, $cinemaQuery);
                  $cinemaRow = mysqli_fetch_assoc($cinemaResult);

                  echo '<tr>';
                  echo '<td>' . $row['show_id'] . '</td>';
                  echo '<td>' . $movieRow['title'] . '</td>';
                  echo '<td>' . 'Hall: ' . $row['Hall_id'] . ' |  Hall Type: ' . $hallRow['hall_type_id'] . '   |  Cinema: ' . $cinemaRow['name'] . '</td>';
                  echo '<td>' . $row['show_time'] . '</td>';
                  echo '<td>' . $row['end_time'] . '</td>';
                  echo '<td>' . $row['price'] . '</td>';
                  echo '<td>
                          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary edit-btn" data-show-id="' . $row['show_id'] . '" data-movie-id="' . $row['Movie_id'] . '" data-hall-id="' . $row['Hall_id'] . '" data-show-time="' . $row['show_time'] . '" data-end-time="' . $row['end_time'] . '" data-price="' . $row['price'] . '">Edit</button> 
                          <a class="btn btn-primary" href="delete_showtime.php?show_id='. $row['show_id'].'" onclick="return confirmDelete();">Delete</a>
                        </td>';                 
                  echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
              } else {
                echo 'No showtime details found.';
              }

              ?>
<script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this showtime?");
      
    }
  </script>
 <script>
  


  document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const movieSelect = document.querySelector('select[name="movie_id"]');
    const hallSelect = document.querySelector('select[name="hall_id"]');
    const showTimeInput = document.querySelector('input[name="show_time"]');
    const endTimeInput = document.querySelector('input[name="end_time"]');
    const priceInput = document.querySelector('input[name="price"]');

    editButtons.forEach(button => {
      button.addEventListener('click', function () {
        const showId = this.getAttribute('data-show-id');
        const movieId = this.getAttribute('data-movie-id');
        const hallId = this.getAttribute('data-hall-id');
        const showTime = this.getAttribute('data-show-time');
        const endTime = this.getAttribute('data-end-time');
        const price = this.getAttribute('data-price');

        movieSelect.value = movieId;
        hallSelect.value = hallId;
        showTimeInput.value = showTime;
        endTimeInput.value = endTime;
        priceInput.value = price;

        document.getElementById('show_id_input').value = showId;
      });
    });
  });
</script>

              <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <strong id="exampleModalLabel" class="modal-title">Editing Showtime</strong>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="update_showtime.php">
                      <input type="hidden" name="show_id" id="show_id_input" >
                        <div class="form-group">
                          <label class="form-control-label">Movie</label>
                          <select name="movie_id" class="form-control">
                            <?php
                              $movieQuery = "SELECT movie_id, title FROM movie";
                              $movieResult = mysqli_query($conn, $movieQuery);
                              while ($movieRow = mysqli_fetch_assoc($movieResult)) {
                                $selected = ($movieRow['movie_id'] == $editRow['Movie_id']) ? 'selected' : '';
                                echo '<option value="' . $movieRow['movie_id'] . '" ' . $selected . '>' . $movieRow['title'] . '</option>';
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                  <label class="form-control-label">Hall</label>
                  <select name="hall_id" class="form-control">
                    <?php
                    $hallQuery = "SELECT hall_id, hall_type_id, cinema_id FROM hall";
                    $hallResult = mysqli_query($conn, $hallQuery);
                    while ($hallRow = mysqli_fetch_assoc($hallResult)) {
                      // Get the cinema name based on the cinema_id
                      $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $hallRow['cinema_id'];
                      $cinemaResult = mysqli_query($conn, $cinemaQuery);
                      $cinemaRow = mysqli_fetch_assoc($cinemaResult);

                      // Display hall name and cinema name
                      $selected = ($hallRow['hall_id'] == $editRow['Hall_id']) ? 'selected' : '';
                      echo '<option value="' . $hallRow['hall_id'] . '" ' . $selected . '>Hall: ' . $hallRow['hall_id'] . ' |  Hall Type: ' . $hallRow['hall_type_id'] . '   |  Cinema: ' . $cinemaRow['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-control-label">Show Time</label>
                  <input type="datetime-local" name="show_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($editRow['show_time'])); ?>">
                </div>
                <div class="form-group">
                  <label class="form-control-label">End Time</label>
                  <input type="datetime-local" name="end_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($editRow['end_time'])); ?>">
                </div>
                <div class="form-group">
                  <label class="form-control-label">Price</label>
                  <input type="number" name="price" class="form-control" value="<?php echo $editRow['price']; ?>">
                </div>
                <div class="form-group">
                  <input type="submit" value="Update Showtime" class="btn btn-primary">
                </div>
              </form>
            </div>
            </div>
            </div>
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
            <div class="title"><strong>Add Showtime </strong></div>
            <div class="table-responsive"> 
              <div class="block-body">
                <form method="post" action="submit_showtime.php">
                  <div class="form-group">
                    <label class="form-control-label">Movie</label>
                    <select name="movie_id" class="form-control">
                      <?php
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
                          // Get the cinema name based on the cinema_id
                          $cinemaQuery = "SELECT name FROM cinema WHERE cinema_id = " . $row['cinema_id'];
                          $cinemaResult = mysqli_query($conn, $cinemaQuery);
                          $cinemaRow = mysqli_fetch_assoc($cinemaResult);
                        
                          // Display hall name and cinema name
                          echo '<option value="'. $row['hall_id']. '">Hall: '. $row['hall_id'] . ' |  Hall Type: ' . $row['hall_type_id'] . '   |  Cinema: ' . $cinemaRow['name'] . '</option>';

                      }
                      mysqli_close($conn);
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
                    <label class="form-control-label">Price</label>
                    <input type="number" name="price" class="form-control">
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




