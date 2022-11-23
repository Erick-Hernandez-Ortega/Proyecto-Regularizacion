<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM presentacion_de_documentos_a_la_comur WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP2'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio'];
}
if(isset($_POST['BP2'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Solicitud_de_regularizacion.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['solicitud_de_regularizacion'];
}
if(isset($_POST['CP2'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Estudio_de_analisis.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['estudio_de_analisis'];
}
if(isset($_POST['DP2'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Acta_comur.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['acta_comur'];
}
if(isset($_POST['EP2'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio_Regreso.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio_regreso'];
}

?>