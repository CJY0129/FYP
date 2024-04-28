
<div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Movies</h2>
          </div>
        </div>
        <?php
if (isset($_GET['show']) && $_GET['show'] == 'movie') 
{
  if (isset($_GET['success']) && $_GET['success'] == '1') 
  {
    echo '<div class="alert alert-success">New Movie added succesfully.</div>';
  }
  else if(isset($_GET['success']) && $_GET['success'] == '2') 
  {
    echo '<div class="alert alert-success">Movie updated succesfully.</div>';
  }
  else if(isset($_GET['success']) && $_GET['success'] == '3') 
  {
    echo '<div class="alert alert-success">Movie deleted succesfully.</div>';
  }
  else if(isset($_GET['success']) && $_GET['success'] == '4') 
  {
    echo '<div class="alert alert-success">New Movie added succesfully(without image).</div>';
  }
  


  if (isset($_GET['error']) && $_GET['error'] == '1') 
  {
    echo '<div class="alert alert-danger">Error adding new Movie.</div>';
  }
  else if(isset($_GET['error']) && $_GET['error'] == '2') 
  {
    echo '<div class="alert alert-danger">Error update Movie.</div>';
  }
  else if(isset($_GET['error']) && $_GET['error'] == '3') 
  {
    echo '<div class="alert alert-danger">Error deleting Movie.</div>';
  }
  else if(isset($_GET['error']) && $_GET['error'] == '4') 
  {
    echo '<div class="alert alert-danger">Error adding new Movie(without image).</div>';
  }
}
?>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active">Movies details            </li>
          </ul>
        </div>
        <section class="no-padding-top">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Movies details </strong></div>
                  <div class="table-responsive"> 
                  <?php
                  // Assuming you have a database connection established
                  include("connect.php");

                  // Function to display image from blob data
                  function displayImage($imageData) {
                    if (!empty($imageData)) {
                      return '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Movie Poster" width="100" height="150">';
                    } else {
                      return 'No Poster Available';
                    }
                  }

                  // Fetch data from the movie table
                  $query = "SELECT * FROM movie";
                  $result = mysqli_query($conn, $query);

                  // Check if there are any rows returned
                  if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-striped table-sm">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Movie ID</th>';
                    echo '<th>Title</th>';
                    echo '<th>Genre</th>';
                    echo '<th>Director</th>';
                    echo '<th>Cast</th>';
                    echo '<th>Synopsis</th>';
                    echo '<th>Duration</th>';
                    echo '<th>Release Date</th>';
                    echo '<th>Poster</th>';
                    echo '<th rowspan="2">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>' . $row['movie_id'] . '</td>';
                      echo '<td>' . $row['title'] . '</td>';
                      echo '<td>' . $row['genre'] . '</td>';
                      echo '<td>' . $row['director'] . '</td>';
                      echo '<td>' . $row['cast'] . '</td>';
                      echo '<td>' . $row['synopsis'] . '</td>';
                      echo '<td>' . $row['duration'] . '</td>';
                      echo '<td>' . $row['release_date'] . '</td>';
                      echo '<td>' . displayImage($row['poster_path']) . '</td>';
                      echo '<td><button type="button" class="icon fa fa-edit" data-toggle="modal" data-target="#editModal' . $row['movie_id'] . '"></button>
                      <a class="fa fa-trash-o" href="delete_movie.php?show_id='. $row['movie_id'].'" onclick="return confirmDelete();"></a></td>';
                      echo '</tr>';

                      // Modal for editing movie
                      echo '<div class="modal fade" id="editModal' . $row['movie_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $row['movie_id'] . '" aria-hidden="true">';
                      echo '<div class="modal-dialog" role="document">';
                      echo '<div class="modal-content">';
                      echo '<div class="modal-header">';
                      echo '<h5 class="modal-title" id="editModalLabel' . $row['movie_id'] . '">Edit Movie</h5>';
                      echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                      echo '<span aria-hidden="true">&times;</span>';
                      echo '</button>';
                      echo '</div>';
                      echo '<div class="modal-body">';
                      echo '<form method="post" action="update_movie.php" enctype="multipart/form-data">';
                      echo '<input type="hidden" name="movie_id" value="' . $row['movie_id'] . '">';
                      echo '<div class="form-group">';
                      echo '<label for="title">Title</label>';
                      echo '<input type="text" class="form-control" id="title" name="title" value="' . $row['title'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="genre">Genre</label>';
                      echo '<input type="text" class="form-control" id="genre" name="genre" value="' . $row['genre'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="director">Director</label>';
                      echo '<input type="text" class="form-control" id="director" name="director" value="' . $row['director'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="cast">Cast</label>';
                      echo '<input type="text" class="form-control" id="cast" name="cast" value="' . $row['cast'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="synopsis">Synopsis</label>';
                      echo '<textarea class="form-control" id="synopsis" name="synopsis">' . $row['synopsis'] . '</textarea>';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="duration">Duration</label>';
                      echo '<input type="text" class="form-control" id="duration" name="duration" value="' . $row['duration'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label for="release_date">Release Date</label>';
                      echo '<input type="text" class="form-control" id="release_date" name="release_date" value="' . $row['release_date'] . '">';
                      echo '</div>';
                      echo '<div class="form-group">';
                      echo '<label class="form-control-label">Poster</label>';
                      echo '<input type="file" name="poster" class="form-control-file" accept="image/*" onchange="previewImage(event)">';
                      echo '<img id="poster-preview-add" src="#" alt="Poster Preview" style="display: none; max-width: 50%; margin-top: 10px;">';
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
                    echo 'No movies found.';
                  }

              mysqli_close($conn);
              ?>
              <script>
                  function confirmDelete() {
                    return confirm("Are you sure you want to delete this showtime?");  
                  }
              </script>
              

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
                  <div class="title"><strong>Add Movie</strong></div>
                  <div class="table-responsive">
                    <div class="block-body">
                      <form method="post" action="submit_movie.php" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="form-control-label">Title</label>
                          <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Genre</label>
                          <input type="text" name="genre" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Director</label>
                          <input type="text" name="director" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Cast</label>
                          <input type="text" name="cast" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Synopsis</label>
                          <textarea name="synopsis" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Duration</label>
                          <input type="text" name="duration" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-control-label">Release Date</label>
                          <input type="date" name="release_date" class="form-control">
                        </div>
                        <div class="form-group">
                        <label class="form-control-label">Poster</label>
                        <input type="file" name="poster" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                        <img id="poster-preview-add" src="#" alt="Poster Preview" style="display: none; max-width: 50%; margin-top: 10px;">
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Add Movie" class="btn btn-primary">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <script>
                function previewImage(event) {
                  var posterPreview = event.target.parentElement.querySelector('img');
                  var file = event.target.files[0];
                  var reader = new FileReader();
                  reader.onload = function() {
                    posterPreview.src = reader.result;
                    posterPreview.style.display = 'block';
                  };
                  reader.readAsDataURL(file);
                } 
              </script>


