<?php
session_start();
$host = $_SERVER['HTTP_HOST'];
if (isset($_SESSION['Usuario'])) {
    if ($_SESSION['Tipo'] == 'Capturista') header("location: http://$host/Proyecto-Regularizacion/index.php");
    else header("location: http://$host/Proyecto-Regularizacion/admin.php");
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/registro.css" type="text/css">
    <link rel="shortcut icon" href="src/img/Logo-1-icono.ico">
    <title>Registro</title>
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

                <div class="text-end">
                    <a href="login.php" class="btn btn-outline-dark me-2" id="boton1">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="registro mt-4">
            <h4 class="text-center">Registro</h4>
            <div class="formulario mt-4">

                <form action="src/php/register.php" method="POST">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" maxlength="20" name="Nombre" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label for="">Nombre de usuario</label>
                                <input type="text" class="form-control" placeholder="Nombre de Usuario" maxlength="20" name="User" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="">Apellido Paterno</label>
                            <input type="text" class="form-control" placeholder="Apellido Paterno" maxlength="25" name="ApellidoPat" required>
                        </div>
                        <div class="col">
                            <label for="">Apellido Materno</label>
                            <input type="text" class="form-control" placeholder="Apellido Materno" maxlength="25" name="ApellidoMat" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="">Correo Electronico</label>
                            <input type="email" class="form-control" placeholder="Correo Electronico" maxlength="30" name="Correo" required>
                        </div>
                        <div class="col">
                            <label for="">Sexo</label>
                            <select class="form-control" name="Sexo" required>
                                <option selected>-Seleccione uno-</option>
                                <option>Femenino</option>
                                <option>Masculino</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="">Dependencia</label>
                            <input type="text" class="form-control" placeholder="Dependencia" maxlength="50" name="Dependencia" required>
                        </div>
                        <div class="col">
                            <label for="">Nombramiento</label>
                            <input type="text" class="form-control" placeholder="Nombramiento" maxlength="20" name="Nombramiento" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label for="">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Contraseña" maxlength="15" name="Contraseña" required>
                        </div>
                        <div class="col">
                            <label for="">Confirme Contraseña</label>
                            <input type="password" class="form-control" placeholder="Confirme Contraseña" name="ConfirmPass" maxlength="15" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary w-75" id="boton" data-bs-toggle="modal" data-bs-target="#Registrar">Registrar</button>
                    </div>

                    <div class="row" style="justify-content: center; padding-top: 80px;">
                        <div class="col-4">
                            <?php if (isset($_SESSION['mensajeR'])) { ?>
                                <div style="width: auto; text-align:center;" class="alert alert-<?php print $_SESSION['colorR']; ?> alert-dismissible fade show" role="alert">
                                    <strong><?php echo $_SESSION['mensajeR']; ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php if ($_SESSION['destroyR'] == true) {
                                    session_unset();
                                }
                            } ?>
                        </div>
                    </div>
                    <!-- Modal para registrar-->
                    <div class="modal fade" id="Registrar" tabindex="-1" aria-labelledby="Recuperar Contraseña" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresa las credenciales de un administrador y elige el rol del nuevo usuario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <span class="material-icons input-group-text">&#xea67;</span>
                                        <select class="form-control" name="Rol" required>
                                            <option selected>Rol del nuevo usuario</option>
                                            <option>Capturista</option>
                                            <option>Administrador</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="material-icons input-group-text">&#xe158;</span>
                                        <input type="email" class="form-control" required placeholder="Correo electronico administrador" name="emailAdmin" required>
                                    </div>
                                    <div class="input-group mb-3">
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
                                    <button type="submit" class="btn" style="background-color: #852120; color: white;">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>