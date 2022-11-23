<?php 

    include("db.php");

    $folio = $_POST['folio'];

    $sql = "SELECT * FROM solicitud_de_regularizacion WHERE folio = '$folio'";
    $query = mysqli_query($conn, $sql);
    $text = mysqli_fetch_array($query);

    if(isset($_POST['AP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Solicitud.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['solicitud'];
    }
    if(isset($_POST['BP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Escritura.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['escritura'];
    }
    if(isset($_POST['CP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Identificacion.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['identificacion'];
    }
    if(isset($_POST['DP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Historial_Catastral.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['historial_catastral'];
    }
    if(isset($_POST['EP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Resolucion_Idicial.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['resolucion_idicial'];
    }
    if(isset($_POST['FP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Certifiacion_De_Hechos.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['certificacion_de_hechos'];
    }
    if(isset($_POST['GP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Foto_Aerea.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['foto_aerea'];
    }
    if(isset($_POST['HP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Oficio.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['oficio'];
    }
    if(isset($_POST['IP1'])){
        header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=$folio-Oficio_de_Regreso.pdf");
        header('Content-Transfer-Encoding: binary');
        echo $text['oficio_regreso'];
    }
    
?>
