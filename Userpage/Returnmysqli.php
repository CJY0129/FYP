<?php
$mysqli = new mysqli("localhost", "root", "", "cinetime");

if ($mysqli->connect_error) {
    die("连接失败: " . $mysqli->connect_error);
}

return $mysqli;
?>