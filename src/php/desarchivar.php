<?php 

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$sql = "UPDATE solicitud_de_regularizacion SET archivar = 0 WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);

$_SESSION['busqueda'] = false;
$_SESSION['colorToast'] = 'verde';
$_SESSION['mensajeToast'] = 'El folio ha sido desarchivado exitosamente!';
header("location: http://$host/Proyecto-Regularizacion/archivado.php");

?>