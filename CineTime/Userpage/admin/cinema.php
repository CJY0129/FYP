<div class="page-content">
    <!-- Page Header-->
    <div class="page-header no-margin-bottom">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Cinemas and Halls</h2>
        </div>
    </div>
    <?php
    if (isset($_GET['show']) && $_GET['show'] == 'cinema') {
        if (isset($_GET['success'])) {
            switch ($_GET['success']) {
                case '1':
                    echo '<div class="alert alert-success">New Cinema added successfully.</div>';
                    break;
                case '2':
                    echo '<div class="alert alert-success">Cinema updated successfully.</div>';
                    break;
                case '3':
                    echo '<div class="alert alert-success">Cinema deleted successfully.</div>';
                    break;
            }
        } elseif (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case '1':
                    echo '<div class="alert alert-danger">Error adding new Cinema.</div>';
                    break;
                case '2':
                    echo '<div class="alert alert-danger">Error updating Cinema.</div>';
                    break;
                case '3':
                    echo '<div class="alert alert-danger">Error deleting Cinema.</div>';
                    break;
            }
        }
    }
    ?>
    <!-- Breadcrumb-->
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active">Cinemas and Halls</li>
        </ul>
    </div>
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block margin-bottom-sm">
                        <div class="title"><strong>Cinema Details</strong></div>
                        <div class="table-responsive">
                            <?php
                            // Assuming you have a database connection established
                            include("connect.php");

                            // Fetch data from the cinema table
                            $query = "SELECT * FROM cinema";
                            $result = mysqli_query($conn, $query);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-striped table-sm">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Cinema ID</th>';
                                echo '<th>Name</th>';
                                echo '<th>Location</th>';
                                echo '<th>City</th>';
                                echo '<th>Number of Halls</th>';
                                echo '<th>Action</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';

                                // Loop through each row of the result
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['cinema_id'] . '</td>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    echo '<td>' . $row['location'] . '</td>';
                                    echo '<td>' . $row['city'] . '</td>';
                                    echo '<td>' . $row['num_of_hall'] . '</td>';
                                    echo '<td><button type="button" class="close" data-toggle="modal" data-target="#editModal' . $row['cinema_id'] . '"><i class="fa fa-edit" style="color:#ff4759;"></i></button>
                                    <a class="fa fa-trash-o" style="font-size:25px" href="delete_cinema.php?cinema_id=' . $row['cinema_id'] . '" onclick="return confirmDelete();"></a></td>';
                                    echo '</tr>';

                                    // Modal for editing cinema
                                    echo '<div class="modal fade" id="editModal' . $row['cinema_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $row['cinema_id'] . '" aria-hidden="true">';
                                    echo '<div class="modal-dialog" role="document">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="editModalLabel' . $row['cinema_id'] . '">Edit Cinema</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                    echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';
                                    echo '<form method="post" action="update_cinema.php">';
                                    echo '<input type="hidden" name="cinema_id" value="' . $row['cinema_id'] . '">';
                                    echo '<div class="form-group">';
                                    echo '<label for="name">Name</label>';
                                    echo '<input type="text" class="form-control" id="name" name="name" value="' . $row['name'] . '">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="location">Location</label>';
                                    echo '<input type="text" class="form-control" id="location" name="location" value="' . $row['location'] . '">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="city">City</label>';
                                    echo '<input type="text" class="form-control" id="city" name="city" value="' . $row['city'] . '">';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="num_of_hall">Number of Halls</label>';
                                    echo '<input type="number" class="form-control" id="num_of_hall" name="num_of_hall" value="' . $row['num_of_hall'] . '">';
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
                                echo 'No cinemas found.';
                            }

                            mysqli_close($conn);
                            ?>
                            <script>
                                function confirmDelete() {
                                    return confirm("Are you sure you want to delete this cinema?");
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
                        <div class="title"><strong>Add Cinema</strong></div>
                        <div class="table-responsive">
                            <div class="block-body">
                                <form method="post" action="submit_cinema.php">
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Location</label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Number of Halls</label>
                                        <input type="number" name="num_of_hall" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add Cinema" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Halls Section -->
    <section class="no-padding-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block margin-bottom-sm">
                        <div class="title"><strong>Hall Details</strong></div>
                        <div class="table-responsive">
                            <?php
                            // Assuming you have a database connection established
                            include("connect.php");

                            // Fetch data from the hall table
                            $query = "SELECT h.hall_id,h.hall_num, h.cinema_id, h.number_of_seat, c.name AS cinema_name FROM hall h JOIN cinema c ON h.cinema_id = c.cinema_id";
                            $result = mysqli_query($conn, $query);

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-striped table-sm">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Hall ID</th>';
                                echo '<th>Hall Number</th>';
                                echo '<th>Cinema Name</th>';
                                echo '<th>Number of Seats</th>';
                                echo '<th>Action</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';

                                // Loop through each row of the result
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['hall_id'] . '</td>';
                                    echo '<td>' . $row['hall_num'] . '</td>';
                                    echo '<td>' . $row['cinema_name'] . '</td>';
                                    echo '<td>' . $row['number_of_seat'] . '</td>';
                                    echo '<td><button type="button" class="close" data-toggle="modal" data-target="#editModalHall' . $row['hall_id'] . '"><i class="fa fa-edit" style="color:#ff4759;"></i></button>
                                    <a class="fa fa-trash-o" style="font-size:25px" href="delete_hall.php?hall_id=' . $row['hall_id'] . '" onclick="return confirmDelete();"></a></td>';
                                    echo '</tr>';

                                    // Modal for editing hall
                                    echo '<div class="modal fade" id="editModalHall' . $row['hall_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabelHall' . $row['hall_id'] . '" aria-hidden="true">';
                                    echo '<div class="modal-dialog" role="document">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="editModalLabelHall' . $row['hall_id'] . '">Edit Hall</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                    echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';
                                    echo '<form method="post" action="update_hall.php">';
                                    echo '<input type="hidden" name="hall_id" value="' . $row['hall_id'] . '">';
                                    echo '<div class="form-group">';
                                    echo '<div class="form-group">';
                                    echo '<label for="number_of_seat">Hall Number</label>';
                                    echo '<input type="number" class="form-control" id="hall_num" name="hall_num" value="' . $row['hall_num'] . '">';
                                    echo '</div>';
                                    echo '<label for="cinema_id">Cinema</label>';
                                    echo '<select class="form-control" id="cinema_id" name="cinema_id">';
                                    // Fetch cinemas for dropdown
                                    $cinemaQuery = "SELECT cinema_id, name FROM cinema";
                                    $cinemaResult = mysqli_query($conn, $cinemaQuery);
                                    while ($cinemaRow = mysqli_fetch_assoc($cinemaResult)) {
                                        $selected = ($cinemaRow['cinema_id'] == $row['cinema_id']) ? 'selected' : '';
                                        echo '<option value="' . $cinemaRow['cinema_id'] . '" ' . $selected . '>' . $cinemaRow['name'] . '</option>';
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="number_of_seat">Number of Seats</label>';
                                    echo '<input type="number" class="form-control" id="number_of_seat" name="number_of_seat" value="' . $row['number_of_seat'] . '">';
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
                                echo 'No halls found.';
                            }

                            mysqli_close($conn);
                            ?>
                            <script>
                                function confirmDelete() {
                                    return confirm("Are you sure you want to delete this hall?");
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
                        <div class="title"><strong>Add Hall</strong></div>
                        <div class="table-responsive">
                            <div class="block-body">
                                <form method="post" action="submit_hall.php">
                                <div class="form-group">
                                        <label class="form-control-label">Hall Number</label>
                                        <input type="number" name="hall_num" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Cinema</label>
                                        <select class="form-control" name="cinema_id">
                                            <?php
                                            // Fetch cinemas for dropdown
                                            include("connect.php");
                                            $cinemaQuery = "SELECT cinema_id, name FROM cinema";
                                            $cinemaResult = mysqli_query($conn, $cinemaQuery);
                                            while ($cinemaRow = mysqli_fetch_assoc($cinemaResult)) {
                                                echo '<option value="' . $cinemaRow['cinema_id'] . '">' . $cinemaRow['name'] . '</option>';
                                            }
                                            mysqli_close($conn);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Number of Seats</label>
                                        <input type="number" name="number_of_seat" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add Hall" class="btn btn-primary">
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
