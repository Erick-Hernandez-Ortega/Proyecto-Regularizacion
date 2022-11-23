<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM solicitud_por_oficio_a_la_prodeur WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP4'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio'];
}
if(isset($_POST['BP4'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Dictamen.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['dictamen'];
}
if(isset($_POST['CP4'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Oficio_Regreso.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['oficio_regreso'];
}

?>