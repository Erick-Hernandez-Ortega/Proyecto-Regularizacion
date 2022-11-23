<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['folio'];

$archivooficio = $_FILES["Oficio"]["tmp_name"];
$nomoficio = $_FILES["Oficio"]["name"];
$tamoficio = $_FILES["Oficio"]["size"];

$archivoconvenio = $_FILES["Convenio"]["tmp_name"];
$nomconvenio = $_FILES["Convenio"]["name"];
$tamconvenio = $_FILES["Convenio"]["size"];

$archivopresidente = $_FILES["Presidente"]["tmp_name"];
$nompresidente = $_FILES["Presidente"]["name"];
$tampresidente = $_FILES["Presidente"]["size"];

$archivosindico = $_FILES["Sindico"]["tmp_name"];
$nomsindico = $_FILES["Sindico"]["name"];
$tamsindico = $_FILES["Sindico"]["size"];

$archivosecretaria = $_FILES["Secretaria"]["tmp_name"];
$nomsecretaria = $_FILES["Secretaria"]["name"];
$tamsecretaria = $_FILES["Secretaria"]["size"];

$archivotesorero = $_FILES["Tesorero"]["tmp_name"];
$nomtesorero = $_FILES["Tesorero"]["name"];
$tamtesorero = $_FILES["Tesorero"]["size"];

$archivocomite = $_FILES["Comite"]["tmp_name"];
$nomcomite = $_FILES["Comite"]["name"];
$tamcomite = $_FILES["Comite"]["size"];

$archivosecretario = $_FILES["Secretario"]["tmp_name"];
$nomsecretario = $_FILES["Secretario"]["name"];
$tamsecretario = $_FILES["Secretario"]["size"];

$archivoprocurador = $_FILES["Procurador"]["tmp_name"];
$nomprocurador = $_FILES["Procurador"]["name"];
$tamprocurador = $_FILES["Procurador"]["size"];

$estadopresidente = $_POST['estado-presidente'];
$estadosindico = $_POST['estado-sindico'];
$estadosecretaria = $_POST['estado-secretaria'];
$estadotesorero = $_POST['estado-tesorero'];
$estadocomite = $_POST['estado-comite'];
$estadosecretario = $_POST['estado-secretario'];
$estadoprocurador = $_POST['estado-procurador'];

$a = 0;

$csql = "SELECT firma_presidente_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q = mysqli_query($conn, $csql);
$estpresidente = mysqli_fetch_array($q);

$csql2 = "SELECT firma_sindico_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q2 = mysqli_query($conn, $csql2);
$estsindico = mysqli_fetch_array($q2);

$csql3 = "SELECT firma_secretaria_general_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q3 = mysqli_query($conn, $csql3);
$estsecretaria = mysqli_fetch_array($q3);

$csql4 = "SELECT firma_tesorero_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q4 = mysqli_query($conn, $csql4);
$esttesorero = mysqli_fetch_array($q4);

$csql5 = "SELECT firma_secretario_tecnico_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q5 = mysqli_query($conn, $csql5);
$estsecretario = mysqli_fetch_array($q5);

$csql6 = "SELECT firma_presidente_de_comite_o_propietario_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q6 = mysqli_query($conn, $csql6);
$estcomite = mysqli_fetch_array($q6);

$csql7 = "SELECT firma_procurador_de_desarrollo_urbano_estatus FROM convenio_de_regularizacion WHERE folio = '$folio'";
$q7 = mysqli_query($conn, $csql7);
$estprocurador = mysqli_fetch_array($q7);

