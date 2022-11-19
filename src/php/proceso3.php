<?php
include("db.php");
$host = $_SERVER['HTTP_HOST'];
$folio = $_POST['folio'];

$archivooficio = $_FILES["Oficio"]["tmp_name"];
$tamoficio = $_FILES["Oficio"]["size"];

$archivoestudio = $_FILES["Estudio"]["tmp_name"];
$tamestudio = $_FILES["Estudio"]["size"];

$archivoacta = $_FILES["Acta"]["tmp_name"];
$tamacta = $_FILES["Acta"]["size"];

$archivoactacom = $_FILES["ActaCom"]["tmp_name"];
$tamactacom = $_FILES["ActaCom"]["size"];

$archivoregreso = $_FILES["OficioRegreso"]["tmp_name"];
$tamregreso = $_FILES["OficioRegreso"]["size"];

$estado = $_POST["estado-oficio"];
$a = 0;

$csql = "SELECT oficio_regreso_estatus FROM segunda_presentacion_de_documentos_a_la_comur WHERE folio = '$folio'";
$q = mysqli_query($conn, $csql);
$est = mysqli_fetch_array($q);

if ($estado == '-Seleccione uno-') {
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'La opcion del estado de oficio de regreso no es válida...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
}else{
    if($archivooficio != ''){
        $fp = fopen($archivooficio, "rb");
        $contenido = fread($fp, $tamoficio);
        $contenido = addslashes($contenido);
        fclose($fp);

        $sql = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET oficio = '$contenido', oficio_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    if($archivoestudio != ''){
        $fp2 = fopen($archivoestudio, "rb");
        $contenido2 = fread($fp2, $tamestudio);
        $contenido2 = addslashes($contenido2);
        fclose($fp2);

        $sql = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET estudio_opinion = '$contenido2', estudio_opinion_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    if($archivoacta != ''){
        $fp3 = fopen($archivoacta, "rb");
        $contenido3 = fread($fp3, $tamacta);
        $contenido3 = addslashes($contenido3);
        fclose($fp3);

        $sql = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET acta_de_comur_proceso_2 = '$contenido3', acta_de_comur_proceso_2_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    if($archivoactacom != ''){
        $fp4 = fopen($archivoactacom, "rb");
        $contenido4 = fread($fp4, $tamactacom);
        $contenido4 = addslashes($contenido4);
        fclose($fp4);

        $sql = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET acta_comur_2 = '$contenido4', acta_comur_2_estatus = 1 WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    if($archivoregreso != ''){
        $fp5 = fopen($archivoregreso, "rb");
        $contenido5 = fread($fp5, $tamregreso);
        $contenido5 = addslashes($contenido5);
        fclose($fp5);

        $sql = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET oficio_regreso = '$contenido5' WHERE folio = '$folio'"; 
        $rs = mysqli_query($conn, $sql);
        $a++;
    }
    if($a == 0 && $estado == $est['oficio_regreso_estatus']){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    }else{
        $sql2 = "UPDATE segunda_presentacion_de_documentos_a_la_comur SET oficio_regreso_estatus = '$estado' WHERE folio = '$folio'";
        $query = mysqli_query($conn, $sql2);

        header("location: http://$host/Proyecto-Regularizacion/index.php");
        unset($_SESSION['reloadindex']);
        unset($_SESSION['reloadstatus']);
        unset($_SESSION['reloadadmin']);
    }
}

?>
