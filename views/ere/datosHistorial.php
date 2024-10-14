<?php
require_once "./../../modelo/Ere.php";

$evaluacion = $_POST['evaluacion'];
$ere = new Ere;

$dataEvaluacion = $ere->getDataEvaluacion($evaluacion);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">

            <div class="row">
                <div class="col-sm-12 m-4">
                    <img src="imagen/BANER2024.png" width="100%">
                </div>
            </div>
        </div>
        <div class="col-8">
            <a href="2024i/aplicacion2024i/PlantillaPreERE2024.xlsx">
                <div class="alert alert-primary" role="alert">
                    Descarga aquí los materiales pedagógicos ERE <i class="fas fa-folder"></i>
                </div>
            </a>
            <a href="2024i/aplicacion2024i/PlantillaPreERE2024.xlsx">
                <div class="alert alert-primary" role="alert">
                    Plantilla para Pre-Registro de Datos <i class="fas fa-file-excel"></i>
                </div>
            </a>

            <a href="2024i/ManualAplicativodeEscritorio.pdf">
                <div class="alert alert-success" role="alert">
                    Manual Aplicativo <i class="fas fa-file-pdf"></i>
                </div>
            </a>
            
                <h3 class="text-center"><B>NIVEL PRIMARIA</B></h3>
            
            <h4><B>2do</B></h4>
            <table class="table table-sm table-bordered  table-striped table-hover">
                <thead>
                    <tr class="tablatitulo text-center">
                        <th scope="col" rowspan="2" class="align-middle">N°</th>
                        <th scope="col" rowspan="2" class="align-middle">ÁREA</th>
                        <th scope="col" colspan="2" class="align-middle">MATRIZ</th>
                        <th scope="col" colspan="2" class="align-middle">CUADERNILLO</th>
                        <th scope="col" rowspan="2" class="align-middle">APLICACIÓN</th>
                        <th scope="col" rowspan="2" class="align-middle">HOJA DE RESPUESTAS</th>

                    </tr>
                    <tr class="tablatitulo text-center">
                        <th scope="col">Gral.</th>
                        <th scope="col">Especial</th>
                        <th scope="col">Gral.</th>
                        <th scope="col">Especial</th>
                    </tr>
                </thead>
                <tbody class="areasarchivo">
                    <tr>
                        <th scope="row">1</th>
                        <td>Matemática</td>
                        <td class="text-center">
                            <a target="_new" href="2024i/matriz2024i/matrizMatematicaPrimaria2.pdf">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </button>
                            </a>
                        </td>
                        <td class="text-center"><a target="_new"
                                href="2024i/matriz2024i/matrizMatematicaPrimaria2.pdf"><button type="button"
                                    class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i>
                                    PDF</button></a></td>
                        <td class="text-center"><a target="_new"
                                href="2024i/cuadernillo2024i/2PrimariaMatematica.pdf"><button type="button"
                                    class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i>
                                    PDF</button></a></td>
                        <td class="text-center"><a target="_new"
                                href="2024i/cuadernillo2024i/2PrimariaMatematica.pdf"><button type="button"
                                    class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i>
                                    PDF</button></a></td>
                        <td class="text-center"><a href="2024i/aplicacion2024i/2PrimariaMatematica.xlsm"><button
                                    type="button" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i>
                                    EXCEL</button></a></td>
                        <td class="text-center"><a target="_new"
                                href="2024i/Hojarespuestas2024i/HojaRespuestas03Preguntas.pdf" target="_new"><button
                                    type="button" class="btn btn-warning btn-sm"><i class="fas fa-file-signature"></i>
                                    RESPUESTAS</button></a></td>
                    </tr>

                </tbody>
            </table>


        </div>
    </div>
</div>