<?php
include("db.php");

$host = $_SERVER['HTTP_HOST'];

$password = $_POST['password'];
$email = $_POST['email'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $consulta = "SELECT Id_usuario, Tipo_de_usuario FROM usuarios_regulacion WHERE Contraseña = '$password' AND Email = '$email'";
    $query_result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_array($query_result);
    if ($row == '') {
        $_SESSION['mensaje'] = "El correo y/o la contraseña son incorrectos...";
        $_SESSION['color'] = 'danger';
        $_SESSION['destroy'] = true;
        header("location: http://$host/Proyecto-Regularizacion/login.php");
    } else {
        $id = $row['Id_usuario'];
        $consulta = "SELECT Nombre_de_usuario FROM usuarios_regulacion WHERE Id_usuario = '$id'";
        $query_result = mysqli_query($conn, $consulta);
        $usuario = mysqli_fetch_array($query_result);
        $_SESSION['Usuario'] = $usuario['Nombre_de_usuario'];
        $_SESSION['Tipo'] = $row['Tipo_de_usuario'];

        if($row['Tipo_de_usuario']=='Capturista'){
             header("location: http://$host/Proyecto-Regularizacion/index.php");
        }else{
            header("location: http://$host/Proyecto-Regularizacion/admin.php");
        }
       
    }
} else {
    $_SESSION['mensaje'] = "Ingresa un correo válido...";
    $_SESSION['color'] = 'danger';
    $_SESSION['destroy'] = true;
    
    header("location: http://$host/Proyecto-Regularizacion/login.php");
}
?>
