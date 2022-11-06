<?php

include("db.php");

$host = $_SERVER['HTTP_HOST'];

$email = $_POST['email'];
$emailAdmin = $_POST['emailAdmin'];
$passAdmin = $_POST['passAdmin'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $consulta = "SELECT Tipo_de_usuario FROM usuarios_regulacion WHERE Email = '$emailAdmin' AND Contraseña = '$passAdmin'";
    $res_query = mysqli_query($conn, $consulta);
    $resultado = mysqli_fetch_array($res_query);

    if ($resultado['Tipo_de_usuario'] != 'Administrador') {
        $_SESSION['mensaje-modal'] = "Las credenciales del administrador son incorrectas!";
        $_SESSION['color-modal'] = 'danger';

        $_SESSION['mensaje'] = "Error al recuperar contraseña...";
        $_SESSION['color'] = 'danger';
        $_SESSION['destroy'] = false;

        header("location: http://$host/Proyecto-Regularizacion/login.php");
    } else {
        $consulta = "SELECT Contraseña FROM usuarios_regulacion WHERE Email = '$email'";
        $res_query = mysqli_query($conn, $consulta);
        $resultado = mysqli_fetch_array($res_query);

        if ($resultado == '') {
            $_SESSION['mensaje-modal'] = "Las credenciales del administrador son correctas pero el correo electronico a recuperar contraseña no pertenece a ninguna cuenta...";
            $_SESSION['color-modal'] = 'warning';

            $_SESSION['mensaje'] = "Error al recuperar contraseña...";
            $_SESSION['color'] = 'danger';
            $_SESSION['destroy'] = false;
        
            header("location: http://$host/Proyecto-Regularizacion/login.php");
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $resultado['Contraseña'];
            $_SESSION['MostrarPass'] = true;

            header("location: http://$host/Proyecto-Regularizacion/login.php");
        }
    }
} else {
    $_SESSION['mensaje-modal'] = "Ingresa un correo válido...";
    $_SESSION['color-modal'] = 'danger';

    $_SESSION['mensaje'] = "Error al recuperar contraseña...";
    $_SESSION['color'] = 'danger';
    $_SESSION['destroy'] = false;

    header("location: http://$host/Proyecto-Regularizacion/login.php");
}
?>
