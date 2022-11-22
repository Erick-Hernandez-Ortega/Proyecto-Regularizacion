<?php
include("src/php/db.php");
$host = $_SERVER['HTTP_HOST'];
if ($_SESSION['Tipo'] == 'Capturista') header("location: http://$host/Proyecto-Regularizacion/estatus.php");
if (!isset($_SESSION['reloadstatusadmin'])) {
    header('Refresh: 0');
    $_SESSION['reloadstatusadmin'] = 1;
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="src/img/Logo-1-icono.ico">
    <link href="src/css/index.css?v1.1" type="text/css" rel="stylesheet">
    <link href="src/css/estatus.css?v1.4" type="text/css" rel="stylesheet">
    <title>Estatus de documentos</title>
</head>

<body>
    <header class="p-3">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <img alt="" src="src/img/Imagen_2_HD.png" class="bi" width="63" height="65" role="img">
                </a>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 w-25" role="search">
                    <div class="input-group ml">
                        <span class="material-icons input-group-text">&#xe8b6;</span>
                        <input type="search" name="buscar" class="form-control text-bg-light" placeholder="Buscar...">
                    </div>
                </form>
                <div class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </div>


                <div class="d-flex">
                    <span class="material-icons icono">&#xe853;</span>
                    <h6 class="mt-2 usuario"><?php if (isset($_SESSION['Usuario'])) {
                                                    echo $_SESSION['Usuario'];
                                                } else {
                                                    $_SESSION['mensaje'] = "Necesitas iniciar sesión...";
                                                    $_SESSION['color'] = 'danger';
                                                    $_SESSION['destroy'] = true;
                                                    $host = $_SERVER['HTTP_HOST'];
                                                    header("location: http://$host/Proyecto-Regularizacion/login.php");
                                                } ?></h6>
                </div>

                <nav class="navbar border-2" aria-label="Light offcanvas navbar">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" style="border: #f9f9f9 1px solid;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight">
                            <span class="material-icons usuario" style="font-size: 35px;">&#xe5d2;</span>

                        </button>
                        <div class="offcanvas offcanvas-end c-tinto" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title usuario" id="offcanvasNavbarLightLabel">Mi cuenta</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item mb-3">
                                        <a href="registro.php" class="nav-link btn btn-success text-light" id="boton1">Registrar una cuenta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-dark text-light" href="src/php/logout.php">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row align-items-end p-4">
                                <div class="col">
                                    <img alt="" src="src/img/Imagen_2_HD.png" class="bi" width="70" height="65" role="img">
                                </div>
                                <div class="col">
                                    <img alt="" src="src/img/Imagen_1_HD.png" class="bi" width="60" height="65" role="img">
                                </div>
                                <div class="col">
                                    Hola
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
    </header>

    <!-- Submenu -->
    <div class="text-center bs">
        <div class="row w-100">
            <a class="col text-decoration-none link p-2 borde" href="index.php">
                Principal
            </a>
            <a class="col text-decoration-none link p-2 borde" href="" data-bs-toggle="modal" data-bs-target="#modalBusqueda">
                Búsqueda Avanzada
            </a>
            <a class="col text-decoration-none link p-2" href="estatus.php">
                Estatus de documentos
            </a>
        </div>
    </div>

    <div class="contenido mt-4">

        <table class="table table-light table-hover text-center mx-auto" id="tabla-folio">
            <thead>
                <tr class="table-dark">
                    <th scope="col">FOLIO</th>
                    <th scope="col">Proceso 1</th>
                    <th scope="col">Proceso 2</th>
                    <th scope="col">Proceso 3</th>
                    <th scope="col">Proceso 4</th>
                    <th scope="col">Proceso 5</th>
                    <th scope="col">Proceso 6</th>
                    <th scope="col">Proceso 7</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 0;
                $sql = "SELECT folio FROM solicitud_de_regularizacion WHERE archivar = false";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="folio">
                        <th scope="row"><?= $row['folio'] ?></th>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p1' . $row['folio']] == 9) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p1' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "a" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p2' . $row['folio']] == 5) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p2' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "b" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p3' . $row['folio']] == 5) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p3' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "c" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p4' . $row['folio']] == 3) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p4' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "d" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p5' . $row['folio']] == 8) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p5' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "e" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p6' . $row['folio']] == 1) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "f" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge text-bg-<?php if ($_SESSION['p7' . $row['folio']] == 9) {
                                                        echo "success";
                                                        $comentario = 'Completado';
                                                    } else if ($_SESSION['p7' . $row['folio']] == 0) {
                                                        echo "danger";
                                                        $comentario = 'No Completado';
                                                    } else {
                                                        echo "warning";
                                                        $comentario = 'Incompleto';
                                                    } ?> text-decoration-none" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="[id='<?= "g" . $row['folio'] ?>']">
                                <?= $comentario ?>
                            </a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Proceso 1-->
    <?php $sql = "SELECT * FROM solicitud_de_regularizacion";
    $query = mysqli_query($conn, $sql);
    while ($p1 = mysqli_fetch_array($query)) { ?>
        <div class="modal fade" id="<?= "a" . $p1['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p1['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 1: Solicitud de regularización</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Solicitud</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['solicidud_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Escritutas</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['escritura_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Identificación</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['identificacion_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Historial Catastral</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['historial_catastral_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $d = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $d = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Resolución idicial</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['resolucion_idicial_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Certificación de hechos</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['certificacion_de_hechos_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $f = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $f = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Foto aerea</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['foto_aerea_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $g = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $g = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['oficio_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $h = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $h = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio de regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p1['oficio_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $i = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $i = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p1' . $p1['folio']] = $a + $b + $c + $d + $e + $f + $g + $h + $i;
    } ?>
    <!-- Modal Proceso 2 -->
    <?php $sql2 = "SELECT * FROM presentacion_de_documentos_a_la_comur";
    $query2 = mysqli_query($conn, $sql2);
    while ($p2 = mysqli_fetch_array($query2)) { ?>
        <div class="modal fade" id="<?= "b" . $p2['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p2['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 2: Presentación de documento a la
                                    COMUR</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Oficio</td>
                                    <td>
                                        <span class="material-icons <?php if ($p2['oficio_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Solicitud de la regularización </td>
                                    <td>
                                        <span class="material-icons <?php if ($p2['solicitud_de_regularizacion_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Estudio de análisis</td>
                                    <td>
                                        <span class="material-icons <?php if ($p2['estudio_de_analisis_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta de comur</td>
                                    <td>
                                        <span class="material-icons <?php if ($p2['acta_comur_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $d = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $d = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio de regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p2['oficio_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p2' . $p2['folio']] = $a + $b + $c + $d + $e;
    } ?>
    <!-- Modal proceso 3 -->
    <?php $sql3 = "SELECT * FROM segunda_presentacion_de_documentos_a_la_comur";
    $query3 = mysqli_query($conn, $sql3);
    while ($p3 = mysqli_fetch_array($query3)) { ?>
        <div class="modal fade" id="<?= "c" . $p3['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p3['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 3: Segunda Presentación de documento a
                                    la COMUR</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Oficio</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['oficio_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Estudio de opinión</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['estudio_opinion_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta de COMUR (Proceso 2)</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['acta_de_comur_proceso_2_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta de COMUR 2</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['acta_comur_2_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $d = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $d = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta Regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['oficio_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio de regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p3['oficio_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p3' . $p3['folio']] = $a + $b + $c + $d + $e;
    } ?>
    <!-- Modal Proceso 4 -->
    <?php $sql4 = "SELECT * FROM solicitud_por_oficio_a_la_prodeur";
    $query4 = mysqli_query($conn, $sql4);
    while ($p4 = mysqli_fetch_array($query4)) { ?>
        <div class="modal fade" id="<?= "d" . $p4['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p4['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 4: Solicitud por oficio a la PRODEUR</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Oficio</td>
                                    <td>
                                        <span class="material-icons <?php if ($p4['oficio_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Dictamen</td>
                                    <td>
                                        <span class="material-icons <?php if ($p4['dictamen_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio Regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p4['oficio_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p4' . $p4['folio']] = $a + $b + $c;
    } ?>
    <!-- Modal Proceso 5 -->
    <?php $sql5 = "SELECT * FROM presentacion_a_la_comur";
    $query5 = mysqli_query($conn, $sql5);
    while ($p5 = mysqli_fetch_array($query5)) { ?>
        <div class="modal fade" id="<?= "e" . $p5['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p5['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 5: Presentación a la COMUR</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Oficio</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['oficio_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Dictamen PRODEUR</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['dictamen_prodeur_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta de COMUR 1</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['acta_de_comur_1_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Acta de COMUR 2</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['acta_de_comur_2_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $d = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $d = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Publicación</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['publicacion_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Estudio análisis y resolución del
                                        expediente</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['estudio_analisis_y_resolucion_del_expediente_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $f = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $f = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Estudio de opinión</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['estudio_de_opinion_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $g = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $g = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Oficio regreso</td>
                                    <td>
                                        <span class="material-icons <?php if ($p5['oficion_regreso_estatus'] == 'Aceptado') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $h = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $h = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p5' . $p5['folio']] = $a + $b + $c + $d + $e + $f + $g + $h;
    } ?>
    <!-- Modal Proceso 6 -->
    <?php $sql6 = "SELECT * FROM proyecto_definitivo";
    $query6 = mysqli_query($conn, $sql6);
    while ($p6 = mysqli_fetch_array($query6)) { ?>
        <div class="modal fade" id="<?= "f" . $p6['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p6['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 6: Proyecto definitivo</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Proyecto Definitivo</td>
                                    <td>
                                        <span class="material-icons <?php if ($p6['proyecto_definitivo_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p6' . $p6['folio']] = $a;
    } ?>
    <!-- Modal Proceso 7 -->
    <?php $sql7 = "SELECT * FROM convenio_de_regularizacion";
    $query7 = mysqli_query($conn, $sql7);
    while ($p7 = mysqli_fetch_array($query7)) { ?>
        <div class="modal fade" id="<?= "g" . $p7['folio'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Folio: <?= $p7['folio'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <h5 class="text-center mb-3">Proceso 7: Convenio de regularización</h5>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Oficio de Catastro</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['oficio_de_castastro_estatus'] == true) {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $a = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $a = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Convenio de regularización (Solo
                                        archivo)</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['convenio_de_regularizacion'] == null) {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $b = 0;
                                                                    } else {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $b = 1;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Presidente</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_presidente_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $c = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $c = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Sindico</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_sindico_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $d = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $d = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Secretaria General</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_secretaria_general_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $e = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $e = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Tesorero</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_tesorero_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $f = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $f = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Presidente de Comite o Propietario</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_presidente_de_comite_o_propietario_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $g = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $g = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Secretario Técnico</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_secretario_tecnico_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $h = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $h = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Firma Procurador de desarrollo urbano</td>
                                    <td>
                                        <span class="material-icons <?php if ($p7['firma_procurador_de_desarrollo_urbano_estatus'] == 'Listo') {
                                                                        echo 'verde';
                                                                        $icon = '&#xe2e6;';
                                                                        $i = 1;
                                                                    } else {
                                                                        echo 'rojo';
                                                                        $icon = '&#xe5c9;';
                                                                        $i = 0;
                                                                    } ?>"><?= $icon; ?></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['p7' . $p7['folio']] = $a + $b + $c + $d + $e + $f + $g + $h + $i;
    } ?>
    <!-- Modal busqueda avanzada -->
    <div class="modal fade" id="modalBusqueda" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Búsqueda Avanzada</h1>
                    <span class="material-icons mx-1">&#xe8b6;</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="busqueda.php" method="POST">
                        <label class="mb-1">Por folio</label>
                        <div class="input-group mb-3">
                            <span class="material-icons input-group-text">&#xe2c7;</span>
                            <input type="text" class="form-control" placeholder="Ingrese Folio..." id="folio" name="folio">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn" style="background-color: #852120; color: white;">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <br>
    <br>

    <!-- FOOTER -->
    <footer class="w-100 py-4 flex-shrink-0 mt-4">
        <div class="container py-3">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6">
                    <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                        <img alt="" src="src/img/Imagen_1_HD.png" class="bi" width="66" height="80" role="img">
                    </a>
                    <p class="usuario">Ayuntamiento de Tonalá</p>
                    <p class="usuario">&copy; Copyrights. Todos los derechos a los alumnos del CUT 🥵.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="usuario mb-3">Dirección</h5>
                    <p class="small usuario">Calle Pino Suarez NO.32, Tonalá Centro C.P. 45400, Tonalá, Jalisco.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <!-- aca algo chido -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="usuario mb-3">Contacto</h5>
                    <ul class="list-unstyled">
                        <li><a href="tel:+523335866000" class="link-light">Tel. 33-35-86-60-00</a></li>
                        <li><a href="https://www.tonala.gob.mx" target="_blank" class="link-light">www.tonalá.gob.mx</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>