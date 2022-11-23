<?php

include("db.php");

$folio = $_POST['folio'];

$sql = "SELECT * FROM proyecto_definitivo WHERE folio = '$folio'";
$query = mysqli_query($conn, $sql);
$text = mysqli_fetch_array($query);

if(isset($_POST['AP6'])){
    header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$folio-Proyecto_Definitivo.pdf");
    header('Content-Transfer-Encoding: binary');
    echo $text['proyecto_definitivo'];
}

?>