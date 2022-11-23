<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivoproyecto = $_FILES["Definitivo"]["tmp_name"];
$nomproyecto = $_FILES["Definitivo"]["name"];
$tamproyecto = $_FILES["Definitivo"]["size"];

$a = 0;

if ($archivoproyecto != '') {
    $ext = substr($nomproyecto, -4);
    if($ext == '.pdf'){
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
    }else{
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'El archivo tiene que ser un PDF';
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    $a++;
    }
}

if($a == 0){
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
}
?>
