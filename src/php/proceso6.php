<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivoproyecto = $_FILES["Definitivo"]["tmp_name"];
$tamproyecto = $_FILES["Definitivo"]["size"];

$a = 0;

if ($archivoproyecto != '') {
    $fp = fopen($archivoproyecto, "rb");
    $contenido = fread($fp, $tamproyecto);
    $contenido = addslashes($contenido);
    fclose($fp);

    $sql = "UPDATE proyecto_definitivo SET proyecto_definitivo = '$contenido', proyecto_definitivo_estatus = 1 WHERE folio = '$folio'";
    $rs = mysqli_query($conn, $sql);
    
    header("location: http://$host/Proyecto-Regularizacion/index.php");

    unset($_SESSION['reloadindex']);
    unset($_SESSION['reloadstatus']);
    unset($_SESSION['reloadadmin']);

    $a++;
}

if($a == 0){
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
}
?>
