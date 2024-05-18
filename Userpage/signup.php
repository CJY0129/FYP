<?php
session_start();
include('connection.php');
$error_message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // Fetch form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $Gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone'];

        // You may want to add validation and sanitization here

        // Insert the data into the database
        $sql = "INSERT INTO user (username, password, first_name, last_name, Gender, email, phone_number) 
                VALUES ('$username', '$password', '$first_name', '$last_name', '$Gender', '$email', '$phone_number')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            // Error occurred while registering
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Include your CSS files here -->
</head>
<body>
<h2>Sign Up</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h6>Username</h6>
    <input type="text" name="username" required>
    <h6>Password</h6>
    <input type="password" name="password" required>
    <h6>First Name</h6>
    <input type="text" name="firstname" required>
    <h6>Last Name</h6>
    <input type="text" name="lastname" required>
    <h6>Gender</h6>
    <select name="gender" required>
        <option value="M">Male</option>
        <option value="F">Female</option>
    </select>
    <h6>Email</h6>
    <input type="email" name="email" required>
    <h6>Phone Number</h6>
    <input type="text" name="phone" required>
    <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <button type="submit" name="signup">Sign Up</button>
</form>

<!-- Include your footer if needed -->

</body>
</html>
