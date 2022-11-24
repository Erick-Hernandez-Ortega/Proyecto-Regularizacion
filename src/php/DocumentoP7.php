<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM convenio_de_regularizacion WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio_de_Catastro.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio_de_castastro'];
}
if(isset($_POST['BP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Convenio_de_regularizacion.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['convenio_de_regularizacion'];
}
if(isset($_POST['CP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_presidente.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_presidente'];
}
if(isset($_POST['DP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_sindico.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_sindico'];
}
if(isset($_POST['EP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_secretaria_general.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_secretaria_general'];
}
if(isset($_POST['FP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_tesorero.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_tesorero'];
}
if(isset($_POST['GP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_presidente_de_comite_o_propietario.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_presidente_de_comite_o_propietario'];
}
if(isset($_POST['HP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_secretario_tecnico.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_secretario_tecnico'];
}
if(isset($_POST['IP7'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Firma_procurador_de_desarrollo_urbano.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['firma_procurador_de_desarrollo_urbano'];
}

?>
