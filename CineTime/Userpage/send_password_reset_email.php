<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function send_password_reset_email($email, $token) {
    $mail = new PHPMailer(); // Initialize PHPMailer
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.example.com'; // Your SMTP server address
    $mail->Username = 'your_email@example.com'; // Your SMTP username
    $mail->Password = 'your_password'; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = 'Click the link below to reset your password:<br><a href="http://example.com/reset_password.php?token=' . $token . '">Reset Password</a>';

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}