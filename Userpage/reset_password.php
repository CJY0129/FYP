<?php

$token = $_GET["token"];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <?php include('Head.php');?>
    <h1>Reset Password</h1>
    
    <form method="post" action="ConfirmReset.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>
</body>
</html>