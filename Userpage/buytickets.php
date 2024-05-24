<?php 
$sql = "SELECT m.movie_id, m.title, m.poster_path, s.show_time, s.end_time, s.price 
FROM movie AS m 
INNER JOIN showtime AS s ON m.movie_id = s.Movie_id 
WHERE s.show_time > DATE_SUB(NOW(), INTERVAL 10 MINUTE)
GROUP BY m.movie_id
ORDER BY s.show_time ASC";

$result = $conn->query($sql);

?>
<div class="buy-ticket">
    <div class="container">
        <div class="buy-ticket-area">
            <a href="#"><i class="icofont icofont-close"></i></a>
            <div class="row">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-lg-3">'; // Set col-lg-6 for half width on large screens
                        echo '<div class="buy-ticket-box">';
                        
						if (!empty($row['poster_path'])) {
							$poster_data = base64_encode($row['poster_path']); // Convert blob data to base64
							$poster_src = 'data:image/jpg;base64,' . $poster_data; // Create the image source
							echo '<img src="' . $poster_src . '" alt="Movie Poster" width="165" height="325">';
						} else {
							echo '<p>No poster available</p>';
						}
                        echo '<p><strong>' . $row["title"] . '</strong></p>';
                        
                        // Query to get all upcoming showtimes for this movie
                        $movieId = $row["movie_id"];
                        $showtimesQuery = "SELECT show_id,show_time, end_time, price
                                           FROM showtime
                                           WHERE Movie_id = $movieId AND show_time > NOW()
                                           ORDER BY show_time ASC";
                        $showtimesResult = mysqli_query($conn, $showtimesQuery);
                        if (mysqli_num_rows($showtimesResult) > 0) {
							echo '<p>SHOWTIME</p>';
                            while ($showtimeRow = mysqli_fetch_assoc($showtimesResult)) {
								echo '<p><a href="booking.php?show_id=' . $showtimeRow["show_id"] . '">' . $showtimeRow["show_time"] . '</a></p>';
                            }
							
                        } else {
                            echo "<p>No upcoming showtimes found for this movie.</p>";
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
					echo "<p style='color: red; font-weight: bold;'>No movies found with upcoming showtimes within 10 minutes before the current time.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>