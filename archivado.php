<?php 
include("src/php/db.php");
$host = $_SERVER['HTTP_HOST'];
if ($_SESSION['Tipo'] == 'Capturista') header("location: http://$host/Proyecto-Regularizacion/index.php"); 
if(!isset($_SESSION['reloadarchivado'])){header('Refresh: 0'); $_SESSION['reloadarchivado'] = 1;}?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="src/css/index.css?v1.2" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" href="src/img/Logo-1-icono.ico">
    <title>Regularización</title>
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


    <div class="text-center bs">
        <div class="row w-100">
            <a class="col text-decoration-none link p-2 borde" href="admin.php">
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

    <!-- <div class="agregar-folio mt-3">
        <a href="admin.php" class="btn btn-primary">Página principal</a>
    </div> -->
    <div class="text-center mt-2 bg-dark bg-gradient text-white" id="tituloArchivado">
        <p class="h1" ><strong>Archivados</strong></p>
    </div>
    <div class="divTabla mt-3">
        <table class="table table-hover text-center caption-top" id="tablaCentral">
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
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!isset($_GET['buscar'])){
                    $_GET['buscar'] = "";
                    $buscar = $_GET['buscar'];
                }
                $buscar = $_GET['buscar'];
                $sql = "SELECT folio FROM solicitud_de_regularizacion WHERE archivar != false AND folio LIKE '%".$buscar."%'";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($query)) { ?>
                <tr class="table-light">
                <th scope="row"><?= $row['folio'] ?></th>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i1'.$row['folio']]==10){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i1'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="a".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i2'.$row['folio']]==6){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i2'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="b".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i3'.$row['folio']]==6){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i3'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="c".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i4'.$row['folio']]==4){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i4'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="d".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i5'.$row['folio']]==9){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i5'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="e".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i6'.$row['folio']]==1){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else{
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="f".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-<?php if($_SESSION['i7'.$row['folio']]==16){ 
                                echo "success"; $comentario = '&#xe876;'; $estado = 'Completado';
                                }else if($_SESSION['i7'.$row['folio']]==0){
                                    echo "danger"; $comentario = '&#xe89c;'; $estado ='Sin empezar';
                                }else{
                                    echo "warning"; $comentario = '&#xf1c2;'; $estado = 'Incompleto';
                                }?> px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?=$estado?>">
                                <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?="g".$row['folio'] ?>']"><?=$comentario?></span>
                            </button>
                        </td>
                    <td>
                        <button type="button" class="btn btn-success px-1" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Desarchivar">
                            <span class="material-icons d-flex" data-bs-toggle="modal" data-bs-target="[id='<?=$row['folio']?>']">&#xe8fb;</span>
                        </button>
                    </td>
                </tr>
        <?php }?>
            </tbody>
        </table>
    </div>

    <!-- Modal Folio -->
    <div class="modal fade" id="modalFolio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Folio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <div class="col-auto">
                            <label for="inputPassword6" class="col-form-label fw-bold">Número de folio</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn" style="background-color: #852120; color: white;">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal proceso 1-->
    <?php
    $sql2 = "SELECT * FROM solicitud_de_regularizacion";
    $query2 = mysqli_query($conn, $sql2);
    while ($mod = mysqli_fetch_array($query2)) { ?>
        <div class="modal fade" id="<?="a".$mod['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 1: Solicitud de regularización</h1>
                        <a href="src/docs/Solicitud de regularizacion.pdf" target="_blank" download="Solicitud de regularización.pdf" class="text-decoration-none btn btn-secondary mt-1 mx-3 mb-1">Generar solicitud de
                            regularización</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="src/php/proceso1.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="fw-bold mb-3">Numero de Folio: <?= $mod['folio']; ?></h6>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Solicitud</label>
                                <span class="material-icons position-absolute <?php if ($mod['solicidud_estatus'] == true) {echo 'verde';$icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;}?>"><?= $icon; ?></span>
                                <input class="form-control" name="Solicitud" type="file" id="formFile" <?php //if($mod['solicidud_estatus']==true) echo 'disabled';?>>
                            </div>
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Escritutas</label>
                                <span class="material-icons position-absolute <?php if ($mod['escritura_estatus'] == true) { echo 'verde';$icon = '&#xe2e6;'; $b=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="Escrituras" type="file" id="formFile">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Identificación</label>
                                <span class="material-icons position-absolute <?php if ($mod['identificacion_estatus'] == true) {echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else {echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="Identificacion" type="file" id="formFile">
                            </div>
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Historial Catastral</label>
                                <span class="material-icons position-absolute <?php if ($mod['historial_catastral_estatus'] == true) {echo 'verde'; $icon = '&#xe2e6;'; $d=1;} else {echo 'rojo'; $icon = '&#xe5c9;'; $d=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="HistorialCat" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Resolución idicial</label>
                                <span class="material-icons position-absolute <?php if ($mod['resolucion_idicial_estatus'] == true) {echo 'verde'; $icon = '&#xe2e6;'; $e=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $e=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="ResolucionId" type="file" id="formFile">
                            </div>
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Certificación de hechos</label>
                                <span class="material-icons position-absolute <?php if ($mod['certificacion_de_hechos_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $f=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $f=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="CertificacionH" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Foto aerea</label>
                                <span class="material-icons position-absolute <?php if ($mod['foto_aerea_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $g=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $g=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="FotoAerea" type="file" id="formFile">
                            </div>
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Oficio</label>
                                <span class="material-icons position-absolute <?php if ($mod['oficio_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $h=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $h=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="Oficio" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label fw-bold">Oficio Regreso</label>
                                <span class="material-icons position-absolute <?php if ($mod['oficio_regreso']!=null) { echo 'verde'; $icon = '&#xe2e6;'; $i=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $i=0;} ?>"><?= $icon; ?></span>
                                <input class="form-control" name="OficioRegreso" type="file" id="formFile">
                            </div>
                            <div class="col">
                                <label for="" class="form-label fw-bold">Estado de Oficio de Regreso</label>
                                <select class="form-control" name="estado-ofici o" required>
                                    <?php if($mod['oficio_regreso_estatus']=='Aceptado'){
                                        $sel = 'selected'; $s=''; $n=''; $r=''; $j = 1;
                                        }else if($mod['oficio_regreso_estatus']=='En Revision'){
                                            $r = 'selected'; $s=''; $n=''; $sel=''; $j = 0;
                                        }else if($mod['oficio_regreso_estatus']=='No Subido'){
                                            $n = 'selected'; $sel=''; $s=''; $r=''; $j = 0; 
                                        }else{$s = 'selected'; $r=''; $n=''; $sel=''; $j=0;}?>
                                    <option <?=$s?>>-Seleccione uno-</option>
                                    <option <?=$sel?> value="Aceptado">Aceptado ✅</option>
                                    <option <?=$n?> value="No Subido">No Subido ❌</option>
                                    <option <?=$r?> value="En Revision">En Revision ⌛️</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar documentos</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    <?php $_SESSION['i1'.$mod['folio']] = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j;} ?>
    <!-- Modal proceso 2 Completado -->
    <?php $sql3 = "SELECT * FROM presentacion_de_documentos_a_la_comur";
          $query3 = mysqli_query($conn, $sql3);
          while($p2 = mysqli_fetch_array($query3)){?>
    <div class="modal fade" id="<?="b".$p2['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 2: Presentación de documento a la
                        COMUR
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso2.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p2['folio']?>">
                            </div>
                        </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio</label>
                            <span class="material-icons position-absolute <?php if ($p2['oficio_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Oficio" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Solicitud de la regularización</label>
                            <span class="material-icons position-absolute <?php if ($p2['solicitud_de_regularizacion_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $b=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Solicitud" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Estudio de análisis</label>
                            <span class="material-icons position-absolute <?php if ($p2['estudio_de_analisis_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Estudio" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Acta de comur</label>
                            <span class="material-icons position-absolute <?php if ($mod['acta_comur_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $d=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $d=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Acta" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio de regreso</label>
                            <span class="material-icons position-absolute <?php if ($p2['oficio_regreso'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $e=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $e=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="OficioRegreso" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Oficio de Regreso</label>
                            <select class="form-control" name="estado-oficio" required>
                            <?php if($p2['oficio_regreso_estatus']=='Aceptado'){
                                        $sel = 'selected'; $s=''; $n=''; $r=''; $f=1;
                                        }else if($p2['oficio_regreso_estatus']=='En Revision'){
                                            $r = 'selected'; $s=''; $n=''; $sel=''; $f=0;
                                        }else if($p2['oficio_regreso_estatus']=='No Subido'){
                                            $n = 'selected'; $sel=''; $s=''; $r=''; $f=0;
                                        }else{$s = 'selected'; $r=''; $n=''; $sel=''; $f=0;}?>
                                    <option <?=$s?>>-Seleccione uno-</option>
                                    <option <?=$sel?> value="Aceptado">Aceptado ✅</option>
                                    <option <?=$n?> value="No Subido">No Subido ❌</option>
                                    <option <?=$e?> value="En Revision">En Revision ⌛️</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i2'.$p2['folio']] = $a+$b+$c+$d+$e+$f;}?>
    <!-- Modal proceso 3 -->
    <?php $sql4 = "SELECT * FROM segunda_presentacion_de_documentos_a_la_comur";
          $query4 = mysqli_query($conn, $sql4);
          while($p3 = mysqli_fetch_array($query4)){?>
    <div class="modal fade" id="<?="c".$p3['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 3: Segunda Presentación de documento a
                        la COMUR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso3.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p3['folio']?>">
                            </div>
                        </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio</label>
                            <span class="material-icons position-absolute <?php if ($p3['oficio_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Oficio" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Estudio de opinión</label>
                            <span class="material-icons position-absolute <?php if ($p3['estudio_opinion_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $b=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Estudio" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Acta de COMUR (Proceso 2)</label>
                            <span class="material-icons position-absolute <?php if ($p3['acta_de_comur_proceso_2_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Acta" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Acta de COMUR 2</label>
                            <span class="material-icons position-absolute <?php if ($p3['acta_comur_2_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $d=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $d=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="ActaCom" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio Regreso</label>
                            <span class="material-icons position-absolute <?php if ($p3['oficio_regreso'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $e=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $e=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="OficioRegreso" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Oficio de Regreso</label>
                            <select class="form-control" name="estado-oficio" required>
                            <?php if($p3['oficio_regreso_estatus']=='Aceptado'){
                                        $sel = 'selected'; $s=''; $n=''; $r=''; $f=1;
                                        }else if($p3['oficio_regreso_estatus']=='En Revision'){
                                            $r = 'selected'; $s=''; $n=''; $sel=''; $f=0;
                                        }else if($p3['oficio_regreso_estatus']=='No Subido'){
                                            $n = 'selected'; $sel=''; $s=''; $r=''; $f=0;
                                        }else{$s = 'selected'; $r=''; $n=''; $sel=''; $f=0;}?>
                                    <option <?=$s?>>-Seleccione uno-</option>
                                    <option <?=$sel?> value="Aceptado">Aceptado ✅</option>
                                    <option <?=$n?> value="No Subido">No Subido ❌</option>
                                    <option <?=$r?> value="En Revision">En Revision ⌛️</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i3'.$p3['folio']] = $a+$b+$c+$d+$e+$f;}?>
    <!-- Modal proceso 4 -->
    <?php $sql5 = "SELECT * FROM solicitud_por_oficio_a_la_prodeur";
          $query5 = mysqli_query($conn, $sql5);
          while($p4 = mysqli_fetch_array($query5)){?>
    <div class="modal fade" id="<?="d".$p4['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 4: Solicitud por oficio a la PRODEUR
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso4.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p4['folio']?>">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Dictamen</label>
                            <span class="material-icons position-absolute <?php if ($p4['dictamen_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Dictamen" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio</label>
                            <span class="material-icons position-absolute <?php if ($p4['oficio_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $b=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Oficio" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio Regreso</label>
                            <span class="material-icons position-absolute <?php if ($p4['oficio_regreso'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="OficioRegreso" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Oficio de Regreso</label>
                            <select class="form-control" name="estado-oficio" required>
                            <?php if($p4['oficio_regreso_estatus']=='Aceptado'){
                                        $sel = 'selected'; $s=''; $n=''; $e=''; $d=1;
                                        }else if($p4['oficio_regreso_estatus']=='En Revision'){
                                            $e = 'selected'; $s=''; $n=''; $sel=''; $d=0;
                                        }else if($p4['oficio_regreso_estatus']=='No Subido'){
                                            $n = 'selected'; $sel=''; $s=''; $e=''; $d=0;
                                        }else{$s = 'selected'; $e=''; $n=''; $sel=''; $d=0;}?>
                                    <option <?=$s?>>-Seleccione uno-</option>
                                    <option <?=$sel?> value="Aceptado">Aceptado ✅</option>
                                    <option <?=$n?> value="No Subido">No Subido ❌</option>
                                    <option <?=$e?> value="En Revision">En Revision ⌛️</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i4'.$p4['folio']] = $a+$b+$c+$d;}?>
    <!-- Modal proceso 5 -->
    <?php $sql6 = "SELECT * FROM presentacion_a_la_comur";
          $query6 = mysqli_query($conn, $sql6);
          while($p5 = mysqli_fetch_array($query6)){?>
    <div class="modal fade" id="<?="e".$p5['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 5: Presentación a la COMUR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso5.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p5['folio']?>">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio</label>
                            <span class="material-icons position-absolute <?php if ($p5['oficio_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Oficio" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Dictamen PRODEUR</label>
                            <span class="material-icons position-absolute <?php if ($p5['dictamen_prodeur_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $b=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="DictamenPRODEUR" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Acta de COMUR 1</label>
                            <span class="material-icons position-absolute <?php if ($p5['acta_de_comur_1_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Comur1" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Acta de COMUR 2</label>
                            <span class="material-icons position-absolute <?php if ($p5['acta_de_comur_2_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $d=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $d=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Comur2" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Publicación</label>
                            <span class="material-icons position-absolute <?php if ($p5['publicacion_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $e=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $e=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Publicacion" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Estudio análisis y resolución del
                                expediente</label>
                                <span class="material-icons position-absolute <?php if ($p5['estudio_analisis_y_resolucion_del_expediente_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $f=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $f=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="EstudioAnalisis" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Estudio de opinión</label>
                            <span class="material-icons position-absolute <?php if ($p5['estudio_de_opinion_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $g=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $g=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="EstudioOpinion" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio regreso</label>
                            <span class="material-icons position-absolute <?php if ($p5['oficion_regreso'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $h=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $h=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="OficioRegreso" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Oficio de Regreso</label>
                            <select class="form-control" name="estado-oficio" required>
                            <?php if($p5['oficion_regreso_estatus']=='Aceptado'){
                                        $sel = 'selected'; $s=''; $n=''; $r=''; $i=1;
                                        }else if($p5['oficion_regreso_estatus']=='En Revision'){
                                            $r = 'selected'; $s=''; $n=''; $sel=''; $i=0;
                                        }else if($p5['oficion_regreso_estatus']=='No Subido'){
                                            $n = 'selected'; $sel=''; $s=''; $r=''; $i=0;
                                        }else{$s = 'selected'; $r=''; $n=''; $sel=''; $i=0;}?>
                                    <option <?=$s?>>-Seleccione uno-</option>
                                    <option <?=$sel?> value="Aceptado">Aceptado ✅</option>
                                    <option <?=$n?> value="No Subido">No Subido ❌</option>
                                    <option <?=$r?> value="En Revision">En Revision ⌛️</option>
                            </select>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i5'.$p5['folio']] = $a+$b+$c+$d+$e+$f+$g+$h+$i;}?>
    <!-- Modal proceso 6 -->
    <?php $sql7 = "SELECT * FROM proyecto_definitivo";
          $query7 = mysqli_query($conn, $sql7);
          while($p6 = mysqli_fetch_array($query7)){?>
    <div class="modal fade" id="<?="f".$p6['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 6: Proyecto definitivo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso6.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p6['folio']?>">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Proyecto Definitivo</label>
                            <span class="material-icons position-absolute <?php if ($p6['proyecto_definitivo_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Definitivo" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="subtmit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i6'.$p6['folio']] = $a;}?>
    <!-- Modal proceso 7  -->
    <?php $sql8 = "SELECT * FROM convenio_de_regularizacion";
          $query8 = mysqli_query($conn, $sql8);
          while($p7 = mysqli_fetch_array($query8)){?>
    <div class="modal fade" id="<?="g".$p7['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Proceso 7: Convenio de regularización</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="src/php/proceso7.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Número de Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$p7['folio']?>">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Oficio de Catastro </label>
                            <span class="material-icons position-absolute <?php if ($p7['oficio_de_castastro_estatus'] == true) { echo 'verde'; $icon = '&#xe2e6;'; $a=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $a=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Oficio" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Convenio de regularización (Solo
                                archivo)</label>
                                <span class="material-icons position-absolute <?php if ($p7['convenio_de_regularizacion'] == null) { echo 'rojo'; $icon = '&#xe5c9;'; $b=0;} else { echo 'verde'; $icon = '&#xe2e6;'; $b=1;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Convenio" type="file" id="formFile">
                        </div>
                    </div>
                    <h5 class="text-center fw-bold text-decoration-underline mb-3">Firmas Con Oficio</h5>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Presidente</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_presidente'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $c=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $c=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Presidente" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Presidente</label>
                            <select class="form-control" name="estado-presidente" required>
                            <?php if($p7['firma_presidente_estatus']=='Listo'){
                                        $fp = 'selected'; $fps=''; $fpn=''; $fpe=''; $d=1;
                                        }else if($p7['firma_presidente_estatus']=='En Proceso'){
                                            $fpe = 'selected'; $fps=''; $fpn=''; $fp=''; $d=0;
                                        }else if($p7['firma_presidente_estatus']=='Faltante'){
                                            $fpn = 'selected'; $fp=''; $fps=''; $fpe=''; $d=0;
                                        }else{$fps = 'selected'; $fpe=''; $fpn=''; $fp=''; $d=0;}?>
                                    <option <?=$fps?>>-Seleccione uno-</option>
                                    <option <?=$fp?> value="Listo">Listo ✅</option>
                                    <option <?=$fpn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fpe?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Sindico</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_sindico'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $e=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $e=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Sindico" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Sindico</label>
                            <select class="form-control" name="estado-sindico" required>
                            <?php if($p7['firma_sindico_estatus']=='Listo'){
                                        $fs = 'selected'; $fss=''; $fsn=''; $fse=''; $f=1;
                                        }else if($p7['firma_sindico_estatus']=='En Proceso'){
                                            $fse = 'selected'; $fss=''; $fsn=''; $fs=''; $f=0;
                                        }else if($p7['firma_sindico_estatus']=='Faltante'){
                                            $fsn = 'selected'; $fs=''; $fss=''; $fse=''; $f=0;
                                        }else{$fss = 'selected'; $fse=''; $fsn=''; $fs=''; $f=0;}?>
                                    <option <?=$fss?>>-Seleccione uno-</option>
                                    <option <?=$fs?> value="Listo">Listo ✅</option>
                                    <option <?=$fsn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fse?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Secretaria General</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_secretaria_general'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $g=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $g=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Secretaria" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Secretaria General</label>
                            <select class="form-control" name="estado-secretaria" required>
                            <?php if($p7['firma_secretaria_general_estatus']=='Listo'){
                                        $fsg = 'selected'; $fsgs=''; $fsgn=''; $fsge=''; $h=1;
                                        }else if($p7['firma_secretaria_general_estatus']=='En Proceso'){
                                            $fsge = 'selected'; $fsgs=''; $fsgn=''; $fsg=''; $h=0;
                                        }else if($p7['firma_secretaria_general_estatus']=='Faltante'){
                                            $fsgn = 'selected'; $fsg=''; $fsgs=''; $fsge=''; $h=0;
                                        }else{$fsgs = 'selected'; $fsge=''; $fsgn=''; $fsg=''; $h=0;}?>
                                    <option <?=$fsgs?>>-Seleccione uno-</option>
                                    <option <?=$fsg?> value="Listo">Listo ✅</option>
                                    <option <?=$fsgn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fsge?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Tesorero</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_tesorero'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $i=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $i=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Tesorero" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Tesorero</label>
                            <select class="form-control" name="estado-tesorero" required>
                            <?php if($p7['firma_tesorero_estatus']=='Listo'){
                                        $ft = 'selected'; $fts=''; $ftn=''; $fte=''; $j=1;
                                        }else if($p7['firma_tesorero_estatus']=='En Proceso'){
                                            $fte = 'selected'; $fts=''; $ftn=''; $ft=''; $j=0;
                                        }else if($p7['firma_tesorero_estatus']=='Faltante'){
                                            $ftn = 'selected'; $ft=''; $fts=''; $fte=''; $j=0;
                                        }else{$fts = 'selected'; $fte=''; $ftn=''; $ft=''; $j=0;}?>
                                    <option <?=$fts?>>-Seleccione uno-</option>
                                    <option <?=$ft?> value="Listo">Listo ✅</option>
                                    <option <?=$ftn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fte?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Presidente de Comite o Propietario</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_presidente_de_comite_o_propietario'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $k=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $k=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Comite" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Presidente de Comite o Propietario</label>
                            <select class="form-control" name="estado-comite" required>
                            <?php if($p7['firma_presidente_de_comite_o_propietario_estatus']=='Listo'){
                                        $fpe = 'selected'; $fpes=''; $fpen=''; $fpee=''; $l=1;
                                        }else if($p7['firma_presidente_de_comite_o_propietario_estatus']=='En Proceso'){
                                            $fpee = 'selected'; $fpes=''; $fpen=''; $fpe=''; $l=0;
                                        }else if($p7['firma_presidente_de_comite_o_propietario_estatus']=='Faltante'){
                                            $fpen = 'selected'; $fpe=''; $fpes=''; $fpee=''; $l=0;
                                        }else{$fpes = 'selected'; $fpee=''; $fpen=''; $fpe=''; $l=0;}?>
                                    <option <?=$fpes?>>-Seleccione uno-</option>
                                    <option <?=$fpe?> value="Listo">Listo ✅</option>
                                    <option <?=$fpen?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fpee?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Secretario Técnico</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_secretario_tecnico'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $m=1;} else { echo 'rojo'; $icon = '&#xe5c9;'; $m=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Secretario" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Técnico</label>
                            <select class="form-control" name="estado-secretario" required>
                            <?php if($p7['firma_secretario_tecnico_estatus']=='Listo'){
                                        $fst = 'selected'; $fsts=''; $fstn=''; $fste=''; $n=1;
                                        }else if($p7['firma_secretario_tecnico_estatus']=='En Proceso'){
                                            $fste = 'selected'; $fsts=''; $fstn=''; $fst=''; $n=0;
                                        }else if($p7['firma_secretario_tecnico_estatus']=='Faltante'){
                                            $fstn = 'selected'; $fst=''; $fsts=''; $fste=''; $n=0;
                                        }else{$fsts = 'selected'; $fste=''; $fstn=''; $fst=''; $n=0;}?>
                                    <option <?=$fsts?>>-Seleccione uno-</option>
                                    <option <?=$fst?> value="Listo">Listo ✅</option>
                                    <option <?=$fstn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fste?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="formFile" class="form-label fw-bold">Procurador de desarrollo urbano</label>
                            <span class="material-icons position-absolute <?php if ($p7['firma_procurador_de_desarrollo_urbano'] != null) { echo 'verde'; $icon = '&#xe2e6;'; $o=1;} else { echo 'rojo'; $icon = '&#xe5c9;';$o=0;} ?>"><?= $icon; ?></span>
                            <input class="form-control" name="Procurador" type="file" id="formFile">
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Estado de Firma de Procurador de desarrollo urbano</label>
                            <select class="form-control" name="estado-procurador" required>
                            <?php if($p7['firma_procurador_de_desarrollo_urbano_estatus']=='Listo'){
                                        $fpdd = 'selected'; $fpdds=''; $fpddn=''; $fpdde=''; $p=1;
                                        }else if($p7['firma_procurador_de_desarrollo_urbano_estatus']=='En Proceso'){
                                            $fpdde = 'selected'; $fpdds=''; $fpddn=''; $fpdd=''; $p=0;
                                        }else if($p7['firma_procurador_de_desarrollo_urbano_estatus']=='Faltante'){
                                            $fpddn = 'selected'; $fpdde=''; $fpdds=''; $fpdd=''; $p=0;
                                        }else{$fpdds = 'selected'; $fpdde=''; $fpddn=''; $fpdd=''; $p=0;}?>
                                    <option <?=$fpdds?>>-Seleccione uno-</option>
                                    <option <?=$fpdd?> value="Listo">Listo ✅</option>
                                    <option <?=$fpddn?> value="Faltante">Faltante ❌</option>
                                    <option <?=$fpdde?> value="En Proceso">En Proceso ⌛️</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar documentos</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php $_SESSION['i7'.$p7['folio']] = $a+$b+$c+$d+$e+$f+$g+$h+$i+$j+$k+$l+$m+$n+$o+$p;}?>
    <!-- Modal Eliminar-->
    <?php $fol = "SELECT * FROM solicitud_de_regularizacion WHERE archivar = true";
          $queryf = mysqli_query($conn, $fol);
          while($f = mysqli_fetch_array($queryf)){?>
    <div class="modal fade" id="<?=$f['folio']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-x1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Desarchivar consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="src/php/desarchivar.php" method="post">
                <div class="modal-body">
                    <p>¿Seguro que desea desarchivar esta consulta?</p>
                    <div class="row mb-3 g-1">
                            <div class="col-auto">
                                <label class="col-form-label">Folio: </label>
                            </div>
                            <div class="col-auto">
                                <input  type="text" readonly class="form-control-plaintext fw-bold" name="folio" id="folio" value="<?=$f['folio']?>">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-dismiss="modal">Desarchivar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php }?>
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

    <!-- Toast -->
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-4">
        <div id="toastBusqueda" class="toast text-bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
            <div style="background-color: white;" class="toast-header">
                <img style="width: 20px; height:20px;" src="src/img/<?= $_SESSION['colorToast'] ?>.jpg" class="rounded me-2" alt="rojo">
                <strong style="color: black;" class="me-auto">Mensaje</strong>
                <small style="color:black;">hace 1 segundo</small>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php if (isset($_SESSION['mensajeToast'])) echo $_SESSION['mensajeToast']; ?>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
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
    <script>
        <?php if ($_SESSION['busqueda'] == false) { ?>
            const toast = document.getElementById('toastBusqueda')
            const t = new bootstrap.Toast(toast)
            t.show()
        <?php $_SESSION['busqueda'] = true;
        } ?>
    </script>
</body>

</html>
