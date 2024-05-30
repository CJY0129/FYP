<?php session_start();
$_SESSION['totalprice'] = $_GET["totalPrice"]; 

?>
<p><?= $_SESSION['totalprice']?></p>