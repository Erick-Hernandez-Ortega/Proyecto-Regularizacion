<?php
include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivosolicitud = $_FILES["Solicitud"]["tmp_name"];
$tamsolicitud = $_FILES["Solicitud"]["size"];

$archivoescrituras = $_FILES["Escrituras"]["tmp_name"];
$tamescrituras = $_FILES["Escrituras"]["size"];

$archivoidentificacion = $_FILES["Identificacion"]["tmp_name"];
$tamidentificacion = $_FILES["Identificacion"]["size"];

$archivocatastral = $_FILES["HistorialCat"]["tmp_name"];
$tamcatastral = $_FILES["HistorialCat"]["size"];

$archivoidicial = $_FILES["ResolucionId"]["tmp_name"];
$tamidicial = $_FILES["ResolucionId"]["size"];

$archivohechos = $_FILES["CertificacionH"]["tmp_name"];
$tamhechos = $_FILES["CertificacionH"]["size"];

$archivoaerea = $_FILES["FotoAerea"]["tmp_name"];
$tamaerea = $_FILES["FotoAerea"]["size"];

$archivooficio = $_FILES["Oficio"]["tmp_name"];
$tamoficio = $_FILES["Oficio"]["size"];

$archivoregreso = $_FILES["OficioRegreso"]["tmp_name"];
$tamregreso = $_FILES["OficioRegreso"]["size"];

$estado = $_POST['estado-oficio'];
$cont = 0;

$csql = "SELECT oficio_regreso_estatus FROM solicitud_de_regularizacion WHERE folio = '$folio'";
$q = mysqli_query($conn, $csql);
$est = mysqli_fetch_array($q);

if ($estado == '-Seleccione uno-') {
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'La opcion del estado de oficio de regreso no es válida...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
} else {
    
    if ($archivosolicitud != '') {
        $fp = fopen($archivosolicitud, "rb");
        $contenido = fread($fp, $tamsolicitud);
        $contenido = addslashes($contenido);
        fclose($fp);

        $sql = "UPDATE solicitud_de_regularizacion SET solicitud = '$contenido', solicidud_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivoescrituras != '') {
        $fp3 = fopen($archivoescrituras, "rb");
        $contenido3 = fread($fp3, $tamescrituras);
        $contenido3 = addslashes($contenido3);
        fclose($fp3);

        $sql = "UPDATE solicitud_de_regularizacion SET escritura = '$contenido3', escritura_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivoidentificacion != '') {
        $fp2 = fopen($archivoidentificacion, "rb");
        $contenido2 = fread($fp2, $tamidentificacion);
        $contenido2 = addslashes($contenido2);
        fclose($fp2);

        $sql = "UPDATE solicitud_de_regularizacion SET identificacion = '$contenido2', identificacion_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivocatastral != '') {
        $fp4 = fopen($archivocatastral, "rb");
        $contenido4 = fread($fp4, $tamcatastral);
        $contenido4 = addslashes($contenido4);
        fclose($fp4);

        $sql = "UPDATE solicitud_de_regularizacion SET historial_catastral = '$contenido4', historial_catastral_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivoidicial != '') {
        $fp5 = fopen($archivoidicial, "rb");
        $contenido5 = fread($fp5, $tamidicial);
        $contenido5 = addslashes($contenido5);
        fclose($fp5);

        $sql = "UPDATE solicitud_de_regularizacion SET resolucion_idicial = '$contenido5', resolucion_idicial_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivohechos != '') {
        $fp6 = fopen($archivohechos, "rb");
        $contenido6 = fread($fp6, $tamhechos);
        $contenido6 = addslashes($contenido6);
        fclose($fp6);

        $sql = "UPDATE solicitud_de_regularizacion SET certificacion_de_hechos = '$contenido6', certificacion_de_hechos_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivoaerea != '') {
        $fp7 = fopen($archivoaerea, "rb");
        $contenido7 = fread($fp7, $tamaerea);
        $contenido7 = addslashes($contenido7);
        fclose($fp7);

        $sql = "UPDATE solicitud_de_regularizacion SET foto_aerea = '$contenido7', foto_aerea_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivooficio != '') {
        $fp8 = fopen($archivooficio, "rb");
        $contenido8 = fread($fp8, $tamoficio);
        $contenido8 = addslashes($contenido8);
        fclose($fp8);

        $sql = "UPDATE solicitud_de_regularizacion SET oficio = '$contenido8', oficio_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }

    if ($archivoregreso != '') {
        $fp9 = fopen($archivoregreso, "rb");
        $contenido9 = fread($fp9, $tamregreso);
        $contenido9 = addslashes($contenido9);
        fclose($fp9);

        $sql = "UPDATE solicitud_de_regularizacion SET oficio_regreso = '$contenido9' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    
    if($a == 0 && $estado == $est['oficio_regreso_estatus']){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    }else{
        $sql2 = "UPDATE solicitud_de_regularizacion SET oficio_regreso_estatus = '$estado' WHERE folio = '$folio'";
        $query = mysqli_query($conn, $sql2);

        header("location: http://$host/Proyecto-Regularizacion/index.php");

        unset($_SESSION['reloadindex']);
        unset($_SESSION['reloadstatus']);
        unset($_SESSION['reloadadmin']);
    }
    
}
?>
