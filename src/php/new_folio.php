<?php
include("db.php");
$host = $_SERVER['HTTP_HOST'];

$folio = $_POST['numfolio'];

if ($folio == null || $folio == " "|| substr($folio, -1)==" ") {
    $_SESSION['busqueda'] = false;
    $_SESSION['mensajeToast'] = 'El folio que ingresaste no es valido, vuelve a intentarlo...';
    $_SESSION['colorToast'] = 'rojo';

    if ($_SESSION['Tipo'] == 'Capturista') {
        header("location: http://$host/Proyecto-Regularizacion/index.php");
    } else {
        header("location: http://$host/Proyecto-Regularizacion/admin.php");
    }
} else {
    $query = "SELECT folio FROM solicitud_de_regularizacion WHERE folio='$folio'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res);
    if ($row['folio'] != $folio) {

        $sql = "INSERT INTO solicitud_de_regularizacion(folio)VALUE('$folio')";

        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            $_SESSION['busqueda'] = false;
            $_SESSION['mensajeToast'] = 'El registro del folio ha sido exitoso!';
            $_SESSION['colorToast'] = 'verde';

            if ($_SESSION['Tipo'] == 'Capturista') {
                header("location: http://$host/Proyecto-Regularizacion/index.php");
                unset($_SESSION['reloadindex']);
                unset($_SESSION['reloadstatus']);
            } else {
                header("location: http://$host/Proyecto-Regularizacion/admin.php");
                unset($_SESSION['reloadadmin']);
                unset($_SESSION['reloadstatus']);
            }
        } else {
            $_SESSION['busqueda'] = false;
            $_SESSION['mensajeToast'] = 'Ocurrió un error al registrar el folio... Vuelve a intentearlo...';
            $_SESSION['colorToast'] = 'rojo';

            if ($_SESSION['Tipo'] == 'Capturista') {
                header("location: http://$host/Proyecto-Regularizacion/index.php");
            } else {
                header("location: http://$host/Proyecto-Regularizacion/admin.php");
            }
        }
    }else{
        $_SESSION['busqueda'] = false;
        $_SESSION['mensajeToast'] = 'El folio que ingresaste ya existe en la base de datos, intenta con otro...';
        $_SESSION['colorToast'] = 'rojo';

        if ($_SESSION['Tipo'] == 'Capturista') {
            header("location: http://$host/Proyecto-Regularizacion/index.php");
        } else {
            header("location: http://$host/Proyecto-Regularizacion/admin.php");
        }
    }
}
?>
