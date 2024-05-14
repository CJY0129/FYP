<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CineTime new Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/CT.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
    <div class="login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center">
                            <div class="content">
                                <div class="logo">
                                    <h1>CineTime</h1>
                                </div>
                                <p>Add new admin</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel -->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                    include("connect.php");

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Get form data
                                    $admin_username = $_POST['registerUsername'];
                                    $admin_email = $_POST['registerEmail'];
                                    $admin_password = $_POST['registerPassword'];
                                    $admin_name = $_POST['registerName'];
                                    $admin_phone = $_POST['registerPhone'];
                                    $is_admin = isset($_POST['isAdmin']) ? 1 : 0;
                                    $is_super_admin = isset($_POST['isSuperAdmin']) ? 1 : 0;

                                    // Check if username or email already exists
                                    $checkUserSql = "SELECT * FROM admin WHERE username='$admin_username' OR Email='$admin_email'";
                                    $result = $conn->query($checkUserSql);

                                    if ($result->num_rows > 0) {
                                        echo "<div class='alert alert-danger'>Error: Username or email address already exists</div>";
                                    } else {
                                        // Insert data into database
                                        $sql = "INSERT INTO admin (username, password, admin_name, is_admin, is_super_admin, Email, PhoneNumber) 
                                                VALUES ('$admin_username', '$admin_password', '$admin_name', '$is_admin', '$is_super_admin', '$admin_email', '$admin_phone')";

                                        if ($conn->query($sql) === TRUE) {
                                            echo "<div class='alert alert-success'>New admin added successfully</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                                        }
                                    }

                                    $conn->close();
                                }
                                ?>
                                <form method="post" class="text-left form-validate">
                                    <div class="form-group-material">
                                        <input id="register-username" type="text" name="registerUsername" required data-msg="Please enter your username" class="input-material">
                                        <label for="register-username" class="label-material">Username</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-email" type="email" name="registerEmail" required data-msg="Please enter a valid email address" class="input-material">
                                        <label for="register-email" class="label-material">Email Address</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-password" type="password" name="registerPassword" required data-msg="Please enter your password" class="input-material">
                                        <label for="register-password" class="label-material">Password</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-name" type="text" name="registerName" required data-msg="Please enter the admin name" class="input-material">
                                        <label for="register-name" class="label-material">Admin Name</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="register-phone" type="text" name="registerPhone" required data-msg="Please enter the phone number" class="input-material">
                                        <label for="register-phone" class="label-material">Phone Number</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="is-admin" type="checkbox" name="isAdmin" class="input-material">
                                        <label for="is-admin" class="label-material">Is Admin</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="is-super-admin" type="checkbox" name="isSuperAdmin" class="input-material">
                                        <label for="is-super-admin" class="label-material">Is Super Admin</label>
                                    </div>
                                    <div class="form-group text-center">
                                        <input id="register" type="submit" value="Register" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>2024 &copy; CineTime.</p>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
</body>
</html>