if ($estadopresidente == '-Seleccione uno-' || $estadosindico == '-Seleccione uno-' || $estadosecretaria == '-Seleccione uno-' || $estadotesorero == '-Seleccione uno-' || $estadosecretario == '-Seleccione uno-' || $estadocomite == '-Seleccione uno-' || $estadoprocurador == '-Seleccione uno-') {
    $_SESSION['busqueda'] = false;
    $_SESSION['colorToast'] = 'rojo';
    $_SESSION['mensajeToast'] = 'Alguno de los estados de firmas no es válido...';
    header("location: http://$host/Proyecto-Regularizacion/index.php");
}else{
    if ($archivooficio != '') {
        $ext = substr($nomoficio, -4);
        if($ext == '.pdf'){
        $fp = fopen($archivooficio, "rb");
        $contenido = fread($fp, $tamoficio);
        $contenido = addslashes($contenido);
        fclose($fp);

        $sql = "UPDATE convenio_de_regularizacion SET oficio_de_catastro = '$contenido', oficio_de_catastro_estatus = 1 WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivoconvenio != '') {
        $ext = substr($nomconvenio, -4);
        if($ext == '.pdf'){
        $fp3 = fopen($archivoconvenio, "rb");
        $contenido3 = fread($fp3, $tamconvenio);
        $contenido3 = addslashes($contenido3);
        fclose($fp3);

        $sql = "UPDATE convenio_de_regularizacion SET convenio_de_regularizacion = '$contenido3' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivopresidente != '') {
        $ext = substr($nompresidente, -4);
        if($ext == '.pdf'){
        $fp2 = fopen($archivopresidente, "rb");
        $contenido2 = fread($fp2, $tampresidente);
        $contenido2 = addslashes($contenido2);
        fclose($fp2);

        $sql = "UPDATE convenio_de_regularizacion SET firma_presidente = '$contenido2' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivosindico != '') {
        $ext = substr($nomsindico, -4);
        if($ext == '.pdf'){
        $fp4 = fopen($archivosindico, "rb");
        $contenido4 = fread($fp4, $tamsindico);
        $contenido4 = addslashes($contenido4);
        fclose($fp4);

        $sql = "UPDATE convenio_de_regularizacion SET firma_sindico = '$contenido4' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivosecretaria != '') {
        $ext = substr($nomsecretaria, -4);
        if($ext == '.pdf'){
        $fp5 = fopen($archivosecretaria, "rb");
        $contenido5 = fread($fp5, $tamsecretaria);
        $contenido5 = addslashes($contenido5);
        fclose($fp5);

        $sql = "UPDATE convenio_de_regularizacion SET firma_secretaria_general = '$contenido5' folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivotesorero != '') {
        $ext = substr($nomtesorero, -4);
        if($ext == '.pdf'){
        $fp6 = fopen($archivotesorero, "rb");
        $contenido6 = fread($fp6, $tamtesorero);
        $contenido6 = addslashes($contenido6);
        fclose($fp6);

        $sql = "UPDATE convenio_de_regularizacion SET firma_tesorero = '$contenido6' folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivosecretario != '') {
        $ext = substr($nomsecretario, -4);
        if($ext == '.pdf'){
        $fp7 = fopen($archivosecretario, "rb");
        $contenido7 = fread($fp7, $tamsecretario);
        $contenido7 = addslashes($contenido7);
        fclose($fp7);

        $sql = "UPDATE convenio_de_regularizacion SET firma_secretario_tecnico = '$contenido7' folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivocomite != '') {
        $ext = substr($nomcomite, -4);
        if($ext == '.pdf'){
        $fp9 = fopen($archivocomite, "rb");
        $contenido9 = fread($fp9, $tamcomite);
        $contenido9 = addslashes($contenido9);
        fclose($fp9);

        $sql = "UPDATE convenio_de_regularizacion SET firma_presidente_de_comite_o_propietario = '$contenido9' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if ($archivoprocurador != '') {
        $ext = substr($nomprocurador, -4);
        if($ext == '.pdf'){
        $fp9 = fopen($archivoprocurador, "rb");
        $contenido9 = fread($fp9, $tamprocurador);
        $contenido9 = addslashes($contenido9);
        fclose($fp9);

        $sql = "UPDATE convenio_de_regularizacion SET firma_procurador_de_desarrollo_urbano = '$contenido9' WHERE folio = '$folio'";
        $rs = mysqli_query($conn, $sql);
        $a++;
        }else{
            $c = 1;
        }
    }

    if($a == 0 && $estadopresidente == $estpresidente['firma_presidente_estatus'] && $estadosindico == $estsindico['firma_sindico_estatus'] && $estadosecretaria == $estsecretaria['firma_secretaria_general_estatus'] 
    && $estadotesorero == $esttesorero['firma_tesorero_estatus'] && $estadosecretario == $estsecretario['firma_secretario_tecnico_estatus'] && $estadocomite == $estcomite['firma_presidente_de_comite_o_propietario_estatus']
    && $estadoprocurador == $estprocurador['firma_procurador_de_desarrollo_urbano_estatus']){
        $_SESSION['busqueda'] = false;
        $_SESSION['colorToast'] = 'rojo';
        $_SESSION['mensajeToast'] = 'No has seleccionado nada, intentalo de nuevo...';
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    }else{
        $sql2 = "UPDATE convenio_de_regularizacion SET firma_presidente_estatus = '$estadopresidente' WHERE folio = '$folio'";
        $query = mysqli_query($conn, $sql2);

        $sql3 = "UPDATE convenio_de_regularizacion SET firma_sindico_estatus = '$estadosindico' WHERE folio = '$folio'";
        $query3 = mysqli_query($conn, $sql3);

        $sql4 = "UPDATE convenio_de_regularizacion SET firma_secretaria_general_estatus = '$estadosecretaria' WHERE folio = '$folio'";
        $query4 = mysqli_query($conn, $sql4);

        $sql5 = "UPDATE convenio_de_regularizacion SET firma_tesorero_estatus = '$estadotesorero' WHERE folio = '$folio'";
        $query5 = mysqli_query($conn, $sql5);

        $sql6 = "UPDATE convenio_de_regularizacion SET firma_secretario_tecnico_estatus = '$estadosecretario' WHERE folio = '$folio'";
        $query6 = mysqli_query($conn, $sql6);

        $sql7 = "UPDATE convenio_de_regularizacion SET firma_presidente_de_comite_o_propietario_estatus = '$estadocomite' WHERE folio = '$folio'";
        $query7 = mysqli_query($conn, $sql7);

        $sql8 = "UPDATE convenio_de_regularizacion SET firma_procurador_de_desarrollo_urbano_estatus = '$estadoprocurador' WHERE folio = '$folio'";
        $query8 = mysqli_query($conn, $sql8);

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
