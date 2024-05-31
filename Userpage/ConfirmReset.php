<?php

$token = $_POST["token"];
$token_hash = hash("sha256", $token);
$mysqli = require __DIR__ . "/Returnmysqli.php";
$sql = "SELECT * FROM user
        WHERE Reset_Token_Hash = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["Reset_Token_Expires"]) <= time()) {
    die("token has expired");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET User_Pass = ?,
            Reset_Token_Hash = NULL,
            Reset_Token_Expires = NULL
        WHERE User_ID = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["User_ID"]);

$stmt->execute();

echo "Password updated. You can now login.";