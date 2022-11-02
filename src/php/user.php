<?php
include("db.php");

$password = $_POST['password'];
$email = $_POST['email'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $consulta = "SELECT Id_usuario FROM usuarios_regulacion WHERE Contraseña = '$password' AND Email = '$email'";
    $query_result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_array($query_result);
    if ($row == '') {
        $_SESSION['mensaje'] = "El correo y/o la contraseña son incorrectos...";
        $_SESSION['color'] = 'danger';
        header("location: login.php");
    } else {
        $id = $row['Id_usuario'];
        $consulta = "SELECT Nombre_de_usuario FROM usuarios_regulacion WHERE Id_usuario = '$id'";
        $query_result = mysqli_query($conn, $consulta);
        $usuario = mysqli_fetch_array($query_result);
        $_SESSION['Usuario'] = $usuario['Nombre_de_usuario'];
        header("location: index.php");
    }
} else {
    $_SESSION['mensaje'] = "Ingresa un correo válido...";
    $_SESSION['color'] = 'danger';
    header("location: login.php");
}
