<?php session_start();

if (!isset($_SESSION["dni"]))
    header("location:index.php");

require_once 'assets/helper.php';
$fechaVencimiento = '2024-08-04'; //Poder manipular este dato desde la base de datos y con una interfaz
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>.::DREMO::.</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
    <link rel="stylesheet" href="css/disenooptimizado.css">
    <!-- es la parte de las tablas. -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="loader"></div>
    <?php
    require_once "cAdmision.php";
    $asistencia = new cAdmision;
    $dni = $_SESSION['dni'];
    $nombre = $_SESSION['nombres'];
    $apellidomat = $_SESSION['apellidomat'];
    $apellidopat =  $_SESSION['apellidopat'];
    $idtipo = $_SESSION['idtipo'];
    $tipo = $_SESSION['destipo'];
    $iddetalle = $_SESSION['iddetalleus'];
    $dataUgel = $asistencia->mostrarugel($iddetalle);
    $nombreUgel = '';
    $idUgel = '';
    while ($ugel = mysqli_fetch_array($dataUgel)) {
        $idUgel = $ugel['ugel'];
        switch ($idUgel) {
            case 'gsc':
                $nombreUgel = 'General Sanchez Cerro';
                break;
            case 'ilo':
                $nombreUgel = 'Ilo';
                break;
            case 'mn':
                $nombreUgel = 'Mariscal Nieto';
                break;
            case 'sanig':
                $nombreUgel = 'San Ignacion de Loyola';
                break;
        }
        break;
    }
    require_once 'views/nav.php';
    ?>
    <div class="container-fluid resultado">
        <br>
        <?php
        if (strtolower($nombre) == 'visitante') {
            echo "<h2> Bienvenido Visitante.</h2>";
        } else {
            /* if ($idtipo == '5' or $idtipo == '6') { */
            $Lisefq = $asistencia->moestraries($iddetalle);
            while ($Lpedq = mysqli_fetch_array($Lisefq)) {
        ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-1">
                            <h5>Bienvenido(a):</h5>
                        </div>
                        <div class="col-sm-1">
                            <small class="form-text text-muted">Cod. Mod.</small>
                            <label><b><?= $Lpedq['codmodular']; ?></b></label>
                        </div>
                        <div class="col-sm-3">
                            <small class="form-text text-muted">Nombre</small>
                            <label><b><?= $Lpedq['descripcion']; ?></b></label>
                        </div>
                        <div class="col-sm-1">
                            <small class="form-text text-muted">Nivel</small>
                            <label><b><?= $Lpedq['nivel']; ?></b></label>
                        </div>
                        <div class="col-sm-1">
                            <small class="form-text text-muted">Grado</small>
                            <label><b><?= $Lpedq['grado']; ?></b></label>
                        </div>
                        <div class="col-sm-1">
                            <small class="form-text text-muted">Sección</small>
                            <label><b><?= $Lpedq['seccion']; ?></b></label>
                        </div>
                        <div class="col-sm-2">
                            <small class="form-text text-muted">UGEL</small>
                            <label><b><?= strtoupper($nombreUgel); ?></b></label>
                        </div>
                        <div class="col-sm-2">
                            <small class="form-text text-muted">Distrito</small>
                            <label><b><?= $Lpedq['distrito']; ?></b></label>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row my-2">
                        <div class="col-sm-12 text-center">
                            <?php
                            if (estoyATiempo($fechaVencimiento)):
                            ?>
                                <button type="button" class="btn btn-primary btn-lg xLinkInfo"
                                    data-info="<?= $Lpedq['codmodular'] . '|' . $Lpedq['descripcion'] . '|' . $Lpedq['nivel'] ?>"
                                    data-php="views/ies/frmSubirExamenes">
                                    <i class="fas fa-upload"></i> Subir Resultados de Aplicativos
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-secondary iesdirector btn-lg"
                                idenvi="<?= $Lpedq['codmodular']; ?>" iesdes="<?= $Lpedq['descripcion']; ?>"><i
                                    class="fas fa-door-open"></i> Ingresar
                            </button>
                            <br>
                            <div class="alert alert-danger text-center">
                                La opción <b>SUBIR RESULTADOS DE APLICATIVOS</b> solo estará disponible hasta el:
                                <b><?= formatoFecha($fechaVencimiento) ?> </b><br>
                                <span class="text-danger">
                                    Coordine con su UGEL, para que pueda validarlos.
                                </span>
                            </div>
                        </div>

                    </div>
                    <hr class="my-4">
                <?php
                break;
            }   // Fin del while
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <img src="imagen/BANER2024.png" width="100%">
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header text-center">
                                    <span class="font-weight-bold">Recursos</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="alert alert-warning" role="alert">
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="far fa-folder fa-lg  mr-3"></i>
                                                        <div class="media-body">
                                                            <a
                                                                href="https://drive.google.com/drive/u/0/folders/1DmK0Dy9hP0YBdsBRx1G0pzIiu33ZsOn7">
                                                                <h5 class="mt-0 mb-1">Materiales</h5>
                                                                de consulta pedagógica
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="alert alert-primary" role="alert">
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="fas fa-file-excel fa-lg mr-3"></i>
                                                        <div class="media-body">
                                                            <a href="2024i/aplicacion2024i/PlantillaPreERE2024.xlsx">
                                                                <h5 class="mt-0 mb-1">Plantilla</h5>
                                                                Pre-Registro de Datos
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="alert alert-success">
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="fas fa-file-pdf fa-lg  mr-3"></i>
                                                        <div class="media-body">
                                                            <a href="2024i/ManualAplicativodeEscritorio.pdf">
                                                                <h5 class="mt-0 mb-1">Manual</h5>
                                                                Manual del Aplicativo
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (estoyATiempo($fechaVencimiento)):
                                if (in_array($idtipo, [1, 4])): ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6 text-right">
                                                    <span class="font-weight-bold">Validación de Resultados</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-primary xLinkInfo"
                                                        data-php="views/ugel/frmValidarSubirExamen"
                                                        data-info="<?= $idUgel ?>|<?= $nombreUgel ?>">
                                                        <i class="far fa-check-circle"></i>
                                                        Validar Resultados de Aplicativo
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-danger text-center">
                                                        Esta opción solo estará disponible hasta el:
                                                        <b><?= formatoFecha($fechaVencimiento) ?> </b><br>
                                                        <span class="text-danger">
                                                            Coordine con las IIEE, para que subar sus archivos EXCEL para que pueda
                                                            validarlos.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php endif;
                            endif; ?>
                                <hr class="my-4">
                                <?php
                                require_once 'views/primariaPrincipal.php';
                                ?>
                                <hr class="my-4">
                                <?php
                                require_once 'views/secundariaPrincipal.php';
                                ?>
                                    </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Div para subir archivos -->
                <div class="modal fade" id="modalSubirArchivo" tabindex="-1" role="dialog"
                    aria-labelledby="modalSubirArchivoLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-12">
                                    Subir Archivo: Evaluación - <span id="tipoEvaluacion"></span>
                                </h5>
                            </div>
                            <div id="respuestaerrgclave">
                                <form id="frmSubirArchivo" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                Nivel:
                                            </div>
                                            <div class="col-sm-8">
                                                <span id="nombreNivel"></span>
                                                <input hidden type="text" id="idNivel" name="nivel" value="">
                                                <input hidden type="text" id="idCodModular" name="codmodular" value="">
                                                <input hidden type="text" id="idHistorial" name="historial" value="">
                                                <input hidden type="text" id="idDetalle" name="detalle" value="">
                                                <input hidden type="text" id="idTipo" name="tipo" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                Grado:
                                            </div>
                                            <div class="col-sm-8">
                                                <span id="nombreGrado"></span> Grado
                                                <input hidden type="text" id="idGrado" name="grado" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                Área:
                                            </div>
                                            <div class="col-sm-8">
                                                <span id="nombreArea"></span>
                                                <input hidden type="text" id="idArea" name="area" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6 class="text-center">Archivo Excel:</h6>
                                                <div class="drop-zone p-2 text-center" id="drop-zone">
                                                    Arrastre el archivo EXCEL aquí o haga clic para seleccionar
                                                    <input required type="file" class="form-control-file" id="excelFile"
                                                        name="excelFile" accept=".xlsm" style="display: none;">
                                                </div>
                                                <div class="file-details text-bold" id="file-details"></div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                                <div class="alert alert-danger" id="file-alert">Por favor, seleccione un archivo
                                                    antes de subir.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="subirExcel">Subir Archivo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } // Fin de Else inicial
            ?>
            <!-- partial -->
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script src="js/jscript.js"></script>
</body>

</html>