<?php session_start(); 
      if(isset($_SESSION['Usuario'])){ 
        $host = $_SERVER['HTTP_HOST']; 
        if($_SESSION['Tipo']=='Capturista') header("location: http://$host/Proyecto-Regularizacion/index.php");
        else header("location: http://$host/Proyecto-Regularizacion/admin.php"); 
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/login.css" type="text/css">
    <link rel="shortcut icon" href="src/img/Logo-1-icono.ico">
    <title>Iniciar sesión</title>
</head>

<body>

    <header class="p-3 text-bg-light">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <img alt="" src="src/img/Logo 2.png" class="bi" width="63" height="65" role="img">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>

                <!-- <div class="text-end">
                    <a href="registro.php" class="btn btn-outline-dark me-2 p-2" id="boton1">Registrarse</a>
                </div> -->
            </div>
        </div>
    </header>

    <div class="container">
        <div class="login">
            <div class="header-login">
                <span class="material-icons" style="font-size: 75px;">&#xe853;</span>
                <h3>Iniciar Sesión</h3>
            </div>
            <form action="src/php/user.php" method="post" class="mt-5">
                <div class="mb-3 w-75 m-auto input-group">
                    <span class="material-icons input-group-text">&#xe158;</span>
                    <input type="email" class="form-control" required placeholder="Correo electronico" name="email" required>
                </div>
                <div class="mb-3 w-75 m-auto input-group">
                    <span class="material-icons input-group-text">&#xf042;</span>
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                </div>
                <div class="mb-3">
                    <a href="#Recuperar" data-bs-toggle="modal" data-bs-target="#Recuperar">Recuperar Contraseña</a>
                </div>

                <button type="submit" class="btn btn-primary" id="boton">Iniciar Sesión</button>
            </form>
        </div>
        <div class="row" style="justify-content: center; padding-top: 50px;">
            <div class="col-4">
                <?php if (isset($_SESSION['mensaje'])) { ?>
                    <div style="width:auto; text-align:center;" class="alert alert-<?php print $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['mensaje']; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php if ($_SESSION['destroy'] == true) {
                        session_unset();
                    }
                } ?>
            </div>
        </div>

        <!-- MENSAJE DE RECUPERACION DE CONTRASEÑA -->
        <?php if (isset($_SESSION['MostrarPass'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">RECUPERACIÓN EXITOSA!</h4>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <p>Se ha recuperado con exito la contraseña de la cuenta "<?php echo $_SESSION['email'] ?>"<br> La contraseña es: <?php echo $_SESSION['password'] ?> </p>
            </div>
        <?php session_unset();
        } ?>

        <!-- Modal para recuperar contraseña-->
        <div class="modal fade" id="Recuperar" tabindex="-1" aria-labelledby="Recuperar Contraseña" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperación de Contraseña</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="src/php/recuperar.php">
                        <div class="modal-body">
                            <h5 style="font-weight:bold;"> Ingresa el correo electronico de tu cuenta y las credenciales de un administrador.</h5>
                            <p style="margin-bottom: 2px; padding-top:8px;">Correo cuenta.</p>
                            <div class="input-group">
                                <span class="material-icons input-group-text">&#xe158;</span>
                                <input type="email" class="form-control" required placeholder="Correo electronico" name="email" required>
                            </div>
                            <p class="mt-3 mb-1">Credenciales administrador.</p>
                            <div class="input-group mb-1">
                                <span class="material-icons input-group-text">&#xe158;</span>
                                <input type="email" class="form-control" required placeholder="Correo electronico administrador" name="emailAdmin" required>
                            </div>
                            <div class="input-group mb-3" style="padding-top:5px;">
                                <span class="material-icons input-group-text">&#xf042;</span>
                                <input type="password" class="form-control" required placeholder="Contraseña administrador" name="passAdmin" required>
                            </div>
                            <?php if (isset($_SESSION['mensaje-modal'])) { ?>
                                <div style="margin-top: 10px; width:auto; text-align:center;" class="alert alert-<?php print $_SESSION['color-modal']; ?> alert-dismissible fade show" role="alert">
                                    <strong><?php echo $_SESSION['mensaje-modal']; ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php session_unset();
                            } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>
