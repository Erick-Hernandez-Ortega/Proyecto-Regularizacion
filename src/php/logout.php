<?php
session_destroy();
$host = $_SERVER['HTTP_HOST'];
header("location: http://$host/Proyecto-Regularizacion/login.php");
exit();
?>
