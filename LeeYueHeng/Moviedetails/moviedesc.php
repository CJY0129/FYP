<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
</head>
<body>
    <h1>Movie List</h1>
    <div>
        <?php
        // Assuming you have established a database connection
        include("connection.php");

        // Query to retrieve movie titles and poster paths
        $sql = "SELECT title, poster_path FROM movie";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $poster_path = $row["poster_path"];
                ?>
                <div>
                    <h2><?php echo $title; ?></h2>
                    <img src="<?php echo $poster_path; ?>" alt="<?php echo $title; ?>" style="width: 200px;">
                </div>
                <?php
            }
        } else {
            echo "No movies found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
