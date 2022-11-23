<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivooficio = $_FILES["Oficio"]["tmp_name"];
$nomoficio = $_FILES["Oficio"]["name"];
$tamoficio = $_FILES["Oficio"]["size"];

$archivoprodeur = $_FILES["DictamenPRODEUR"]["tmp_name"];
$nomprodeur = $_FILES["DictamenPRODEUR"]["name"];
$tamprodeur = $_FILES["DictamenPRODEUR"]["size"];

$archivocomur1 = $_FILES["Comur1"]["tmp_name"];
$nomcomur1 = $_FILES["Comur1"]["name"];
$tamcomur1 = $_FILES["Comur1"]["size"];

$archivocomur2 = $_FILES["Comur2"]["tmp_name"];
$nomcomur2 = $_FILES["Comur2"]["name"];
$tamcomur2 = $_FILES["Comur2"]["size"];

$archivopublicacion = $_FILES["Publicacion"]["tmp_name"];
$nompublicacion = $_FILES["Publicacion"]["name"];
$tampublicacion = $_FILES["Publicacion"]["size"];

$archivoestudioA = $_FILES["EstudioAnalisis"]["tmp_name"];
$nomestudioA = $_FILES["EstudioAnalisis"]["name"];
$tamestudioA = $_FILES["EstudioAnalisis"]["size"];

$archivoestudioO = $_FILES["EstudioOpinion"]["tmp_name"];
$nomestudioO = $_FILES["EstudioOpinion"]["name"];
$tamestudioO = $_FILES["EstudioOpinion"]["size"];

$archivooficioR = $_FILES["OficioRegreso"]["tmp_name"];
$nomoficioR = $_FILES["OficioRegreso"]["name"];
$tamoficioR = $_FILES["OficioRegreso"]["size"];

$estado = $_POST['estado-oficio'];
$a = 0;

$csql = "SELECT oficion_regreso_estatus FROM presentacion_a_la_comur WHERE folio = '$folio'";
$q = mysqli_query($conn, $csql);
$est = mysqli_fetch_array($q);

if ($estado == '-Seleccione uno-') {
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'La opcion del estado de oficio de regreso no es válida...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
} else {
    
    if ($archivooficio != '') {
        $ext = substr($nomoficio, -4);
        if($ext == '.pdf'){
        $fp = fopen($archivooficio, "rb");
        $contenido = fread($fp, $tamoficio);
        $contenido = addslashes($contenido);
        fclose($fp);

        $sql = "UPDATE presentacion_a_la_comur SET oficio = '$contenido', oficio_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivoprodeur != '') {
        $ext = substr($nomprodeur, -4);
        if($ext == '.pdf'){
        $fp3 = fopen($archivoprodeur, "rb");
        $contenido3 = fread($fp3, $tamprodeur);
        $contenido3 = addslashes($contenido3);
        fclose($fp3);

        $sql = "UPDATE presentacion_a_la_comur SET dictamen_prodeur = '$contenido3', dictamen_prodeur_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivocomur1 != '') {
        $ext = substr($nomcomur1, -4);
        if($ext == '.pdf'){
        $fp2 = fopen($archivocomur1, "rb");
        $contenido2 = fread($fp2, $tamcomur1);
        $contenido2 = addslashes($contenido2);
        fclose($fp2);

        $sql = "UPDATE presentacion_a_la_comur SET acta_de_comur_1 = '$contenido2', acta_de_comur_1_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c =1;
        }
    }

    if ($archivocomur2 != '') {
        $ext = substr($nomcomur2, -4);
        if($ext == '.pdf'){
        $fp4 = fopen($archivocomur2, "rb");
        $contenido4 = fread($fp4, $tamcomur2);
        $contenido4 = addslashes($contenido4);
        fclose($fp4);

        $sql = "UPDATE presentacion_a_la_comur SET acta_de_comur_2 = '$contenido4', acta_de_comur_2_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivopublicacion != '') {
        $ext = substr($nompublicacion, -4);
        if($ext == '.pdf'){
        $fp5 = fopen($archivopublicacion, "rb");
        $contenido5 = fread($fp5, $tampublicacion);
        $contenido5 = addslashes($contenido5);
        fclose($fp5);

        $sql = "UPDATE presentacion_a_la_comur SET publicacion = '$contenido5', publicacion_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivoestudioA != '') {
        $ext = substr($nomestudioA, -4);
        if($ext == '.pdf'){
        $fp6 = fopen($archivoestudioA, "rb");
        $contenido6 = fread($fp6, $tamestudioA);
        $contenido6 = addslashes($contenido6);
        fclose($fp6);

        $sql = "UPDATE presentacion_a_la_comur SET estudio_analisis_y_resolucion_del_expediente = '$contenido6', estudio_analisis_y_resolucion_del_expediente_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivoestudioO != '') {
        $ext = substr($nomestudioO, -4);
        if($ext == '.pdf'){
        $fp7 = fopen($archivoestudioO, "rb");
        $contenido7 = fread($fp7, $tamestudioO);
        $contenido7 = addslashes($contenido7);
        fclose($fp7);

        $sql = "UPDATE presentacion_a_la_comur SET estudio_de_opinion = '$contenido7', estudio_de_opinion_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivooficioR != '') {
        $ext = substr($nomoficioR, -4);
        if($ext == '.pdf'){
        $fp9 = fopen($archivooficioR, "rb");
        $contenido9 = fread($fp9, $tamoficioR);
        $contenido9 = addslashes($contenido9);
        fclose($fp9);

        $sql = "UPDATE presentacion_a_la_comur SET oficion_regreso = '$contenido9' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }
    
    if($a == 0 && $estado == $est['oficion_regreso_estatus']){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
    }else{
        $sql2 = "UPDATE presentacion_a_la_comur SET oficion_regreso_estatus = '$estado' WHERE folio = '$folio'";
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
