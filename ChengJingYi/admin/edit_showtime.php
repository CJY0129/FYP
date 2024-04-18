<?php
if (isset($_GET['show_id'])) {
    $showId = $_GET['show_id'];
    $editQuery = "SELECT * FROM showtime WHERE show_id = $showId";
    $editResult = mysqli_query($conn, $editQuery);
    $editRow = mysqli_fetch_assoc($editResult);
?>
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                    <div class="title"><strong>Edit Showtime</strong></div>
                    <div class="table-responsive">
                        <div class="block-body">
                            <form method="post" action="update_showtime.php">
                                <input type="hidden" name="show_id" value="<?php echo $editRow['show_id']; ?>">
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
</section>
<?php
}
?>
