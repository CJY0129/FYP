<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
    $mysqli = require __DIR__ . "/Returnmysqli.php";
    $sql = "UPDATE user
            SET Reset_Token_Hash = ?,
                Reset_Token_Expires = ?
            WHERE User_Email = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();

        if ($mysqli->affected_rows) {
            $mail = require __DIR__ . "/mailer.php";

            $mail->setFrom("leeyueheng04@gmail.com");
            $mail->addAddress($email);
            $mail->Subject = "Password Reset";
            $mail->Body = <<<END
            Click <a href="http://localhost/FYP/Reset_Password.php?token=$token">here</a> 
            to reset your password.
            END;

            try {
                $mail->send();
                echo "Message sent, please check your inbox.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            }
        } else {
            echo "No user found with that email.";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: {$mysqli->error}";
    }

    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>
<body>
    <?php include('header.php'); ?>
    <form action="forgot_password.php" method="POST">
    <input type="email" name="email" placeholder="Enter your email">
    <button type="submit">Reset Password</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>