<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM presentacion_a_la_comur WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio'];
}
if(isset($_POST['BP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Dictamen_PRODEUR.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['dictamen_prodeur'];
}
if(isset($_POST['CP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Acta_de_comur_1.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['acta_de_comur_1'];
}
if(isset($_POST['DP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Acta_de_comur_2.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['acta_de_comur_2'];
}
if(isset($_POST['EP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Publicacion.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['publicacion'];
}
if(isset($_POST['FP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Estudio.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['estudio_analisis_y_resolucion_del_expediente'];
}
if(isset($_POST['GP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Estudio_de_opinion.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['estudio_de_opinion'];
}
if(isset($_POST['HP5'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio_Regreso.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficion_regreso'];
}

?>