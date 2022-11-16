<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivoproyecto = $_FILES["Proyecto"]["tmp_name"];
$tamproyecto = $_FILES["Proyecto"]["size"];

$fp = fopen($archivoproyecto, "rb");
$contenido = fread($fp, $tamproyecto);
$contenido = addslashes($contenido);
fclose($fp);

$sql = "UPDATE proyecto_definitivo SET proyecto_definitivo = '$contenido', proyecto_definitivo_estatus = 1 WHERE folio = '$folio'";
$rs = mysqli_query($conn, $sql);

$_SESSION['busqueda'] = false;
$_SESSION['colorToast'] = 'verde';
$_SESSION['mensajeToast'] = 'El envio ha sido exitoso!';
header("location: http://$host/Proyecto-Regularizacion/index.php");

?>