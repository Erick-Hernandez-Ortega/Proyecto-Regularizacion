<?php

include("db.php");
$host = $_SERVER['HTTP_HOST'];

$usuario = $_POST['User'];
$password = $_POST['Contraseña'];
$tipousuario = $_POST['Rol'];
$nombre = $_POST['Nombre'];
$Apaterno = $_POST['ApellidoPat'];
$AMaterno = $_POST['ApellidoMat'];
$dependencia = $_POST['Dependencia'];
$email = $_POST['Correo'];
$sexo = $_POST['Sexo'];
$nombramiento = $_POST['Nombramiento'];
$emailAdmin = $_POST['emailAdmin'];
$passAdmin = $_POST['passAdmin'];
$Confirmacion = $_POST['ConfirmPass'];

if (filter_var($emailAdmin, FILTER_VALIDATE_EMAIL) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $consulta = "SELECT Tipo_de_usuario FROM usuarios_regulacion WHERE Email = '$emailAdmin' AND Contraseña = '$passAdmin'";
    $res_query = mysqli_query($conn, $consulta);
    $resultado = mysqli_fetch_array($res_query);

    if ($resultado['Tipo_de_usuario'] != 'Administrador' && $resultado['Tipo_de_usuario'] != 'Super administrador') {
        $_SESSION['mensaje-modal'] = "Las credenciales del administrador son incorrectas!";
        $_SESSION['color-modal'] = 'danger';

        $_SESSION['mensajeR'] = "Error al registrar usuario...";
        $_SESSION['colorR'] = 'danger';
        $_SESSION['destroyR'] = false;

        header("location: http://$host/Proyecto-Regularizacion/registro.php");
    } else {
        if ($tipousuario != 'Rol del nuevo usuario' && $sexo != '-Seleccione uno-') {
            $consulta = "SELECT Id_usuario FROM usuarios_regulacion WHERE Email = '$email'";
            $consulta2 = "SELECT Id_usuario FROM usuarios_regulacion WHERE Nombre_de_usuario = '$usuario'";
            $res1 = mysqli_query($conn, $consulta);
            $res2 = mysqli_query($conn, $consulta2);
            $resultado1 = mysqli_fetch_array($res1);
            $resultado2 = mysqli_fetch_array($res2);

            if ($resultado1 == '' && $resultado2 == '') {
                if ($password != $Confirmacion) {
                    $_SESSION['mensajeR'] = "La contraseña y su confirmación no son iguales!";
                    $_SESSION['colorR'] = 'warning';
                    $_SESSION['destroyR'] = true;

                    header("location: http://$host/Proyecto-Regularizacion/registro.php");
                }
            } else {
                $_SESSION['mensajeR'] = "El correo o nombre de usuario ya están asociados a una cuenta!";
                $_SESSION['colorR'] = 'warning';
                $_SESSION['destroyR'] = true;

                header("location: http://$host/Proyecto-Regularizacion/registro.php");
            }
        } else {
            $_SESSION['mensajeR'] = "Rellena todos los campos correctamente.";
            $_SESSION['colorR'] = 'danger';
            $_SESSION['destroyR'] = true;

            header("location: http://$host/Proyecto-Regularizacion/registro.php");
        }
    }
} else {
    $_SESSION['mensajeR'] = "Alguno de los 2 correos no es válido...";
    $_SESSION['colorR'] = 'danger';
    $_SESSION['destroyR'] = true;
    header("location: http://$host/Proyecto-Regularizacion/registro.php");
}

$registro = "INSERT INTO usuarios_regulacion(Nombre_de_usuario, Contraseña, Tipo_de_usuario, Nombre, Apellido_paterno, Apellido_materno, Dependencia, Email, Sexo, Nombramiento) VALUES ('$usuario', '$password', '$tipousuario', '$nombre', '$Apaterno', '$AMaterno', '$dependencia', '$email', '$sexo', '$nombramiento')";

$rs = mysqli_query($conn, $registro);
if ($rs) {
    $_SESSION['mensaje'] = "Registro exitoso! Ahora inicia sesión.";
    $_SESSION['color'] = 'success';
    $_SESSION['destroy'] = true;
    echo "<script>alert('Registro exitoso!');window.location = 'http://$host/Proyecto-Regularizacion/login.php'</script>";
} else {
    echo "<script>alert('Ocurrió un error, vuelve a intentarlo...');window.location = '/registro.html'</script>";
}
