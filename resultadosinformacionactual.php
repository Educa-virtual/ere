<?php session_start();
if ($_SESSION["dni"] == '' || !isset($_SESSION["dni"]))
    header("location:index.php");
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
        $evaluaci = $_POST['evaluaci'];

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
        $cursodesnrq = $asistencia->mostracolegio($ie);
        while ($mascuwq = mysqli_fetch_array($cursodesnrq)) {
            $desies = $mascuwq['descripcion'];
        }

        //-----------------Extraer Datos de Matriz-------------------------------

        for ($i = 1; $i <= 20; $i++) {

            $matrist1 = $asistencia->matrisres($curso, $grado, $nivel, $i, $evaluaci);
            while ($maser1 = mysqli_fetch_array($matrist1)) {
                $demoab1[$i] = $maser1['clave'];
                $nivel1a[$i] = $maser1['nivelp'];
                $competencia1a[$i] = $maser1['competencia'];
                $desempeno1a[$i] = $maser1['desempeno'];
                $items1[$i] = $maser1['item'];
                $estado1[$i] = $maser1['estado'];
            }
        }

        //-----------------FIN Extraer Datos de Matriz-------------------------------


        //----------------- fin Revisar su USO--------------------------------------------------------------
        ?>

        <br>

        <form action="pdfresultadosinformacion.php" method="post">
            <input type="hidden" id="variable" name="imagena">
            <input type='hidden' id='variableR' name='variableR'>


            <input type='hidden' id='textaf' name='textaf'>
            <input type='hidden' id='respaf' name='respaf'>
            <input type='hidden' id='poraf' name='poraf'>


            <input type='hidden' id='textbf' name='textbf'>
            <input type='hidden' id='respbf' name='respbf'>
            <input type='hidden' id='porbf' name='porbf'>


            <input type='hidden' id='textcf' name='textcf'>
            <input type='hidden' id='respcf' name='respcf'>
            <input type='hidden' id='porcf' name='porcf'>

            <input type='hidden' id='textdf' name='textdf'>
            <input type='hidden' id='respdf' name='respdf'>
            <input type='hidden' id='pordf' name='pordf'>

            <input type='hidden' id='sumatoriofinacf' name='sumatoriofinacf'>
            <input type='hidden' id='porcenajefinalcf' name='porcenajefinalcf'>


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
            <input type="hidden" value="<?php echo $evaluaci; ?>" name="evaluaci">



            <?php
            $asistenciacon = $asistencia->contarconsultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $evaluaci);
            while ($asiy = mysqli_fetch_array($asistenciacon)) {
                $contabilizar = $asiy[0];
            }
            if ($contabilizar == 0) {
                echo "<center><img src='imagen/bloquear.png'><br><h2 style='color:red;'>No hay datos a Procesar...</h2><br><i class='fa fa-users-slash'></i></center>";
            } else {
            ?>



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

            <div class="row">
                <div class="col-8">
                    <center>
                        <div id="piechart" style="width: 700px; height:400px;"></div>
                    </center>
                </div>
                <div class="col-4 justify-content-start">

                    <!--------------------------------------------- Resultado en Pantalla--------------------------------------------->
                    
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
                                <Td>
                                    <div id="texta"></div>
                                </td>
                                <td>
                                    <div id="respa"></div>
                                </td>
                                <td>
                                    <div id="pora"></div>
                                </td>
                            </TR>

                            <TR>
                                <Td>
                                    <div id="textb"></div>
                                </td>
                                <td>
                                    <div id="respb"></div>
                                </td>
                                <td>
                                    <div id="porb"></div>
                                </td>
                            </TR>

                            <TR>
                                <Td>
                                    <div id="textc"></div>
                                </td>
                                <td>
                                    <div id="respc"></div>
                                </td>
                                <td>
                                    <div id="porc"></div>
                                </td>
                            </TR>

                            <TR>
                                <Td>
                                    <div id="textd"></div>
                                </td>
                                <td>
                                    <div id="respd"></div>
                                </td>
                                <td>
                                    <div id="pord"></div>
                                </td>
                            </TR>


                            <TR>
                                <Td> Total</td>
                                <td>
                                    <div id="sumatoriofinac"></div>
                                </td>
                                <td>
                                    <div id="porcenajefinalc"></div>
                                </td>
                            </TR>

                        </tbody>
                    </table>
                    <!------------------------------------------------ Fin  Resultado en Pantalla -------------------------------------->
                </div>
            </div>

            
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

                    $nro = 0;
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

                    //--------------------------FIn Nuevos Contadores--------------------


                    $datoscalculo = $asistencia->calculoindicador($evaluaci, $curso, $grado, $nivel);
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

                    $asistencia = $asistencia->consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $evaluaci);
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
                <BR>
                <table class="table table-sm table-bordered  table-striped table-hover ">
                    <thead>
                        <tr class="tablatitulor">
                            <th scope="col" width="200">ITEMS</th>
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

                        </tr>
                    </thead>
                    <tbody class="tablacontenidor">
                        <tr>
                            <td>Nivel</td>
                            <?php
                            for ($ii = 1; $ii <= 20; $ii++) {
                            ?>

                                <td><?php echo $nivel1a[$ii]; ?></td>
                            <?php
                            }
                            ?>

                        </tr>

                        <tr>
                            <td>Nro Aciertos</td>
                            <td><?php echo $sumador1; ?></td>
                            <td><?php echo $sumador2; ?></td>
                            <td><?php echo $sumador3; ?></td>
                            <td><?php echo $sumador4; ?></td>
                            <td><?php echo $sumador5; ?></td>
                            <td><?php echo $sumador6; ?></td>
                            <td><?php echo $sumador7; ?></td>
                            <td><?php echo $sumador8; ?></td>
                            <td><?php echo $sumador9; ?></td>
                            <td><?php echo $sumador10; ?></td>
                            <td><?php echo $sumador11; ?></td>
                            <td><?php echo $sumador12; ?></td>
                            <td><?php echo $sumador13; ?></td>
                            <td><?php echo $sumador14; ?></td>
                            <td><?php echo $sumador15; ?></td>
                            <td><?php echo $sumador16; ?></td>
                            <td><?php echo $sumador17; ?></td>
                            <td><?php echo $sumador18; ?></td>
                            <td><?php echo $sumador19; ?></td>
                            <td><?php echo $sumador20; ?></td>
                        </tr>
                        <tr>
                            <td>Nro Desaciertos</td>
                            <td><?php echo $incorrecto1; ?></td>
                            <td><?php echo $incorrecto2; ?></td>
                            <td><?php echo $incorrecto3; ?></td>
                            <td><?php echo $incorrecto4; ?></td>
                            <td><?php echo $incorrecto5; ?></td>
                            <td><?php echo $incorrecto6; ?></td>
                            <td><?php echo $incorrecto7; ?></td>
                            <td><?php echo $incorrecto8; ?></td>
                            <td><?php echo $incorrecto9; ?></td>
                            <td><?php echo $incorrecto10; ?></td>
                            <td><?php echo $incorrecto11; ?></td>
                            <td><?php echo $incorrecto12; ?></td>
                            <td><?php echo $incorrecto13; ?></td>
                            <td><?php echo $incorrecto14; ?></td>
                            <td><?php echo $incorrecto15; ?></td>
                            <td><?php echo $incorrecto16; ?></td>
                            <td><?php echo $incorrecto17; ?></td>
                            <td><?php echo $incorrecto18; ?></td>
                            <td><?php echo $incorrecto19; ?></td>
                            <td><?php echo $incorrecto20; ?></td>
                        </tr>
                        <tr>
                            <td>Nro Blancos</td>
                            <td><?php echo $blanco1; ?></td>
                            <td><?php echo $blanco2; ?></td>
                            <td><?php echo $blanco3; ?></td>
                            <td><?php echo $blanco4; ?></td>
                            <td><?php echo $blanco5; ?></td>
                            <td><?php echo $blanco6; ?></td>
                            <td><?php echo $blanco7; ?></td>
                            <td><?php echo $blanco8; ?></td>
                            <td><?php echo $blanco9; ?></td>
                            <td><?php echo $blanco10; ?></td>
                            <td><?php echo $blanco11; ?></td>
                            <td><?php echo $blanco12; ?></td>
                            <td><?php echo $blanco13; ?></td>
                            <td><?php echo $blanco14; ?></td>
                            <td><?php echo $blanco15; ?></td>
                            <td><?php echo $blanco16; ?></td>
                            <td><?php echo $blanco17; ?></td>
                            <td><?php echo $blanco18; ?></td>
                            <td><?php echo $blanco19; ?></td>
                            <td><?php echo $blanco20; ?></td>
                        </tr>
                        <tr>
                            <td>% Aciertos</td>
                            <?php
                            $decimal = 1;
                            ?>
                            <td><?php $porcentaje1r = round((($sumador1 * 100) / $nro), $decimal);
                                echo $porcentaje1r . "%"; ?></td>
                            <td><?php $porcentaje2r = round((($sumador2 * 100) / $nro), $decimal);
                                echo $porcentaje2r . "%"; ?></td>
                            <td><?php $porcentaje3r = round((($sumador3 * 100) / $nro), $decimal);
                                echo $porcentaje3r . "%"; ?></td>
                            <td><?php $porcentaje4r = round((($sumador4 * 100) / $nro), $decimal);
                                echo $porcentaje4r . "%"; ?></td>
                            <td><?php $porcentaje5r = round((($sumador5 * 100) / $nro), $decimal);
                                echo $porcentaje5r . "%"; ?></td>
                            <td><?php $porcentaje6r = round((($sumador6 * 100) / $nro), $decimal);
                                echo $porcentaje6r . "%"; ?></td>
                            <td><?php $porcentaje7r = round((($sumador7 * 100) / $nro), $decimal);
                                echo $porcentaje7r . "%"; ?></td>
                            <td><?php $porcentaje8r = round((($sumador8 * 100) / $nro), $decimal);
                                echo $porcentaje8r . "%"; ?></td>
                            <td><?php $porcentaje9r = round((($sumador9 * 100) / $nro), $decimal);
                                echo $porcentaje9r . "%"; ?></td>
                            <td><?php $porcentaje10r = round((($sumador10 * 100) / $nro), $decimal);
                                echo $porcentaje10r . "%"; ?></td>
                            <td><?php $porcentaje11r = round((($sumador11 * 100) / $nro), $decimal);
                                echo $porcentaje11r . "%"; ?></td>
                            <td><?php $porcentaje12r = round((($sumador12 * 100) / $nro), $decimal);
                                echo $porcentaje12r . "%"; ?></td>
                            <td><?php $porcentaje13r = round((($sumador13 * 100) / $nro), $decimal);
                                echo $porcentaje13r . "%"; ?></td>
                            <td><?php $porcentaje14r = round((($sumador14 * 100) / $nro), $decimal);
                                echo $porcentaje14r . "%"; ?></td>
                            <td><?php $porcentaje15r = round((($sumador15 * 100) / $nro), $decimal);
                                echo $porcentaje15r . "%"; ?></td>
                            <td><?php $porcentaje16r = round((($sumador16 * 100) / $nro), $decimal);
                                echo $porcentaje16r . "%"; ?></td>
                            <td><?php $porcentaje17r = round((($sumador17 * 100) / $nro), $decimal);
                                echo $porcentaje17r . "%"; ?></td>
                            <td><?php $porcentaje18r = round((($sumador18 * 100) / $nro), $decimal);
                                echo $porcentaje18r . "%"; ?></td>
                            <td><?php $porcentaje19r = round((($sumador19 * 100) / $nro), $decimal);
                                echo $porcentaje19r . "%"; ?></td>
                            <td><?php $porcentaje20r = round((($sumador20 * 100) / $nro), $decimal);
                                echo $porcentaje20r . "%"; ?></td>
                        </tr>
                        <tr>
                            <td>% Desaciertos</td>

                            <td><?php $porcentajed1r = round((($incorrecto1 * 100) / $nro), $decimal);
                                echo $porcentajed1r . "%"; ?></td>
                            <td><?php $porcentajed2r = round((($incorrecto2 * 100) / $nro), $decimal);
                                echo $porcentajed2r . "%"; ?></td>
                            <td><?php $porcentajed3r = round((($incorrecto3 * 100) / $nro), $decimal);
                                echo $porcentajed3r . "%"; ?></td>
                            <td><?php $porcentajed4r = round((($incorrecto4 * 100) / $nro), $decimal);
                                echo $porcentajed4r . "%"; ?></td>
                            <td><?php $porcentajed5r = round((($incorrecto5 * 100) / $nro), $decimal);
                                echo $porcentajed5r . "%"; ?></td>
                            <td><?php $porcentajed6r = round((($incorrecto6 * 100) / $nro), $decimal);
                                echo $porcentajed6r . "%"; ?></td>
                            <td><?php $porcentajed7r = round((($incorrecto7 * 100) / $nro), $decimal);
                                echo $porcentajed7r . "%"; ?></td>
                            <td><?php $porcentajed8r = round((($incorrecto8 * 100) / $nro), $decimal);
                                echo $porcentajed8r . "%"; ?></td>
                            <td><?php $porcentajed9r = round((($incorrecto9 * 100) / $nro), $decimal);
                                echo $porcentajed9r . "%"; ?></td>
                            <td><?php $porcentajed10r = round((($incorrecto10 * 100) / $nro), $decimal);
                                echo $porcentajed10r . "%"; ?></td>
                            <td><?php $porcentajed11r = round((($incorrecto11 * 100) / $nro), $decimal);
                                echo $porcentajed11r . "%"; ?></td>
                            <td><?php $porcentajed12r = round((($incorrecto12 * 100) / $nro), $decimal);
                                echo $porcentajed12r . "%"; ?></td>
                            <td><?php $porcentajed13r = round((($incorrecto13 * 100) / $nro), $decimal);
                                echo $porcentajed13r . "%"; ?></td>
                            <td><?php $porcentajed14r = round((($incorrecto14 * 100) / $nro), $decimal);
                                echo $porcentajed14r . "%"; ?></td>
                            <td><?php $porcentajed15r = round((($incorrecto15 * 100) / $nro), $decimal);
                                echo $porcentajed15r . "%"; ?></td>
                            <td><?php $porcentajed16r = round((($incorrecto16 * 100) / $nro), $decimal);
                                echo $porcentajed16r . "%"; ?></td>
                            <td><?php $porcentajed17r = round((($incorrecto17 * 100) / $nro), $decimal);
                                echo $porcentajed17r . "%"; ?></td>
                            <td><?php $porcentajed18r = round((($incorrecto18 * 100) / $nro), $decimal);
                                echo $porcentajed18r . "%"; ?></td>
                            <td><?php $porcentajed19r = round((($incorrecto19 * 100) / $nro), $decimal);
                                echo $porcentajed19r . "%"; ?></td>
                            <td><?php $porcentajed20r = round((($incorrecto20 * 100) / $nro), $decimal);
                                echo $porcentajed20r . "%"; ?></td>

                        </tr>
                        <tr>
                            <td>% Blancos</td>
                            <td><?php $porcentajed1b = round((($blanco1 * 100) / $nro), $decimal);
                                echo $porcentajed1b . "%"; ?></td>
                            <td><?php $porcentajed2b = round((($blanco2 * 100) / $nro), $decimal);
                                echo $porcentajed2b . "%"; ?></td>
                            <td><?php $porcentajed3b = round((($blanco3 * 100) / $nro), $decimal);
                                echo $porcentajed3b . "%"; ?></td>
                            <td><?php $porcentajed4b = round((($blanco4 * 100) / $nro), $decimal);
                                echo $porcentajed4b . "%"; ?></td>
                            <td><?php $porcentajed5b = round((($blanco5 * 100) / $nro), $decimal);
                                echo $porcentajed5b . "%"; ?></td>
                            <td><?php $porcentajed6b = round((($blanco6 * 100) / $nro), $decimal);
                                echo $porcentajed6b . "%"; ?></td>
                            <td><?php $porcentajed7b = round((($blanco7 * 100) / $nro), $decimal);
                                echo $porcentajed7b . "%"; ?></td>
                            <td><?php $porcentajed8b = round((($blanco8 * 100) / $nro), $decimal);
                                echo $porcentajed8b . "%"; ?></td>
                            <td><?php $porcentajed9b = round((($blanco9 * 100) / $nro), $decimal);
                                echo $porcentajed9b . "%"; ?></td>
                            <td><?php $porcentajed10b = round((($blanco10 * 100) / $nro), $decimal);
                                echo $porcentajed10b . "%"; ?></td>
                            <td><?php $porcentajed11b = round((($blanco11 * 100) / $nro), $decimal);
                                echo $porcentajed11b . "%"; ?></td>
                            <td><?php $porcentajed12b = round((($blanco12 * 100) / $nro), $decimal);
                                echo $porcentajed12b . "%"; ?></td>
                            <td><?php $porcentajed13b = round((($blanco13 * 100) / $nro), $decimal);
                                echo $porcentajed13b . "%"; ?></td>
                            <td><?php $porcentajed14b = round((($blanco14 * 100) / $nro), $decimal);
                                echo $porcentajed14b . "%"; ?></td>
                            <td><?php $porcentajed15b = round((($blanco15 * 100) / $nro), $decimal);
                                echo $porcentajed15b . "%"; ?></td>
                            <td><?php $porcentajed16b = round((($blanco16 * 100) / $nro), $decimal);
                                echo $porcentajed16b . "%"; ?></td>
                            <td><?php $porcentajed17b = round((($blanco17 * 100) / $nro), $decimal);
                                echo $porcentajed17b . "%"; ?></td>
                            <td><?php $porcentajed18b = round((($blanco18 * 100) / $nro), $decimal);
                                echo $porcentajed18b . "%"; ?></td>
                            <td><?php $porcentajed19b = round((($blanco19 * 100) / $nro), $decimal);
                                echo $porcentajed19b . "%"; ?></td>
                            <td><?php $porcentajed20b = round((($blanco20 * 100) / $nro), $decimal);
                                echo $porcentajed20b . "%"; ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div id="chart_div" width="100%"></div>
                <br>


                <table class="table table-sm table-bordered  table-striped table-hover ">
                    <thead>
                        <tr class="tablatitulor">
                            <th scope="col">COMPETENCIA</th>
                            <th scope="col">ITEM</th>
                            <th scope="col">DESEMPEÑOS</th>
                            <th scope="col">N° <br>ACIERTOS</th>
                            <th scope="col">N° <br>DESACIERTOS</th>
                            <th scope="col">% <br>ACIERTOS</th>
                            <th scope="col">% <br>DESACIERTOS</th>

                        </tr>
                    </thead>
                    <tbody class="tablacontenido">

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[1]; ?>
                            </td>
                            <td><?php echo  $items1[1]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[1]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador1; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto1 = $incorrecto1 + $blanco1;
                                echo $totalincorrecto1; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje1r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco1 = 100 - $porcentaje1r;
                                echo $totalporinco1 . "%"; ?>
                            </td>

                        </tr>


                        <tr>
                            <td>
                                <?PHP echo $competencia1a[2]; ?>
                            </td>
                            <td><?php echo  $items1[2]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[2]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador2; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto2 = $incorrecto2 + $blanco2;
                                echo $totalincorrecto2; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje2r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco2 = 100 - $porcentaje2r;
                                echo $totalporinco2 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[3]; ?>
                            </td>
                            <td><?php echo  $items1[3]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[3]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador3; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto3 = $incorrecto3 + $blanco3;
                                echo $totalincorrecto3; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje3r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco3 = 100 - $porcentaje3r;
                                echo $totalporinco3 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[4]; ?>
                            </td>
                            <td><?php echo  $items1[4]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[4]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador4; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto4 = $incorrecto4 + $blanco4;
                                echo $totalincorrecto4; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje4r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco4 = 100 - $porcentaje4r;
                                echo $totalporinco4 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[5]; ?>
                            </td>
                            <td><?php echo  $items1[5]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[5]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador5; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto5 = $incorrecto5 + $blanco5;
                                echo $totalincorrecto5; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje5r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco5 = 100 - $porcentaje5r;
                                echo $totalporinco5 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[6]; ?>
                            </td>
                            <td><?php echo  $items1[6]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[6]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador6; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto6 = $incorrecto6 + $blanco6;
                                echo $totalincorrecto6; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje6r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco6 = 100 - $porcentaje6r;
                                echo $totalporinco6 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[7]; ?>
                            </td>
                            <td><?php echo  $items1[7]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[7]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador7; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto7 = $incorrecto7 + $blanco7;
                                echo $totalincorrecto7; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje7r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco7 = 100 - $porcentaje7r;
                                echo $totalporinco7 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[8]; ?>
                            </td>
                            <td><?php echo  $items1[8]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[8]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador8; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto8 = $incorrecto8 + $blanco8;
                                echo $totalincorrecto8; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje8r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco8 = 100 - $porcentaje8r;
                                echo $totalporinco8 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[9]; ?>
                            </td>
                            <td><?php echo  $items1[9]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[9]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador9; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto9 = $incorrecto9 + $blanco9;
                                echo $totalincorrecto9; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje9r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco9 = 100 - $porcentaje9r;
                                echo $totalporinco9 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[10]; ?>
                            </td>
                            <td><?php echo  $items1[10]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[10]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador10; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto10 = $incorrecto10 + $blanco10;
                                echo $totalincorrecto10; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje10r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco10 = 100 - $porcentaje10r;
                                echo $totalporinco10 . "%"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?PHP echo $competencia1a[11]; ?>
                            </td>
                            <td><?php echo  $items1[11]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[11]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador11; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto11 = $incorrecto11 + $blanco11;
                                echo $totalincorrecto11; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje11r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco11 = 100 - $porcentaje11r;
                                echo $totalporinco11 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[12]; ?>
                            </td>
                            <td><?php echo  $items1[12]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[12]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador11; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto12 = $incorrecto12 + $blanco12;
                                echo $totalincorrecto12; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje12r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco12 = 100 - $porcentaje12r;
                                echo $totalporinco12 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[13]; ?>
                            </td>
                            <td><?php echo  $items1[13]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[13]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador13; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto13 = $incorrecto13 + $blanco13;
                                echo $totalincorrecto13; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje13r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco13 = 100 - $porcentaje13r;
                                echo $totalporinco13 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[14]; ?>
                            </td>
                            <td><?php echo  $items1[14]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[14]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador14; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto14 = $incorrecto14 + $blanco14;
                                echo $totalincorrecto14; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje14r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco14 = 100 - $porcentaje14r;
                                echo $totalporinco14 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[15]; ?>
                            </td>
                            <td><?php echo  $items1[15]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[15]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador15; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto15 = $incorrecto15 + $blanco15;
                                echo $totalincorrecto15; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje15r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco15 = 100 - $porcentaje15r;
                                echo $totalporinco15 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[16]; ?>
                            </td>
                            <td><?php echo  $items1[16]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[16]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador16; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto16 = $incorrecto16 + $blanco16;
                                echo $totalincorrecto16; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje16r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco16 = 100 - $porcentaje16r;
                                echo $totalporinco16 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[17]; ?>
                            </td>
                            <td><?php echo  $items1[17]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[17]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador17; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto17 = $incorrecto17 + $blanco17;
                                echo $totalincorrecto17; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje17r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco17 = 100 - $porcentaje17r;
                                echo $totalporinco17 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[18]; ?>
                            </td>
                            <td><?php echo  $items1[18]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[18]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador18; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto18 = $incorrecto18 + $blanco18;
                                echo $totalincorrecto18; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje18r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco18 = 100 - $porcentaje18r;
                                echo $totalporinco18 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[19]; ?>
                            </td>
                            <td><?php echo  $items1[19]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[19]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador19; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto19 = $incorrecto19 + $blanco19;
                                echo $totalincorrecto19; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje19r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco19 = 100 - $porcentaje19r;
                                echo $totalporinco19 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?PHP echo $competencia1a[20]; ?>
                            </td>
                            <td><?php echo  $items1[20]; ?></td>
                            <td>
                                <?PHP echo $desempeno1a[20]; ?>
                            </td>
                            <td>
                                <?PHP echo $sumador20; ?>
                            </td>
                            <td>
                                <?PHP
                                $totalincorrecto20 = $incorrecto20 + $blanco20;
                                echo $totalincorrecto20; ?>
                            </td>
                            <td>
                                <?PHP echo $porcentaje20r . "%"; ?>
                            </td>
                            <td>
                                <?PHP $totalporinco20 = 100 - $porcentaje20r;
                                echo $totalporinco20 . "%"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="tablatitulor colocontenido">
                                <center>TOTAL DE ALUMNOS</center>
                            </td>
                            <td class="tablatitulor colocontenido">
                                <center><?php echo $nro; ?></center>
                            </td>
                        </tr>
                    </tbody>
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






                <table class="table" align="center">
                    <tr style="background-color:#3a3a3a; color:#ffffff; font-size: 40px; font-weight:bolder;">
                        <td>MEDIDA PROMEDIO</td>
                        <?php if ($calinivel == 1) { ?>
                            <td><?php echo round((array_sum($numerosec) / $nro), 2); ?></td>
                        <?php } else { ?>
                            <td><?php echo round((array_sum($numerofr) / $nro), 2); ?></td>
                        <?php } ?>
                    </tr>
                </table>

            <?php
            }
            ?>
        </div>
        </div>

        <script>
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['<?php echo $resultadocala; ?>', <?php echo $totalpreinicio; ?>],
                    ['<?php echo $resultadocalb; ?>', <?php echo $totalinicio; ?>],
                    ['<?php echo $resultadocalc; ?>', <?php echo $totalproceso; ?>],
                    ['<?php echo $resultadocald; ?>', <?php echo $totalsatisfactorio; ?>],

                ]);

                var options = {
                    title: 'Nivel de Logro',
                    pieStartAngle: 95,
                    fontSize: 11
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);

                document.getElementById('variable').value = chart.getImageURI();


                document.getElementById('texta').innerHTML = '<?php echo $resultadocala; ?>';
                document.getElementById('respa').innerHTML = <?php echo $totalpreinicio; ?>;
                document.getElementById('pora').innerHTML = <?php echo $propreinicio; ?>;

                document.getElementById('textaf').value = '<?php echo $resultadocala; ?>';
                document.getElementById('respaf').value = <?php echo $totalpreinicio; ?>;
                document.getElementById('poraf').value = <?php echo $propreinicio; ?>;


                document.getElementById('textb').innerHTML = '<?php echo $resultadocalb; ?>';
                document.getElementById('respb').innerHTML = <?php echo $totalinicio; ?>;
                document.getElementById('porb').innerHTML = <?php echo $porinicio; ?>;

                document.getElementById('textbf').value = '<?php echo $resultadocalb; ?>';
                document.getElementById('respbf').value = <?php echo $totalinicio; ?>;
                document.getElementById('porbf').value = <?php echo $porinicio; ?>;


                document.getElementById('textc').innerHTML = '<?php echo $resultadocalc; ?>';
                document.getElementById('respc').innerHTML = <?php echo $totalproceso; ?>;
                document.getElementById('porc').innerHTML = <?php echo $porproceso; ?>;

                document.getElementById('textcf').value = '<?php echo $resultadocalc; ?>';
                document.getElementById('respcf').value = <?php echo $totalproceso; ?>;
                document.getElementById('porcf').value = <?php echo $porproceso; ?>;



                document.getElementById('sumatoriofinac').innerHTML = <?php echo $totalconsi; ?>;
                document.getElementById('sumatoriofinacf').value = <?php echo $totalconsi; ?>;


                document.getElementById('porcenajefinalc').innerHTML = <?php echo  $portotalconsi; ?>;
                document.getElementById('porcenajefinalcf').value = <?php echo  $portotalconsi; ?>;



                var dat = <?php echo $totalsatisfactorio; ?>;
                if (dat == 0) {
                    document.getElementById('textd').innerHTML = '';
                    document.getElementById('respd').innerHTML = '';
                    document.getElementById('pord').innerHTML = '';

                    document.getElementById('textdf').value = '';
                    document.getElementById('respdf').value = '';
                    document.getElementById('pordf').value = '';
                } else {
                    document.getElementById('textd').innerHTML = '<?php echo $resultadocald; ?>';
                    document.getElementById('respd').innerHTML = <?php echo $totalsatisfactorio; ?>;
                    document.getElementById('pord').innerHTML = <?php echo $porsatisfactorio; ?>;

                    document.getElementById('textdf').value = '<?php echo $resultadocald; ?>';
                    document.getElementById('respdf').value = <?php echo $totalsatisfactorio; ?>;
                    document.getElementById('pordf').value = <?php echo $porsatisfactorio; ?>;

                }





            }
        </script>


        <SCRIpt>
            google.charts.load("current", {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Preguntas', '% Aciertos', '% Desaciertos', '% Blancos', ],
                    ['1', <?php echo $porcentaje1r; ?>, <?php echo $porcentajed1r; ?>, <?php echo $porcentajed1b; ?>, ],
                    ['2', <?php echo $porcentaje2r; ?>, <?php echo $porcentajed2r; ?>, <?php echo $porcentajed2b; ?>, ],
                    ['3', <?php echo $porcentaje3r; ?>, <?php echo $porcentajed3r; ?>, <?php echo $porcentajed3b; ?>, ],
                    ['4', <?php echo $porcentaje4r; ?>, <?php echo $porcentajed4r; ?>, <?php echo $porcentajed4b; ?>, ],
                    ['5', <?php echo $porcentaje5r; ?>, <?php echo $porcentajed5r; ?>, <?php echo $porcentajed5b; ?>, ],
                    ['6', <?php echo $porcentaje6r; ?>, <?php echo $porcentajed6r; ?>, <?php echo $porcentajed6b; ?>, ],
                    ['7', <?php echo $porcentaje7r; ?>, <?php echo $porcentajed7r; ?>, <?php echo $porcentajed7b; ?>, ],
                    ['8', <?php echo $porcentaje8r; ?>, <?php echo $porcentajed8r; ?>, <?php echo $porcentajed8b; ?>, ],
                    ['9', <?php echo $porcentaje9r; ?>, <?php echo $porcentajed9r; ?>, <?php echo $porcentajed9b; ?>, ],
                    ['10', <?php echo $porcentaje10r; ?>, <?php echo $porcentajed10r; ?>, <?php echo $porcentajed10b; ?>, ],
                    ['11', <?php echo $porcentaje11r; ?>, <?php echo $porcentajed11r; ?>, <?php echo $porcentajed11b; ?>, ],
                    ['12', <?php echo $porcentaje12r; ?>, <?php echo $porcentajed12r; ?>, <?php echo $porcentajed12b; ?>, ],
                    ['13', <?php echo $porcentaje13r; ?>, <?php echo $porcentajed13r; ?>, <?php echo $porcentajed13b; ?>, ],
                    ['14', <?php echo $porcentaje14r; ?>, <?php echo $porcentajed14r; ?>, <?php echo $porcentajed14b; ?>, ],
                    ['15', <?php echo $porcentaje15r; ?>, <?php echo $porcentajed15r; ?>, <?php echo $porcentajed15b; ?>, ],
                    ['16', <?php echo $porcentaje16r; ?>, <?php echo $porcentajed16r; ?>, <?php echo $porcentajed16b; ?>, ],
                    ['17', <?php echo $porcentaje17r; ?>, <?php echo $porcentajed17r; ?>, <?php echo $porcentajed17b; ?>, ],
                    ['18', <?php echo $porcentaje18r; ?>, <?php echo $porcentajed18r; ?>, <?php echo $porcentajed18b; ?>, ],
                    ['19', <?php echo $porcentaje19r; ?>, <?php echo $porcentajed19r; ?>, <?php echo $porcentajed19b; ?>, ],
                    ['20', <?php echo $porcentaje20r; ?>, <?php echo $porcentajed20r; ?>, <?php echo $porcentajed20b; ?>, ]
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
                    3,
                    {
                        calc: "stringify",
                        sourceColumn: 3,
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
                    fontSize: 9,


                }

                var chart_div = document.getElementById('chart_div');
                var charte = new google.visualization.ColumnChart(chart_div);

                // Wait for the chart to finish drawing before calling the getImageURI() method.
                google.visualization.events.addListener(charte, 'ready', function() {
                    document.getElementById('variableR').value = charte.getImageURI();
                });

                charte.draw(view, options);



            }
        </SCRIpt>






    </body>

    </html>
