<?php
include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivodictamen = $_FILES["Dictamen"]["tmp_name"];
$nomdictamen = $_FILES["Dictamen"]["name"];
$tamdictamen = $_FILES["Dictamen"]["size"];

$archivooficio = $_FILES["Oficio"]["tmp_name"];
$nomoficio = $_FILES["Oficio"]["name"];
$tamoficio = $_FILES["Oficio"]["size"];

$archivoregreso = $_FILES["OficioRegreso"]["tmp_name"];
$nomregreso = $_FILES["OficioRegreso"]["name"];
$tamregreso = $_FILES["OficioRegreso"]["size"];

$estado = $_POST["estado-oficio"];
$a = 0;

$csql = "SELECT oficio_regreso_estatus FROM solicitud_por_oficio_a_la_prodeur WHERE folio = '$folio'";
$q = mysqli_query($conn, $csql);
$est = mysqli_fetch_array($q);

if ($estado == '-Seleccione uno-') {
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'La opcion del estado de oficio de regreso no es válida...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
}else{
    if($archivodictamen != ''){
        $ext = substr($nomdictamen, -4);
        if($ext == '.pdf'){
        $fp = fopen($archivodictamen, "rb");
        $contenido = fread($fp, $tamdictamen);
        $contenido = addslashes($contenido);
        fclose($fp);

        $sql = "UPDATE solicitud_por_oficio_a_la_prodeur SET dictamen = '$contenido', dictamen_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }
    if($archivooficio != ''){
        $ext = substr($nomoficio, -4);
        if($ext == '.pdf'){
        $fp2 = fopen($archivooficio, "rb");
        $contenido2 = fread($fp2, $tamoficio);
        $contenido2 = addslashes($contenido2);
        fclose($fp2);

        $sql = "UPDATE solicitud_por_oficio_a_la_prodeur SET oficio = '$contenido2', oficio_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }
    if($archivoregreso != ''){
        $ext = substr($nomregreso, -4);
        if($ext == '.pdf'){
        $fp3 = fopen($archivoregreso, "rb");
        $contenido3 = fread($fp3, $tamregreso);
        $contenido3 = addslashes($contenido3);
        fclose($fp3);

        $sql = "UPDATE solicitud_por_oficio_a_la_prodeur SET oficio_regreso = '$contenido3' WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }
    if($a == 0 && $estado == $est['oficio_regreso_estatus']){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
    }else{
        $sql2 = "UPDATE solicitud_por_oficio_a_la_prodeur SET oficio_regreso_estatus = '$estado' WHERE folio = '$folio'";
        $query = mysqli_query($conn, $sql2);
        $c = 0;

        header("location: http://$host/Proyecto-Regularizacion/index.php");
        unset($_SESSION['reloadindex']);
        unset($_SESSION['reloadstatus']);
        unset($_SESSION['reloadadmin']);
    }

    if($c == 1){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'El archivo tiene que ser un PDF';
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    }
}
?>
