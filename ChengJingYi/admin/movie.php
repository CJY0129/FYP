
<div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Movies</h2>
          </div>
        </div>
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
                <div class="col-lg-6">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Movies details </strong></div>
                  <div class="table-responsive"> 
                  <?php
// Assuming you have a database connection established
include("connect.php");
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
    echo '<th>Poster Path</th>';
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
        echo '<td>' . $row['poster_path'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No movies found.';
}

// Close the database connection
mysqli_close($conn);
?>

                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Striped Table</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter  </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                </div>
            </div>
        </section>
              
