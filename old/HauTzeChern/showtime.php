<?php
              include("testse.php");
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
                  echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
              } else {
                echo 'No showtime details found.';
              }

              ?>