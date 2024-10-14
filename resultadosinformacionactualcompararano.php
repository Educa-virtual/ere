<?php session_start();
if ($_SESSION["dni"] != '') {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <link rel="stylesheet" href="css/disenooptimizado.css">

    </head>

    <body>

        <?php
        error_reporting(0);
        require_once "cAdmision.php";
        $asistencia = new cAdmision;

        $curso = $_POST['curso'];
        $nivel = $_POST['nivel'];
        $grado = $_POST['grado'];
        $ugel = $_POST['ugel'];
        $gestion = $_POST['gestion'];
        $zona = $_POST['zona'];
        $distrito = $_POST['distrito'];
        $sexo = $_POST['sexo'];
        $seccion = $_POST['seccion'];
        $ie = $_POST['ie'];
        //$evaluaci = $_POST['evaluaci'];


        $anoa = $_POST['anoa'];
        $anob = $_POST['anob'];


        //-----------------Descripcion EVALUACIÓN--------------------------------
        $nombrea = $asistencia->nombreevaluacion($anoa);
        while ($nomb = mysqli_fetch_array($nombrea)) {
            $evaluacioninicial = $nomb['descripcion'];
        }
        $nombreb = $asistencia->nombreevaluacion($anob);
        while ($nombr = mysqli_fetch_array($nombreb)) {
            $evaluacionfinal = $nombr['descripcion'];
        }



        //-----------------Descripcion UGEL--------------------------------
        $cursodesg = $asistencia->ugelre($ugel);
        while ($mascuf = mysqli_fetch_array($cursodesg)) {
            $desugel = $mascuf['ugeldescripcion'];
        }
        //-----------------Descripcion AREA--------------------------------
        $cursodes = $asistencia->iesareasdes($curso);
        while ($mascu = mysqli_fetch_array($cursodes)) {
            $descurso = $mascu['descripcionarea'];
        }
        //-----------------Descripcion IE--------------------------------

        if ($ie == '') {
            $desies = '';
        } else {

            $cursodesnrq = $asistencia->mostracolegio($ie);
            while ($mascuwq = mysqli_fetch_array($cursodesnrq)) {
                $desies = $mascuwq['descripcion'];
            }
        }




        //-----------------Extraer Datos de Matriz-------------------------------

        for ($i = 1; $i <= 20; $i++) {

            $matrist1 = $asistencia->matrisres($curso, $grado, $nivel, $i, $anoa);
            while ($maser1 = mysqli_fetch_array($matrist1)) {
                $demoab1[$i] = $maser1['clave'];
                $nivel1a[$i] = $maser1['nivelp'];
                $competencia1a[$i] = $maser1['competencia'];
                $desempeno1a[$i] = $maser1['desempeno'];
                $items1[$i] = $maser1['item'];
                $estado1[$i] = $maser1['estado'];
            }

            $matrist2 = $asistencia->matrisres($curso, $grado, $nivel, $i, $anob);
            while ($maser1b = mysqli_fetch_array($matrist2)) {
                $demoab1b[$i] = $maser1b['clave'];
                $nivel1ab[$i] = $maser1b['nivelp'];
                $competencia1ab[$i] = $maser1b['competencia'];
                $desempeno1ab[$i] = $maser1b['desempeno'];
                $items1b[$i] = $maser1b['item'];
                $estado1b[$i] = $maser1b['estado'];
            }
        }

        //----------------FIN Extraer Datos de Matriz-------------------------------


        //----------------- fin Revisar su USO--------------------------------------------------------------
        ?>


        <form action="pdfresultadocompracionano.php" method="POST">


            <input type="hidden" id="imagenb" name="imagenb">
            <input type="hidden" id="imagena" name="imagena">

            <input type="hidden" value="<?php echo $evaluacioninicial; ?>" name="desnombresinicial">
            <input type="hidden" value="<?php echo $evaluacionfinal; ?>" name="desnombresfinal">

            <input type='hidden' id='texta1' name='texta1'>
            <input type='hidden' id='respa1' name='respa1'>
            <input type='hidden' id='pora1' name='pora1'>
            <input type='hidden' id='respa2' name='respa2'>
            <input type='hidden' id='pora2' name='pora2'>

            <input type='hidden' id='texta11' name='texta11'>
            <input type='hidden' id='respa11' name='respa11'>
            <input type='hidden' id='pora11' name='pora11'>
            <input type='hidden' id='respa21' name='respa21'>
            <input type='hidden' id='pora21' name='pora21'>

            <input type='hidden' id='texta12' name='texta12'>
            <input type='hidden' id='respa12' name='respa12'>
            <input type='hidden' id='pora12' name='pora12'>
            <input type='hidden' id='respa22' name='respa22'>
            <input type='hidden' id='pora22' name='pora22'>

            <input type='hidden' id='text4' name='text4'>
            <input type='hidden' id='resp14' name='resp14'>
            <input type='hidden' id='pord14' name='pord14'>
            <input type='hidden' id='resp24' name='resp24'>
            <input type='hidden' id='pord24' name='pord24'>



            <input type='hidden' id='sumatoriofinacf' name='sumatoriofinacf'>
            <input type='hidden' id='porcenajefinalcf' name='porcenajefinalcf'>
            <input type='hidden' id='sumatoriofinacfc' name='sumatoriofinacfc'>
            <input type='hidden' id='porcenajefinalcfc' name='porcenajefinalcfc'>

            <input type="hidden" value="<?php echo $anoa; ?>" name="anoa">
            <input type="hidden" value="<?php echo $anob; ?>" name="anob">
            <input type="hidden" value="<?php echo $curso; ?>" name="curso">
            <input type="hidden" value="<?php echo $nivel; ?>" name="nivel">
            <input type="hidden" value="<?php echo $grado; ?>" name="grado">
            <input type="hidden" value="<?php echo $ugel; ?>" name="ugel">
            <input type="hidden" value="<?php echo $gestion; ?>" name="gestion">
            <input type="hidden" value="<?php echo $zona; ?>" name="zona">
            <input type="hidden" value="<?php echo $distrito; ?>" name="distrito">
            <input type="hidden" value="<?php echo $sexo; ?>" name="sexo">
            <input type="hidden" value="<?php echo $seccion; ?>" name="seccion">
            <input type="hidden" value="<?php echo $ie; ?>" name="ie">
            <input type="hidden" value="<?php echo $anoa; ?>" name="evaluaci">


            <div class="card">
                <h6 class="card-header">
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            .:: <i class="fas fa-download"></i> DATOS
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <input type="submit" class="btn btn-light" value="Enviar en PDF">

        </form>

        </div>
        </div>
        </h6>
        <div class="card-body">
            <div class="alert alert-dark" role="alert">
                <div class="row encabezadostitulo">
                    <div class="col-1">
                        Nivel
                    </div>
                    <div class="col-2">
                        Area
                    </div>
                    <div class="col-1">
                        Grado
                    </div>
                    <div class="col-2">
                        UGEL
                    </div>
                    <div class="col-1">
                        Distrito
                    </div>
                    <div class="col-2">
                        I.E.
                    </div>
                    <div class="col-1">
                        Gestión
                    </div>
                    <div class="col-1">
                        Zona
                    </div>
                    <div class="col-1">
                        Seccion
                    </div>
                </div>

                <div class="row encabezadostitulo">
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($nivel); ?></strong>
                    </div>
                    <div class="col-2">
                        <strong><?PHP echo strtoupper($descurso); ?></strong>
                    </div>
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($grado) . "°"; ?></strong>
                    </div>
                    <div class="col-2">
                        <strong><?PHP echo strtoupper($desugel); ?></strong>
                    </div>
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($distrito); ?></strong>
                    </div>
                    <div class="col-2">
                        <strong><?PHP echo strtoupper($ie . " - " .  $desies); ?></strong>
                    </div>
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($gestion); ?></strong>
                    </div>
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($zona); ?></strong>
                    </div>
                    <div class="col-1">
                        <strong><?PHP echo strtoupper($seccion); ?></strong>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                .:: <?php echo $evaluacioninicial; ?>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                            <?php
                            $total1 = 0;
                            $total2 = 0;
                            $total3 = 0;
                            $total4 = 0;
                            $total5 = 0;
                            $total6 = 0;
                            $total7 = 0;
                            $total8 = 0;
                            $total9 = 0;
                            $total10 = 0;
                            $total11 = 0;
                            $total12 = 0;
                            $total13 = 0;
                            $total14 = 0;
                            $total15 = 0;
                            $total16 = 0;
                            $total17 = 0;
                            $total18 = 0;
                            $total19 = 0;
                            $total20 = 0;
                            $totalpreinicio = 0;
                            $totalinicio = 0;
                            $totalproceso = 0;
                            $totalsatisfactorio = 0;
                            $contpr = 0;


                            //--------------------------Nuevos Contadores--------------------
                            $sumador1 = 0;
                            $sumador2 = 0;
                            $sumador3 = 0;
                            $sumador4 = 0;
                            $sumador5 = 0;
                            $sumador6 = 0;
                            $sumador7 = 0;
                            $sumador8 = 0;
                            $sumador9 = 0;
                            $sumador10 = 0;
                            $sumador11 = 0;
                            $sumador12 = 0;
                            $sumador13 = 0;
                            $sumador14 = 0;
                            $sumador15 = 0;
                            $sumador16 = 0;
                            $sumador17 = 0;
                            $sumador18 = 0;
                            $sumador19 = 0;
                            $sumador20 = 0;


                            $blanco1 = 0;
                            $blanco2 = 0;
                            $blanco3 = 0;
                            $blanco4 = 0;
                            $blanco5 = 0;
                            $blanco6 = 0;
                            $blanco7 = 0;
                            $blanco8 = 0;
                            $blanco9 = 0;
                            $blanco10 = 0;
                            $blanco11 = 0;
                            $blanco12 = 0;
                            $blanco13 = 0;
                            $blanco14 = 0;
                            $blanco15 = 0;
                            $blanco16 = 0;
                            $blanco17 = 0;
                            $blanco18 = 0;
                            $blanco19 = 0;
                            $blanco20 = 0;

                            $incorrecto1 = 0;
                            $incorrecto2 = 0;
                            $incorrecto3 = 0;
                            $incorrecto4 = 0;
                            $incorrecto5 = 0;
                            $incorrecto6 = 0;
                            $incorrecto7 = 0;
                            $incorrecto8 = 0;
                            $incorrecto9 = 0;
                            $incorrecto10 = 0;
                            $incorrecto11 = 0;
                            $incorrecto12 = 0;
                            $incorrecto13 = 0;
                            $incorrecto14 = 0;
                            $incorrecto15 = 0;
                            $incorrecto16 = 0;
                            $incorrecto17 = 0;
                            $incorrecto18 = 0;
                            $incorrecto19 = 0;
                            $incorrecto20 = 0;
                            ?>

                            <?php
                            $asistenciacon = $asistencia->contarconsultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $anoa);
                            while ($asiy = mysqli_fetch_array($asistenciacon)) {
                                $contabilizar = $asiy[0];
                            }
                            if ($contabilizar == 0) {
                                include "batosblanco.php";

                                $resultadocala = 0;
                                $totalpreinicio = 0;
                                $propreinicio = 0;
                                $resultadocalb = 0;
                                $totalinicio = 0;
                                $porinicio = 0;
                                $resultadocalc = 0;
                                $totalproceso = 0;
                                $porproceso = 0;
                            } else {
                            ?>
                                <table class="table table-sm table-bordered  table-striped table-hover">
                                    <thead>
                                        <tr class="tablatitulor">
                                            <th scope="col">N.</th>
                                            <th scope="col">CÓD. MOD.| I.E.</th>
                                            <th scope="col">DISTRITO</th>
                                            <th scope="col">SEC.</th>
                                            <th scope="col">APELLIDO Y NOMBRES</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                            <th scope="col">4</th>
                                            <th scope="col">5</th>
                                            <th scope="col">6</th>
                                            <th scope="col">7</th>
                                            <th scope="col">8</th>
                                            <th scope="col">9</th>
                                            <th scope="col">10</th>
                                            <th scope="col">11</th>
                                            <th scope="col">12</th>
                                            <th scope="col">13</th>
                                            <th scope="col">14</th>
                                            <th scope="col">15</th>
                                            <th scope="col">16</th>
                                            <th scope="col">17</th>
                                            <th scope="col">18</th>
                                            <th scope="col">19</th>
                                            <th scope="col">20</th>
                                            <th scope="col">N° aciertos</th>
                                            <th scope="col">N° desaciertos</th>
                                            <th scope="col">N° Blancos</th>
                                            <th scope="col">Nivel</th>
                                        </tr>
                                    </thead>
                                    <?php




                                    //--------------------------FIn Nuevos Contadores--------------------


                                    $datoscalculo = $asistencia->calculoindicador($anoa, $curso, $grado, $nivel);
                                    while ($asic = mysqli_fetch_array($datoscalculo)) {
                                        $iniciocala = $asic['iniciala'];
                                        $fincala = $asic['finala'];
                                        $resultadocala = $asic['resultadoa'];
                                        $iniciocalb = $asic['inicialb'];
                                        $fincalb = $asic['finalb'];
                                        $resultadocalb = $asic['resultadob'];
                                        $iniciocalc = $asic['inicialc'];
                                        $fincalc = $asic['finalc'];
                                        $resultadocalc = $asic['resultadoc'];
                                        $iniciocald = $asic['iniciald'];
                                        $fincald = $asic['finald'];
                                        $resultadocald = $asic['resultadod'];
                                        $calinivel = $asic['calinivel'];
                                    }

                                    $asistencia = $asistencia->consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $anoa);
                                    while ($asi = mysqli_fetch_array($asistencia)) {
                                        $nro = $nro + 1;

                                        $contadorc = 0;
                                        $contadori = 0;
                                        $blancoc = 0;
                                        $totalnivel = 0;
                                        echo "<tr class='tablacontenidor'>";
                                        echo "<td>" . $nro . "</td>";
                                        echo "<td>" . $asi['codigomodular'] . " | " . $asi['ie'] . "</td>";
                                        echo "<td>" . $asi['distrito'] . "</td>";
                                        echo "<td>" . $asi['seccion'] . "</td>";
                                        echo "<td>" . $asi['apellidopaterno'] . " " . $asi['apellidomaterno'] . " ; " . $asi['primernombre'] . " " . $asi['segundonombre'] . " " . $asi['tercernombre'] . "</td>";

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[1] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas1'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco1 = $blanco1 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas1']) == strtolower($demoab1[1])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas1'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador1 = $sumador1 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[1];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas1'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto1 = $incorrecto1 + 1;
                                                }
                                            }
                                        }
                                        //-------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1['2'] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas2'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco2 = $blanco2 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas2']) == strtolower($demoab1[2])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas2'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador2 = $sumador2 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[2];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas2'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto2 = $incorrecto2 + 1;
                                                }
                                            }
                                        }
                                        //-------------------------------------------------------------------------------------------                          
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[3] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas3'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco3 = $blanco3 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas3']) == strtolower($demoab1[3])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas3'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador3 = $sumador3 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[3];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas3'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto3 = $incorrecto3 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[4] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas4'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco4 = $blanco4 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas4']) == strtolower($demoab1[4])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas4'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador4 = $sumador4 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[4];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas4'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto4 = $incorrecto4 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[5] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas5'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco5 = $blanco5 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas5']) == strtolower($demoab1[5])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas5'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador5 = $sumador5 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[5];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas5'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto5 = $incorrecto5 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[6] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas6'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco6 = $blanco6 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas6']) == strtolower($demoab1[6])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas6'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador6 = $sumador6 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[6];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas6'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto6 = $incorrecto6 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[7] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas7'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco7 = $blanco7 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas7']) == strtolower($demoab1[7])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas7'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador7 = $sumador7 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[7];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas7'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto7 = $incorrecto7 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[8] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas8'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco8 = $blanco8 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas8']) == strtolower($demoab1[8])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas8'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador8 = $sumador8 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[8];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas8'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto8 = $incorrecto8 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[9] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas9'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco9 = $blanco9 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas9']) == strtolower($demoab1[9])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas9'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador9 = $sumador9 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[9];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas9'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto9 = $incorrecto9 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[10] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas10'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco10 = $blanco10 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas10']) == strtolower($demoab1[10])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas10'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador10 = $sumador10 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[10];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas10'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto10 = $incorrecto10 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[11] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas11'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco11 = $blanco11 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas11']) == strtolower($demoab1[11])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas11'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador11 = $sumador11 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[11];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas11'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto11 = $incorrecto11 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[12] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas12'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco12 = $blanco12 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas12']) == strtolower($demoab1[12])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas12'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador12 = $sumador12 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[12];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas12'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto12 = $incorrecto12 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[13] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas13'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco13 = $blanco13 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas13']) == strtolower($demoab1[13])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas13'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador13 = $sumador13 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[13];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas13'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto13 = $incorrecto13 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[14] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas14'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco14 = $blanco14 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas14']) == strtolower($demoab1[14])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas14'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador14 = $sumador14 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[14];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas14'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto14 = $incorrecto14 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[15] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas15'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco15 = $blanco15 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas15']) == strtolower($demoab1[15])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas15'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador15 = $sumador15 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[15];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas15'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto15 = $incorrecto15 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[16] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas16'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco16 = $blanco16 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas16']) == strtolower($demoab1[16])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas16'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador16 = $sumador16 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[16];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas16'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto16 = $incorrecto16 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[17] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas17'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco17 = $blanco17 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas17']) == strtolower($demoab1[17])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas17'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador17 = $sumador17 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[17];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas17'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto17 = $incorrecto17 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[18] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas18'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco18 = $blanco18 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas18']) == strtolower($demoab1[18])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas18'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador18 = $sumador18 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[18];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas18'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto18 = $incorrecto18 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[19] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas19'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco19 = $blanco19 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas19']) == strtolower($demoab1[19])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas19'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador19 = $sumador19 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[19];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas19'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto19 = $incorrecto19 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1[20] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asi['respuestas20'] == '') {
                                                $blancoc = $blancoc + 1;
                                                $blanco20 = $blanco20 + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asi['respuestas20']) == strtolower($demoab1[20])) {
                                                    echo "<td class='correcto'>" . $asi['respuestas20'] . "</td>";
                                                    $contadorc = $contadorc + 1;
                                                    $sumador20 = $sumador20 + 1;
                                                    $totalnivel = $totalnivel + $nivel1a[20];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asi['respuestas20'] . "</td>";
                                                    $contadori = $contadori + 1;
                                                    $incorrecto20 = $incorrecto20 + 1;
                                                }
                                            }
                                        }
                                        //------------------------------------------------------------------------------------------- 

                                        echo "<td style='text-align:center;'>" . $contadorc . "</td>";
                                        echo "<td style='text-align:center;'>" .  $contadori . "</td>";
                                        echo "<td style='text-align:center;'>" .  $blancoc . "</td>";





                                        $numerosec[$nro] = $totalnivel;
                                        $numerofr[$nro] = $contadorc;



                                        if ($calinivel == 1) {
                                            if ($totalnivel <= $fincala) {
                                                echo "<td class='preinicio'>" . $resultadocala . "</td>";
                                                $totalpreinicio = $totalpreinicio + 1;
                                            } elseif ($totalnivel >= $iniciocalb and $totalnivel <= $fincalb) {
                                                echo "<td class='inicio'>" . $resultadocalb . "</td>";
                                                $totalinicio = $totalinicio + 1;
                                            } elseif ($totalnivel >= $iniciocalc and $totalnivel <= $fincalc) {
                                                echo "<td class='proceso'>" . $resultadocalc . "</td>";
                                                $totalproceso = $totalproceso + 1;
                                            } elseif ($totalnivel >= $iniciocald and $totalnivel <= $fincald) {
                                                echo "<td class='proceso'>" . $resultadocald . "</td>";
                                                $totalsatisfactorio = $totalsatisfactorio + 1;
                                            }
                                        } else {
                                            if ($contadorc <= $fincala) {
                                                echo "<td class='preinicio'>" . $resultadocala . "</td>";
                                                $totalpreinicio = $totalpreinicio + 1;
                                            } elseif ($contadorc >= $iniciocalb and $contadorc <= $fincalb) {
                                                echo "<td class='inicio'>" . $resultadocalb . "</td>";
                                                $totalinicio = $totalinicio + 1;
                                            } elseif ($contadorc >= $iniciocalc and $contadorc <= $fincalc) {
                                                echo "<td class='proceso'>" . $resultadocalc . "</td>";
                                                $totalproceso = $totalproceso + 1;
                                            } elseif ($contadorc >= $iniciocald and $contadorc <= $fincald) {
                                                echo "<td class='proceso'>" . $resultadocald . "</td>";
                                                $totalsatisfactorio = $totalsatisfactorio + 1;
                                            }
                                        }
                                        echo "</tr>";
                                    }

                                    $propreinicio = round((($totalpreinicio * 100) / $nro), 1);
                                    $porinicio = round((($totalinicio * 100) / $nro), 1);
                                    $porproceso = round((($totalproceso * 100) / $nro), 1);
                                    $porsatisfactorio = round((($totalsatisfactorio * 100) / $nro), 1);

                                    ?>
                                </table>


                                <table class="table table-sm table-bordered  table-striped table-hover ">
                                    <thead>
                                        <tr style="background-color:#3a3a3a; color:#ffffff">
                                            <th>NIVEL DE LOGRO</th>
                                            <th>NUMERO</th>
                                            <th>PORCENTAJE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <TR>

                                            <TD><?php echo $resultadocala; ?></TD>
                                            <td>
                                                <?PHP echo $totalpreinicio; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $propreinicio . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalb; ?></TD>
                                            <td>
                                                <?PHP echo $totalinicio; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porinicio . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalc; ?></TD>
                                            <td>
                                                <?PHP echo $totalproceso; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porproceso . "%"; ?>
                                            </td>
                                        </TR>

                                        <?php if ($resultadocald != '') {  ?>
                                            <TR>
                                                <TD><?php echo $resultadocald; ?></TD>
                                                <td>
                                                    <?PHP echo $totalsatisfactorio; ?>
                                                </td>
                                                <td>
                                                    <?PHP echo $porsatisfactorio . "%"; ?>
                                                </td>
                                            </TR>

                                        <?php }
                                        ?>
                                        <TR style="background-color:#3a3a3a; color:#ffffff">
                                            <TD>TOTAL</TD>
                                            <?PHP
                                            $totalconsi = $totalinicio + $totalproceso + $totalsatisfactorio + $totalpreinicio;
                                            $portotalconsi = $porinicio + $porproceso + $porsatisfactorio + $propreinicio;
                                            ?>
                                            <td>
                                                <?PHP echo $totalconsi; ?>
                                            </td>
                                            <td>
                                                <?PHP echo round($portotalconsi) . "%"; ?>
                                            </td>
                                        </TR>
                                    </tbody>
                                </table>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                .:: <?php echo $evaluacionfinal; ?>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">



                            <?php

                            $asistencia = new cAdmision;

                            $asistenciaconb = $asistencia->contarconsultanewb($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $anob);
                            while ($asiyb = mysqli_fetch_array($asistenciaconb)) {
                                $contabilizarb = $asiyb[0];
                            }


                            if ($contabilizarb == 0) {
                                include "batosblanco.php";
                            } else {
                            ?>
                                <table class="table table-sm table-bordered  table-striped table-hover">
                                    <thead>
                                        <tr class="tablatitulor">
                                            <th scope="col">N.</th>
                                            <th scope="col">CÓD. MOD.| I.E.</th>
                                            <th scope="col">DISTRITO</th>
                                            <th scope="col">SEC.</th>
                                            <th scope="col">APELLIDO Y NOMBRES</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                            <th scope="col">4</th>
                                            <th scope="col">5</th>
                                            <th scope="col">6</th>
                                            <th scope="col">7</th>
                                            <th scope="col">8</th>
                                            <th scope="col">9</th>
                                            <th scope="col">10</th>
                                            <th scope="col">11</th>
                                            <th scope="col">12</th>
                                            <th scope="col">13</th>
                                            <th scope="col">14</th>
                                            <th scope="col">15</th>
                                            <th scope="col">16</th>
                                            <th scope="col">17</th>
                                            <th scope="col">18</th>
                                            <th scope="col">19</th>
                                            <th scope="col">20</th>
                                            <th scope="col">N° aciertos</th>
                                            <th scope="col">N° desaciertos</th>
                                            <th scope="col">N° Blancos</th>
                                            <th scope="col">Nivel</th>
                                        </tr>
                                    </thead>
                                    <?php




                                    $nrob = 0;
                                    $blanco1b = 0;
                                    $sumador1b = 0;
                                    $incorrecto1b = 0;
                                    $totalpreiniciob = 0;
                                    $totaliniciob = 0;
                                    $totalprocesob = 0;
                                    $totalsatisfactoriob = 0;

                                    $datoscalculob = $asistencia->calculoindicador($anob, $curso, $grado, $nivel);
                                    while ($asicb = mysqli_fetch_array($datoscalculob)) {
                                        $iniciocalab = $asicb['iniciala'];
                                        $fincalab = $asicb['finala'];
                                        $resultadocalab = $asicb['resultadoa'];
                                        $iniciocalbb = $asicb['inicialb'];
                                        $fincalbb = $asicb['finalb'];
                                        $resultadocalbb = $asicb['resultadob'];
                                        $iniciocalcb = $asicb['inicialc'];
                                        $fincalcb = $asicb['finalc'];
                                        $resultadocalcb = $asicb['resultadoc'];
                                        $iniciocaldb = $asicb['iniciald'];
                                        $fincaldb = $asicb['finald'];
                                        $resultadocaldb = $asicb['resultadod'];
                                        $calinivelb = $asicb['calinivel'];
                                    }



                                    $asistenciab = $asistencia->consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $anob);
                                    while ($asib = mysqli_fetch_array($asistenciab)) {
                                        $nrob = $nrob + 1;

                                        $contadorcb = 0;
                                        $contadorib = 0;
                                        $blancocb = 0;
                                        $totalnivelb = 0;
                                        echo "<tr class='tablacontenidor'>";
                                        echo "<td>" . $nrob . "</td>";
                                        echo "<td>" . $asib['codigomodular'] . " | " . $asib['ie'] . "</td>";
                                        echo "<td>" . $asib['distrito'] . "</td>";
                                        echo "<td>" . $asib['seccion'] . "</td>";
                                        echo "<td>" . $asib['apellidopaterno'] . " " . $asib['apellidomaterno'] . " ; " . $asib['primernombre'] . " " . $asib['segundonombre'] . " " . $asib['tercernombre'] . "</td>";

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[1] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas1'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas1']) == strtolower($demoab1b[1])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas1'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[1];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas1'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[2] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas2'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas2']) == strtolower($demoab1b[2])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas2'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[2];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas2'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[3] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas3'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas3']) == strtolower($demoab1b[3])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas3'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[3];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas3'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[4] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas4'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas4']) == strtolower($demoab1b[4])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas4'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[4];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas4'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[5] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas5'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas5']) == strtolower($demoab1b[5])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas5'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[5];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas5'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[6] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas6'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas6']) == strtolower($demoab1b[6])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas6'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[6];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas6'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[7] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas7'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas7']) == strtolower($demoab1b[7])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas7'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[7];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas7'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[8] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas8'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas8']) == strtolower($demoab1b[8])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas8'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[8];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas8'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[9] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas9'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas9']) == strtolower($demoab1b[9])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas9'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[9];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas9'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[10] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas10'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas10']) == strtolower($demoab1b[10])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas10'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[10];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas10'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[11] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas11'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas11']) == strtolower($demoab1b[11])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas11'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[11];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas11'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[12] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas12'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas12']) == strtolower($demoab1b[12])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas12'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[12];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas12'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[13] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas13'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas13']) == strtolower($demoab1b[13])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas13'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[13];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas13'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[14] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas14'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas14']) == strtolower($demoab1b[14])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas14'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[14];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas14'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[15] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas15'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas15']) == strtolower($demoab1b[15])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas15'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[15];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas15'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[16] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas16'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas16']) == strtolower($demoab1b[16])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas16'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[16];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas16'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[17] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas17'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas17']) == strtolower($demoab1b[17])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas17'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[17];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas17'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------

                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[18] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas18'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas18']) == strtolower($demoab1b[18])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas18'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[18];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas18'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[19] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas19'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas19']) == strtolower($demoab1b[19])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas19'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[19];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas19'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        //--------------------------------------------------------------------------------------------------
                                        if ($estado1b[20] == 1) {
                                            echo "<td class='blanco' >Anular</td>";
                                        } else {

                                            if ($asib['respuestas20'] == '') {
                                                $blancocb = $blancocb + 1;
                                                $blanco1b = $blanco1b + 1;
                                                echo "<td class='blanco' >-</td>";
                                            } else {
                                                if (strtolower($asib['respuestas20']) == strtolower($demoab1b[20])) {
                                                    echo "<td class='correcto'>" . $asib['respuestas20'] . "</td>";
                                                    $contadorcb = $contadorcb + 1;
                                                    $sumador1b = $sumador1b + 1;
                                                    $totalnivelb = $totalnivelb + $nivel1ab[20];
                                                } else {
                                                    echo "<td class='incorrecto'>" . $asib['respuestas20'] . "</td>";
                                                    $contadorib = $contadorib + 1;
                                                    $incorrecto1b = $incorrecto1b + 1;
                                                }
                                            }
                                        }
                                        //--------------------------------------------------------------------------------------------------
                                        echo "<td style='text-align:center;'>" . $contadorcb . "</td>";
                                        echo "<td style='text-align:center;'>" .  $contadorib . "</td>";
                                        echo "<td style='text-align:center;'>" .  $blancocb . "</td>";

                                        $numerosecb[$nrob] = $totalnivelb;
                                        $numerofrb[$nrob] = $contadorcb;


                                        if ($calinivelb == 1) {
                                            if ($totalnivelb <= $fincalab) {
                                                echo "<td class='preinicio'>" . $resultadocalab . "</td>";
                                                $totalpreiniciob = $totalpreiniciob + 1;
                                            } elseif ($totalnivelb >= $iniciocalbb and $totalnivelb <= $fincalbb) {
                                                echo "<td class='inicio'>" . $resultadocalbb . "</td>";
                                                $totaliniciob = $totaliniciob + 1;
                                            } elseif ($totalnivelb >= $iniciocalcb and $totalnivelb <= $fincalcb) {
                                                echo "<td class='proceso'>" . $resultadocalcb . "</td>";
                                                $totalprocesob = $totalprocesob + 1;
                                            } elseif ($totalnivelb >= $iniciocaldb and $totalnivelb <= $fincaldb) {
                                                echo "<td class='proceso'>" . $resultadocaldb . "</td>";
                                                $totalsatisfactoriob = $totalsatisfactoriob + 1;
                                            }
                                        } else {
                                            if ($contadorcb <= $fincalab) {
                                                echo "<td class='preinicio'>" . $fincalab . "-" . $resultadocalab . "</td>";
                                                $totalpreiniciob = $totalpreiniciob + 1;
                                            } elseif ($contadorcb >= $iniciocalbb and $contadorcb <= $fincalbb) {
                                                echo "<td class='inicio'>" . $resultadocalbb . "</td>";
                                                $totaliniciob = $totaliniciob + 1;
                                            } elseif ($contadorcb >= $iniciocalcb and $contadorcb <= $fincalcb) {
                                                echo "<td class='proceso'>" . $resultadocalcb . "</td>";
                                                $totalprocesob = $totalprocesob + 1;
                                            } elseif ($contadorcb >= $iniciocaldb and $contadorcb <= $fincaldb) {
                                                echo "<td class='proceso'>" . $resultadocaldb . "</td>";
                                                $totalsatisfactoriob = $totalsatisfactoriob + 1;
                                            }
                                        }
                                        echo "</tr>";
                                        $propreiniciob = round((($totalpreiniciob * 100) / $nrob), 1);
                                        $poriniciob = round((($totaliniciob * 100) / $nrob), 1);
                                        $porprocesob = round((($totalprocesob * 100) / $nrob), 1);
                                        $porsatisfactoriob = round((($totalsatisfactoriob * 100) / $nrob), 1);
                                    }
                                    ?>

                                
                                </table>

                                <table class="table table-sm table-bordered  table-striped table-hover ">
                                    <thead>
                                        <tr style="background-color:#3a3a3a; color:#ffffff">
                                            <th>NIVEL DE LOGRO</th>
                                            <th>NUMERO</th>
                                            <th>PORCENTAJE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <TR>

                                            <TD><?php echo $resultadocalab; ?></TD>
                                            <td>
                                                <?PHP echo $totalpreiniciob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $propreiniciob . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalbb; ?></TD>
                                            <td>
                                                <?PHP echo $totaliniciob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $poriniciob . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalcb; ?></TD>
                                            <td>
                                                <?PHP echo $totalprocesob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porprocesob . "%"; ?>
                                            </td>
                                        </TR>

                                        <?php if ($resultadocaldb != '') {  ?>
                                            <TR>
                                                <TD><?php echo $resultadocaldb; ?></TD>
                                                <td>
                                                    <?PHP echo $totalsatisfactoriob; ?>
                                                </td>
                                                <td>
                                                    <?PHP echo $porsatisfactoriob . "%"; ?>
                                                </td>
                                            </TR>

                                        <?php }
                                        ?>
                                        <TR style="background-color:#3a3a3a; color:#ffffff">
                                            <TD>TOTAL</TD>
                                            <?PHP
                                            $totalconsib = $totaliniciob + $totalprocesob + $totalsatisfactoriob + $totalpreiniciob;
                                            $portotalconsib = $poriniciob + $porprocesob + $porsatisfactoriob + $propreiniciob;
                                            ?>
                                            <td>
                                                <?PHP echo $totalconsib; ?>
                                            </td>
                                            <td>
                                                <?PHP echo round($portotalconsib) . "%"; ?>
                                            </td>
                                        </TR>
                                    </tbody>
                                </table>


                                <?php } ?>


                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                .:: COMPARAR
                            </button>
                        </h2>
                    </div>

                    <?php if ($contabilizar == 0) {

include "batosblanco.php";

                    } else {
                    ?>

                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div id="chart_div" width="100%"></div>
                                <div id="chart_divv" width="100%"></div>

                                <!------------------------------------------------------- Comparacion de Ambos--------------------------------------------------------->

                                <table class="table table-sm table-bordered  table-striped table-hover ">
                                    <thead>
                                        <tr style="background-color:#3a3a3a; color:#ffffff">
                                            <th>NIVEL DE LOGRO</th>
                                            <th colspan="2"><?php echo $evaluacioninicial; ?></th>
                                            <th colspan="2"><?php echo $evaluacionfinal; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <TR>

                                            <TD><?php echo $resultadocala; ?></TD>
                                            <td>
                                                <?PHP echo $totalpreinicio; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $propreinicio . "%"; ?>
                                            </td>


                                            <td>
                                                <?PHP echo $totalpreiniciob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $propreiniciob . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalb; ?></TD>
                                            <td>
                                                <?PHP echo $totalinicio; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porinicio . "%"; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $totaliniciob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $poriniciob . "%"; ?>
                                            </td>
                                        </TR>
                                        <TR>
                                            <TD><?php echo $resultadocalc; ?></TD>
                                            <td>
                                                <?PHP echo $totalproceso; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porproceso . "%"; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $totalprocesob; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $porprocesob . "%"; ?>
                                            </td>
                                        </TR>

                                        <?php if ($resultadocald != '') {  ?>
                                            <TR>
                                                <TD><?php echo $resultadocald; ?></TD>
                                                <td>
                                                    <?PHP echo $totalsatisfactorio; ?>
                                                </td>
                                                <td>
                                                    <?PHP echo $porsatisfactorio . "%"; ?>
                                                </td>
                                                <td>
                                                    <?PHP echo $totalsatisfactoriob; ?>
                                                </td>
                                                <td>
                                                    <?PHP echo $porsatisfactoriob . "%"; ?>
                                                </td>
                                            </TR>

                                        <?php }
                                        ?>
                                        <TR style="background-color:#3a3a3a; color:#ffffff">
                                            <TD>TOTAL</TD>

                                            <td>
                                                <?PHP echo $totalconsi; ?>
                                            </td>
                                            <td>
                                                <?PHP echo round($portotalconsi) . "%"; ?>
                                            </td>
                                            <td>
                                                <?PHP echo $totalconsib; ?>
                                            </td>
                                            <td>
                                                <?PHP echo round($portotalconsib) . "%"; ?>
                                            </td>
                                        </TR>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php

                    }
                    ?>

                </div>
            </div>
        </div>
        </div>

        <!------------------------------------------------------- Comparacion de Ambos--------------------------------------------------------->
        <SCRIpt>
            google.charts.load("current", {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Preguntas', '<?php echo $evaluacioninicial ;?>', '<?php echo  $evaluacionfinal;?>', ],
                    ['<?php echo $resultadocala; ?>', <?php echo $totalpreinicio; ?>, <?php echo $totalpreiniciob; ?>, ],
                    ['<?php echo $resultadocalb; ?>', <?php echo $totalinicio; ?>, <?php echo $totaliniciob; ?>, ],
                    ['<?php echo $resultadocalc; ?>', <?php echo $totalproceso; ?>, <?php echo $totalprocesob; ?>, ],
                    ['<?php echo $resultadocald; ?>', <?php echo $totalsatisfactorio; ?>, <?php echo $totalsatisfactoriob; ?>, ]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2,
                    {
                        calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation"
                    },

                ]);
                var options = {
                    bar: {
                        groupWidth: "90%"
                    },

                    legend: {
                        position: 'top',
                        alignment: 'start'
                    },
                    chartArea: {
                        'width': '95%'
                    },
                    fontSize: 14,
                }
                var chart_div = document.getElementById('chart_div');
                var charte = new google.visualization.ColumnChart(chart_div);
                google.visualization.events.addListener(charte, 'ready', function() {
                    document.getElementById('imagena').value = charte.getImageURI();

                    document.getElementById('texta1').value = '<?php echo $resultadocala; ?>';
                    document.getElementById('respa1').value = <?php echo $totalpreinicio; ?>;
                    document.getElementById('pora1').value = <?php echo $propreinicio; ?>;
                    document.getElementById('respa2').value = <?php echo $totalpreiniciob; ?>;
                    document.getElementById('pora2').value = <?php echo $propreiniciob; ?>;

                    document.getElementById('texta11').value = '<?php echo $resultadocalb; ?>';
                    document.getElementById('respa11').value = <?php echo $totalinicio; ?>;
                    document.getElementById('pora11').value = <?php echo $porinicio; ?>;
                    document.getElementById('respa21').value = <?php echo $totaliniciob; ?>;
                    document.getElementById('pora21').value = <?php echo $poriniciob; ?>;

                    document.getElementById('texta12').value = '<?php echo $resultadocalc; ?>';
                    document.getElementById('respa12').value = <?php echo $totalproceso; ?>;
                    document.getElementById('pora12').value = <?php echo $porproceso; ?>;
                    document.getElementById('respa22').value = <?php echo $totalprocesob; ?>;
                    document.getElementById('pora22').value = <?php echo $porprocesob; ?>;


                    document.getElementById('sumatoriofinacf').value = <?php echo $totalconsi; ?>;
                    document.getElementById('porcenajefinalcf').value = <?php echo  $portotalconsi; ?>;

                    document.getElementById('sumatoriofinacfc').value = <?php echo $totalconsib; ?>;
                    document.getElementById('porcenajefinalcfc').value = <?php echo  $portotalconsib; ?>;


                    var dat = <?php echo $totalsatisfactorio; ?>;
                    if (dat == 0) {

                        document.getElementById('text4').value = '';
                        document.getElementById('resp14').value = '';
                        document.getElementById('pord14').value = '';
                        document.getElementById('resp24').value = '';
                        document.getElementById('pord24').value = '';

                    } else {

                        document.getElementById('text4').value = '<?php echo $resultadocald; ?>';
                        document.getElementById('resp14').value = <?php echo $totalsatisfactorio; ?>;
                        document.getElementById('pord14').value = <?php echo $porsatisfactorio; ?>;
                        document.getElementById('resp24').value = <?php echo $totalsatisfactoriob ?>;
                        document.getElementById('pord24').value = <?php echo $porsatisfactoriob; ?>;

                    }


                });

                charte.draw(view, options);



            }
        </SCRIpt>

        <SCRIpt>
            google.charts.load("current", {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Preguntas %', '<?php echo $evaluacioninicial ;?> %', '<?php echo  $evaluacionfinal;?> %',],
                    ['<?php echo $resultadocala; ?>', <?php echo $propreinicio; ?>, <?php echo $propreiniciob; ?>, ],
                    ['<?php echo $resultadocalb; ?>', <?php echo $porinicio; ?>, <?php echo $poriniciob; ?>, ],
                    ['<?php echo $resultadocalc; ?>', <?php echo $porproceso; ?>, <?php echo $porprocesob; ?>, ],
                    ['<?php echo $resultadocald; ?>', <?php echo $porsatisfactorio; ?>, <?php echo $porsatisfactoriob; ?>, ]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2,
                    {
                        calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation"
                    },

                ]);
                var options = {
                    bar: {
                        groupWidth: "90%"
                    },

                    legend: {
                        position: 'top',
                        alignment: 'start'
                    },
                    chartArea: {
                        'width': '95%'
                    },
                    fontSize: 14,
                }
                var chart_divv = document.getElementById('chart_divv');
                var chartev = new google.visualization.ColumnChart(chart_divv);

                // Wait for the chart to finish drawing before calling the getImageURI() method.
                google.visualization.events.addListener(chartev, 'ready', function() {
                    document.getElementById('imagenb').value = chartev.getImageURI();
                });
                chartev.draw(view, options);
            }
        </SCRIpt>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
?>