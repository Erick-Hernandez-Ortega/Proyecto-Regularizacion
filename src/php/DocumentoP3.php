<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM segunda_presentacion_de_documentos_a_la_comur WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP3'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio'];
}
if(isset($_POST['BP3'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Estudio_opinion.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['estudio_opinion'];
}
if(isset($_POST['CP3'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Acta_de_comur.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['acta_de_comur_proceso_2'];
}
if(isset($_POST['DP3'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Acta_comur_2.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['acta_comur_2'];
}
if(isset($_POST['EP3'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio_Regreso.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio_regreso'];
}

?>