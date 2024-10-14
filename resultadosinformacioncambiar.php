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
        <link rel="stylesheet" href="css/disenooptimizado.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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



        $cursodesg = $asistencia->ugelre($ugel);
        while ($mascuf = mysqli_fetch_array($cursodesg)) {
            $desugel = $mascuf['ugeldescripcion'];
        }


        $cursodes = $asistencia->iesareasdes($curso);
        while ($mascu = mysqli_fetch_array($cursodes)) {
            $descurso = $mascu['descripcionarea'];
        }

        $cursodesnrq = $asistencia->mostracolegio($ie);
        while ($mascuwq = mysqli_fetch_array($cursodesnrq)) {
            $desies = $mascuwq['descripcion'];
        }


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



        $desempres1 = $asistencia->validacionma($curso, $competencia1a, $desempeno1a);
        while ($dese1 = mysqli_fetch_array($desempres1)) {
            $de1 = $dese1[1];
        }



        $desempres2 = $asistencia->validacionma($curso, $competencia2a, $desempeno2a);
        while ($dese2 = mysqli_fetch_array($desempres2)) {
            $de2 = $dese2[1];
        }



        ?>

        <br>
        <div class="card">
            <h6 class="card-header">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        .:: <i class="fas fa-download"></i> DATOS
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" target="_new" href="pdfresultadosinformacion.php?ugel=<?php echo $ugel; ?>&gestion=<?php echo $gestion; ?>&zona=<?php echo $zona; ?>&distrito=<?php echo $distrito; ?>&sexo=<?php echo $sexo; ?>&nivel=<?php echo $nivel; ?>&curso=<?php echo $curso; ?>&grado=<?php echo $grado; ?>&seccion=<?php echo $seccion; ?>&ie=<?php echo $ie; ?>&evaluaci=<?php echo $evaluaci; ?>&seleca=<?php echo $seleca; ?>&selecb=<?php echo $selecb; ?>&selecc=<?php echo $selecc; ?>"><i class="fas fa-file-pdf"></i> Descargar en PDF</a>
                        <a class="dropdown-item" target="_new" href="xlsresultadosinformacionconnew.php?ugel=<?php echo $ugel; ?>&gestion=<?php echo $gestion; ?>&zona=<?php echo $zona; ?>&distrito=<?php echo $distrito; ?>&sexo=<?php echo $sexo; ?>&nivel=<?php echo $nivel; ?>&curso=<?php echo $curso; ?>&grado=<?php echo $grado; ?>&seccion=<?php echo $seccion; ?>&ie=<?php echo $ie; ?>&evaluaci=<?php echo $evaluaci; ?>&seleca=<?php echo $seleca; ?>&selecb=<?php echo $selecb; ?>&selecc=<?php echo $selecc; ?>"><i class="fas fa-file-excel"></i> Descargar en Excel</a>
                    </div>
                </div>
            </h6>
            <div class="card-body">

                <div class="alert alert-dark" role="alert">
                    <div class="row" style="font-size: 12px;  text-align: center;">
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

                    <div class="row" style="font-size: 11px;  text-align: center;">
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
                <center>
                    <div id="piechart" style="width: 900px; height:500px;"></div>
                </center>
                <?php
                $asistenciacon = $asistencia->contarconsultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $evaluaci);
                while ($asiy = mysqli_fetch_array($asistenciacon)) {
                    $contabilizar = $asiy[0];
                }
                if ($contabilizar == 0) {
                    echo "<center><h2 style='color:red;'>No hay datos a Procesar...</h2><br><i class='fa fa-users-slash'></i></center>";
                } else {
                ?>


                    <table id="course_table" class="table table-striped table-responsive" style="font-size: 12px;">
                        <thead>
                            <tr class="tablatitulor" id="example" class="display" style="width:100%">
                                <th scope="col">N.</th>
                                <th scope="col">CÓD. MOD.</th>
                                <th scope="col">I.E.</th>
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
                                <th scope="col">N° Blancos</th>
                                <th scope="col">N° aciertos</th>
                                <th scope="col">N° desaciertos</th>
                                <th scope="col">Total</th>
                                <th scope="col">Total Nivel</th>
                                <th scope="col">Nivel</th>
                            </tr>
                        </thead>
                        <?php

                        $nro = 0;

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

                        $cuepre1 = 0;
                        $cuepre2 = 0;
                        $cuepre3 = 0;
                        $cuepre4 = 0;
                        $cuepre5 = 0;
                        $cuepre6 = 0;
                        $cuepre7 = 0;
                        $cuepre8 = 0;
                        $cuepre9 = 0;
                        $cuepre10 = 0;
                        $cuepre11 = 0;
                        $cuepre12 = 0;
                        $cuepre13 = 0;
                        $cuepre14 = 0;
                        $cuepre15 = 0;
                        $cuepre16 = 0;
                        $cuepre17 = 0;
                        $cuepre18 = 0;
                        $cuepre19 = 0;
                        $cuepre20 = 0;

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

                        $total1e = 0;

                        $blanco1v = 0;
                        $blanco2v = 0;
                        $blanco3v = 0;
                        $blanco4v = 0;
                        $blanco5v = 0;
                        $blanco6v = 0;
                        $blanco7v = 0;
                        $blanco8v = 0;
                        $blanco9v = 0;
                        $blanco10v = 0;
                        $blanco11v = 0;
                        $blanco12v = 0;
                        $blanco13v = 0;
                        $blanco14v = 0;
                        $blanco15v = 0;
                        $blanco16v = 0;
                        $blanco17v = 0;
                        $blanco18v = 0;
                        $blanco19v = 0;
                        $blanco20v = 0;

                        $conteoc1 = 0;

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


                        $blancos = 0;

                        $asistencia = $asistencia->consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $evaluaci);
                        while ($asi = mysqli_fetch_array($asistencia)) {
                            $nro = $nro + 1;
                            echo "<tr class='tablacontenidor'>";
                            echo "<td>" . $nro . "</td>";
                            echo "<td>" . $asi['codigomodular'] . "</td>";
                            echo "<td>" . $asi['ie'] . "</td>";
                            echo "<td>" . $asi['distrito'] . "</td>";
                            echo "<td>" . $asi['seccion'] . "</td>";
                            echo "<td>" . $asi['apellidopaterno'] . " " . $asi['apellidomaterno'] . " ; " . $asi['primernombre'] . " " . $asi['segundonombre'] . " " . $asi['tercernombre'] . "</td>";
                            $contarblancos = 0;
                            $contarerrores = 0;
                            $contarcorrectos = 0;
                            $totalniveles = 0;
                            $blancocom = 0;
                            $contmatr = 0;
                            $total1 = 0;
                            $contadofinal = 0;
                            $datoscon = 0;

                            for ($c = 1; $c <= 20; $c++) {

                                if ($estado1[$c] == 1) {
                                    echo "<td class='blanco' >Anular</td>";
                                } else {

                                    $resp = "respuestas" . $c;

                                    if ($asi[$resp] == '') {
                                        $contarblancos = $contarblancos + 1;


                                        $info = array();
                                        $info[$c]=1;

                                       



                                        echo "<td class='blanco' >-</td>";
                                    } else {
                                        if ($asi[$resp] == $demoab1[$c]) {
                                            $contarcorrectos = $contarcorrectos + 1;


                                            $numerost = array($nivel1a[$c]);
                                            foreach ($numerost as $value) {
                                                $totalniveles += $value;
                                            }

                                            echo "<td class='correcto'>" . $asi[$resp] . "</td>";
                                        } else {
                                            $contarerrores = $contarerrores + 1;
                                            echo "<td class='incorrecto'>" . $asi[$resp] . "</td>";
                                        }
                                        $blanco1 = 0;
                                    }
                                }
                                
                            }
                         

                            $totalnuevo = $contarblancos + $contarcorrectos + $contarerrores;

                            echo "<td style='text-align:center;'>" . $contarblancos . "</td>";
                            echo "<td style='text-align:center;'>" .  $contarcorrectos . "</td>";
                            echo "<td style='text-align:center;'>" . $contarerrores . "</td>";
                            echo "<td style='text-align:center;'>" . $totalnuevo . "</td>";
                            echo "<td style='text-align:center;'>" . $totalniveles . "</td>";



                            if ($calinivel == 1) {

                                if ($totalniveles <= $fincala) {
                                    echo "<td class='preinicio'>" . $resultadocala . "</td>";
                                    $totalpreinicio = $totalpreinicio + 1;
                                } elseif ($totalniveles >= $iniciocalb and $totalniveles <= $fincalb) {
                                    echo "<td class='inicio'>" . $resultadocalb . "</td>";
                                    $totalinicio = $totalinicio + 1;
                                } elseif ($totalniveles >= $iniciocalc and $totalniveles <= $fincalc) {
                                    echo "<td class='proceso'>" . $resultadocalc . "</td>";
                                    $totalproceso = $totalproceso + 1;
                                } elseif ($totalniveles >= $iniciocald and $totalniveles <= $fincald) {
                                    echo "<td class='proceso'>" . $resultadocald . "</td>";
                                    $totalsatisfactorio = $totalsatisfactorio + 1;
                                }
                            } else {
                                if ($contarcorrectos <= $fincala) {
                                    echo "<td class='preinicio'>" . $resultadocala . "</td>";
                                    $totalpreinicio = $totalpreinicio + 1;
                                } elseif ($contarcorrectos >= $iniciocalb and $contarcorrectos <= $fincalb) {
                                    echo "<td class='inicio'>" . $resultadocalb . "</td>";
                                    $totalinicio = $totalinicio + 1;
                                } elseif ($contarcorrectos >= $iniciocalc and $contarcorrectos <= $fincalc) {
                                    echo "<td class='proceso'>" . $resultadocalc . "</td>";
                                    $totalproceso = $totalproceso + 1;
                                } elseif ($contarcorrectos >= $iniciocald and $contarcorrectos <= $fincald) {
                                    echo "<td class='proceso'>" . $resultadocald . "</td>";
                                    $totalsatisfactorio = $totalsatisfactorio + 1;
                                }
                            }
                            echo "</tr>";
                        }

                        $sumnarotira=$info[1][4];
                        echo $sumnarotira;

                        $propreinicio = round((($totalpreinicio * 100) / $nro), 1);
                        $porinicio = round((($totalinicio * 100) / $nro), 1);
                        $porproceso = round((($totalproceso * 100) / $nro), 1);
                        $porsatisfactorio = round((($totalsatisfactorio * 100) / $nro), 1);


                        ?>
                    </table>

                    <table class="table table-striped " style="font-size: 12px; font-weight: 700;">
                        <thead>
                            <tr>
                                <th scope="col" width="200">ITEMS</th>

                                <?php

                                $inicio = 1;
                                for ($conres = $inicio; $conres <= 20; $conres++) {

                                    echo "<th scope='col'>" . $conres . "</th>";
                                }

                                ?>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nivel</td>
                                <?php
                                for ($conrest = $inicio; $conrest <= 20; $conrest++) {
                                    echo "<th scope='col'>" . $nivel1a[$conrest] . "</th>";
                                }
                                ?>
                            </tr>

                            <tr>
                                <td>Nro Aciertos</td>

                                <?php
                                for ($conrest = $inicio; $conrest <= 20; $conrest++) {
                                    echo "<th scope='col'>" . $nivel1a[$conrest] . "</th>";
                                }
                                ?>

                                <td><?php echo $total1; ?></td>
                                <td><?php echo $total2; ?></td>
                                <td><?php echo $total3; ?></td>
                                <td><?php echo $total4; ?></td>
                                <td><?php echo $total5; ?></td>
                                <td><?php echo $total6; ?></td>
                                <td><?php echo $total7; ?></td>
                                <td><?php echo $total8; ?></td>
                                <td><?php echo $total9; ?></td>
                                <td><?php echo $total10; ?></td>
                                <td><?php echo $total11; ?></td>
                                <td><?php echo $total12; ?></td>
                                <td><?php echo $total13; ?></td>
                                <td><?php echo $total14; ?></td>
                                <td><?php echo $total15; ?></td>
                                <td><?php echo $total16; ?></td>
                                <td><?php echo $total17; ?></td>
                                <td><?php echo $total18; ?></td>
                                <td><?php echo $total19; ?></td>
                                <td><?php echo $total20; ?></td>
                            </tr>
                            <tr>
                                <td>Nro Desaciertos</td>
                                <td><?php $diferencia1 = $nro - $total1 - $blanco1v;
                                    echo $diferencia1; ?></td>
                                <td><?php $diferencia2 = $nro - $total2 - $blanco2v;
                                    echo $diferencia2; ?></td>
                                <td><?php $diferencia3 = $nro - $total3 - $blanco3v;
                                    echo $diferencia3; ?></td>
                                <td><?php $diferencia4 = $nro - $total4  - $blanco4v;
                                    echo $diferencia4; ?></td>
                                <td><?php $diferencia5 = $nro - $total5 - $blanco5v;
                                    echo $diferencia5; ?></td>
                                <td><?php $diferencia6 = $nro - $total6 - $blanco6v;
                                    echo $diferencia6; ?></td>
                                <td><?php $diferencia7 = $nro - $total7 - $blanco7v;
                                    echo $diferencia7; ?></td>
                                <td><?php $diferencia8 = $nro - $total8 - $blanco8v;
                                    echo $diferencia8; ?></td>
                                <td><?php $diferencia9 = $nro - $total9 - $blanco8v;
                                    echo $diferencia9; ?></td>
                                <td><?php $diferencia10 = $nro - $total10 - $blanco10v;
                                    echo $diferencia10; ?></td>
                                <td><?php $diferencia11 = $nro - $total11 - $blanco11v;
                                    echo $diferencia11; ?></td>
                                <td><?php $diferencia12 = $nro - $total12 - $blanco12v;
                                    echo $diferencia12; ?></td>
                                <td><?php $diferencia13 = $nro - $total13 - $blanco13v;
                                    echo $diferencia13; ?></td>
                                <td><?php $diferencia14 = $nro - $total14 - $blanco14v;
                                    echo $diferencia14; ?></td>
                                <td><?php $diferencia15 = $nro - $total15 - $blanco15v;
                                    echo $diferencia15; ?></td>
                                <td><?php $diferencia16 = $nro - $total16 - $blanco16v;
                                    echo $diferencia16; ?></td>
                                <td><?php $diferencia17 = $nro - $total17 - $blanco17v;
                                    echo $diferencia17; ?></td>
                                <td><?php $diferencia18 = $nro - $total18 - $blanco18v;
                                    echo $diferencia18; ?></td>
                                <td><?php $diferencia19 = $nro - $total19 - $blanco19v;
                                    echo $diferencia19; ?></td>
                                <td><?php $diferencia20 = $nro - $total20 - $blanco20v;
                                    echo $diferencia20; ?></td>
                            </tr>
                            <tr>
                                <td>Nro Blancos</td>
                                <td><?php echo $blanco1v; ?></td>
                                <td><?php echo $blanco2v; ?></td>
                                <td><?php echo $blanco3v; ?></td>
                                <td><?php echo $blanco4v; ?></td>
                                <td><?php echo $blanco5v; ?></td>
                                <td><?php echo $blanco6v; ?></td>
                                <td><?php echo $blanco7v; ?></td>
                                <td><?php echo $blanco8v; ?></td>
                                <td><?php echo $blanco9v; ?></td>
                                <td><?php echo $blanco10v; ?></td>
                                <td><?php echo $blanco11v; ?></td>
                                <td><?php echo $blanco12v; ?></td>
                                <td><?php echo $blanco13v; ?></td>
                                <td><?php echo $blanco14v; ?></td>
                                <td><?php echo $blanco15v; ?></td>
                                <td><?php echo $blanco16v; ?></td>
                                <td><?php echo $blanco17v; ?></td>
                                <td><?php echo $blanco18v; ?></td>
                                <td><?php echo $blanco19v; ?></td>
                                <td><?php echo $blanco20v; ?></td>

                            </tr>
                            <tr>
                                <td>% Aciertos</td>
                                <td><?php $porcentaje1 = ($total1 * 100) / $nro;
                                    echo round($porcentaje1, 1) . "%"; ?></td>
                                <td><?php $porcentaje2 = ($total2 * 100) / $nro;
                                    echo round($porcentaje2, 1) . "%"; ?></td>
                                <td><?php $porcentaje3 = ($total3 * 100) / $nro;
                                    echo round($porcentaje3, 1) . "%"; ?></td>
                                <td><?php $porcentaje4 = ($total4 * 100) / $nro;
                                    echo round($porcentaje4, 1) . "%"; ?></td>
                                <td><?php $porcentaje5 = ($total5 * 100) / $nro;
                                    echo round($porcentaje5, 1) . "%"; ?></td>
                                <td><?php $porcentaje6 = ($total6 * 100) / $nro;
                                    echo round($porcentaje6, 1) . "%"; ?></td>
                                <td><?php $porcentaje7 = ($total7 * 100) / $nro;
                                    echo round($porcentaje7, 1) . "%"; ?></td>
                                <td><?php $porcentaje8 = ($total8 * 100) / $nro;
                                    echo round($porcentaje8, 1) . "%"; ?></td>
                                <td><?php $porcentaje9 = ($total9 * 100) / $nro;
                                    echo round($porcentaje9, 1) . "%"; ?></td>
                                <td><?php $porcentaje10 = ($total10 * 100) / $nro;
                                    echo round($porcentaje10, 1) . "%"; ?></td>
                                <td><?php $porcentaje11 = ($total11 * 100) / $nro;
                                    echo round($porcentaje11, 1) . "%"; ?></td>
                                <td><?php $porcentaje12 = ($total12 * 100) / $nro;
                                    echo round($porcentaje12, 1) . "%"; ?></td>
                                <td><?php $porcentaje13 = ($total13 * 100) / $nro;
                                    echo round($porcentaje13, 1) . "%"; ?></td>
                                <td><?php $porcentaje14 = ($total14 * 100) / $nro;
                                    echo round($porcentaje14, 1) . "%"; ?></td>
                                <td><?php $porcentaje15 = ($total15 * 100) / $nro;
                                    echo round($porcentaje15, 1) . "%"; ?></td>
                                <td><?php $porcentaje16 = ($total16 * 100) / $nro;
                                    echo round($porcentaje16, 1) . "%"; ?></td>
                                <td><?php $porcentaje17 = ($total17 * 100) / $nro;
                                    echo round($porcentaje17, 1) . "%"; ?></td>
                                <td><?php $porcentaje18 = ($total18 * 100) / $nro;
                                    echo round($porcentaje18, 1) . "%"; ?></td>
                                <td><?php $porcentaje19 = ($total19 * 100) / $nro;
                                    echo round($porcentaje19, 1) . "%"; ?></td>
                                <td><?php $porcentaje20 = ($total20 * 100) / $nro;
                                    echo round($porcentaje20, 1) . "%"; ?></td>
                            </tr>
                            <tr>
                                <td>% Desaciertos</td>
                                <td><?php $porcentajed1 = ($diferencia1 * 100) / $nro;
                                    echo round($porcentajed1, 1) . "%"; ?></td>
                                <td><?php $porcentajed2 = ($diferencia2 * 100) / $nro;
                                    echo round($porcentajed2, 1) . "%"; ?></td>
                                <td><?php $porcentajed3 = ($diferencia3 * 100) / $nro;
                                    echo round($porcentajed3, 1) . "%"; ?></td>
                                <td><?php $porcentajed4 = ($diferencia4 * 100) / $nro;
                                    echo round($porcentajed4, 1) . "%"; ?></td>
                                <td><?php $porcentajed5 = ($diferencia5 * 100) / $nro;
                                    echo round($porcentajed5, 1) . "%"; ?></td>
                                <td><?php $porcentajed6 = ($diferencia6 * 100) / $nro;
                                    echo round($porcentajed6, 1) . "%"; ?></td>
                                <td><?php $porcentajed7 = ($diferencia7 * 100) / $nro;
                                    echo round($porcentajed7, 1) . "%"; ?></td>
                                <td><?php $porcentajed8 = ($diferencia8 * 100) / $nro;
                                    echo round($porcentajed8, 1) . "%"; ?></td>
                                <td><?php $porcentajed9 = ($diferencia9 * 100) / $nro;
                                    echo round($porcentajed9, 1) . "%"; ?></td>
                                <td><?php $porcentajed10 = ($diferencia10 * 100) / $nro;
                                    echo round($porcentajed10, 1) . "%"; ?></td>
                                <td><?php $porcentajed11 = ($diferencia11 * 100) / $nro;
                                    echo round($porcentajed11, 1) . "%"; ?></td>
                                <td><?php $porcentajed12 = ($diferencia12 * 100) / $nro;
                                    echo round($porcentajed12, 1) . "%"; ?></td>
                                <td><?php $porcentajed13 = ($diferencia13 * 100) / $nro;
                                    echo round($porcentajed13, 1) . "%"; ?></td>
                                <td><?php $porcentajed14 = ($diferencia14 * 100) / $nro;
                                    echo round($porcentajed14, 1) . "%"; ?></td>
                                <td><?php $porcentajed15 = ($diferencia15 * 100) / $nro;
                                    echo round($porcentajed15, 1) . "%"; ?></td>
                                <td><?php $porcentajed16 = ($diferencia16 * 100) / $nro;
                                    echo round($porcentajed16, 1) . "%"; ?></td>
                                <td><?php $porcentajed17 = ($diferencia17 * 100) / $nro;
                                    echo round($porcentajed17, 1) . "%"; ?></td>
                                <td><?php $porcentajed18 = ($diferencia18 * 100) / $nro;
                                    echo round($porcentajed18, 1) . "%"; ?></td>
                                <td><?php $porcentajed19 = ($diferencia19 * 100) / $nro;
                                    echo round($porcentajed19, 1) . "%"; ?></td>
                                <td><?php $porcentajed20 = ($diferencia20 * 100) / $nro;
                                    echo round($porcentajed20, 1) . "%"; ?></td>
                            </tr>
                            <tr>
                                <td>% Blancos</td>
                                <td><?php $porcentajed1b = ($blanco1v * 100) / $nro;
                                    echo round($porcentajed1b, 1) . "%"; ?></td>
                                <td><?php $porcentajed2b = ($blanco2v * 100) / $nro;
                                    echo round($porcentajed2b, 1) . "%"; ?></td>
                                <td><?php $porcentajed3b = ($blanco3v * 100) / $nro;
                                    echo round($porcentajed3b, 1) . "%"; ?></td>
                                <td><?php $porcentajed4b = ($blanco4v * 100) / $nro;
                                    echo round($porcentajed4b, 1) . "%"; ?></td>
                                <td><?php $porcentajed5b = ($blanco5v * 100) / $nro;
                                    echo round($porcentajed5b, 1) . "%"; ?></td>
                                <td><?php $porcentajed6b = ($blanco6v * 100) / $nro;
                                    echo round($porcentajed6b, 1) . "%"; ?></td>
                                <td><?php $porcentajed7b = ($blanco7v * 100) / $nro;
                                    echo round($porcentajed7b, 1) . "%"; ?></td>
                                <td><?php $porcentajed8b = ($blanco8v * 100) / $nro;
                                    echo round($porcentajed8b, 1) . "%"; ?></td>
                                <td><?php $porcentajed9b = ($blanco9v * 100) / $nro;
                                    echo round($porcentajed9b, 1) . "%"; ?></td>
                                <td><?php $porcentajed10b = ($blanco10v * 100) / $nro;
                                    echo round($porcentajed10b, 1) . "%"; ?></td>
                                <td><?php $porcentajed11b = ($blanco11v * 100) / $nro;
                                    echo round($porcentajed11b, 1) . "%"; ?></td>
                                <td><?php $porcentajed12b = ($blanco12v * 100) / $nro;
                                    echo round($porcentajed12b, 1) . "%"; ?></td>
                                <td><?php $porcentajed13b = ($blanco13v * 100) / $nro;
                                    echo round($porcentajed13b, 1) . "%"; ?></td>
                                <td><?php $porcentajed14b = ($blanco14v * 100) / $nro;
                                    echo round($porcentajed14b, 1) . "%"; ?></td>
                                <td><?php $porcentajed15b = ($blanco15v * 100) / $nro;
                                    echo round($porcentajed15b, 1) . "%"; ?></td>
                                <td><?php $porcentajed16b = ($blanco16v * 100) / $nro;
                                    echo round($porcentajed16b, 1) . "%"; ?></td>
                                <td><?php $porcentajed17b = ($blanco17v * 100) / $nro;
                                    echo round($porcentajed17b, 1) . "%"; ?></td>
                                <td><?php $porcentajed18b = ($blanco18v * 100) / $nro;
                                    echo round($porcentajed18b, 1) . "%"; ?></td>
                                <td><?php $porcentajed19b = ($blanco19v * 100) / $nro;
                                    echo round($porcentajed19b, 1) . "%"; ?></td>
                                <td><?php $porcentajed20b = ($blanco20v * 100) / $nro;
                                    echo round($porcentajed20b, 1) . "%"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-responsive" style="font-size: 12px; ">
                        <thead>
                            <tr style="background-color: #222b35; font-size: 9px; color:#ffffff; ">
                                <th scope="col">#</th>
                                <th scope="col">COMPETENCIA</th>
                                <th scope="col">ITEM</th>
                                <th scope="col">DESEMPEÑOS</th>
                                <th scope="col" style="display:none;">NIVEL ALCANZADO</th>
                                <th scope="col">% <br>ACIERTOS</th>
                                <th scope="col">% <br>DESACIERTOS</th>
                                <th scope="col">N° <br>ACIERTOS</th>
                                <th scope="col">N° <br>DESACIERTOS</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="nro">1</td>
                            <td class="nro">
                                <?PHP echo $competencia1a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items1; ?></td>
                            <td>
                                <?PHP echo $desempeno1a; ?>
                            </td>
                            <?php $porcentaje1 = round((($total1 * 100) / $nro), 1);
                            if ($porcentaje1 >= 0 and $porcentaje1 <= 33.3) {
                                $nialcanzado1 = "Critico";
                            } else if ($porcentaje1 >= 33.4 and $porcentaje1 <= 66.6) {
                                $nialcanzado1 = "Promedio";
                            } else {
                                $nialcanzado1 = "Logrado";
                            };
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado1; ?></td>
                            <td><?php echo $porcentaje1 . "%"; ?></td>
                            <td><?php $porcentajed1 = 100 - $porcentaje1;
                                echo round($porcentajed1, 1) . "%"; ?></td>

                            <?php
                            if ($de1 != "") {
                                $valorsuma1 = $total1;
                            } else {
                                $valorsuma1 = 0;
                            }
                            echo $valorsuma1;
                            ?>



                            <td><?php echo $total1; ?></td>
                            <td><?php $diferencia1 = $nro - $total1;
                                echo $diferencia1; ?></td>
                        </tr>


                        <tr>
                            <td class="nro">2</td>
                            <td class="nro">
                                <?PHP echo $competencia2a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items2; ?></td>
                            <td>
                                <?PHP echo $desempeno2a; ?>
                            </td>


                            <?php $porcentaje2 = round((($total2 * 100) / $nro), 1);
                            if ($porcentaje2 >= 0 and $porcentaje2 <= 33.3) {
                                $nialcanzado2 = "Critico";
                            } else if ($porcentaje2 >= 33.4 and $porcentaje2 <= 66.6) {
                                $nialcanzado2 = "Promedio";
                            } else {
                                $nialcanzado2 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado2; ?></td>
                            <td><?php echo $porcentaje2 . "%"; ?></td>

                            <td><?php $porcentajed2 = 100 - $porcentaje2;
                                echo round($porcentajed2, 1) . "%"; ?></td>


                            <?php
                            if ($de2 != "") {
                                $valorsuma2 = $total2;
                            } else {
                                $valorsuma2 = 0;
                            }
                            echo $valorsuma2 . "<br>";
                            ?>


                            <td><?php echo $total2; ?></td>
                            <td><?php $diferencia2 = $nro - $total2;
                                echo $diferencia2; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">3</td>
                            <td class="nro">
                                <?PHP echo $competencia3a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items3; ?></td>
                            <td>
                                <?PHP echo $desempeno3a; ?>
                            </td>

                            <?php $porcentaje3 = round((($total3 * 100) / $nro), 1);
                            if ($porcentaje3 >= 0 and $porcentaje3 <= 33.3) {
                                $nialcanzado3 = "Critico";
                            } else if ($porcentaje3 >= 33.4 and $porcentaje3 <= 66.6) {
                                $nialcanzado3 = "Promedio";
                            } else {
                                $nialcanzado3 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado3; ?></td>
                            <td><?php echo $porcentaje3 . "%"; ?></td>




                            <td><?php $porcentajed3 = 100 - $porcentaje3;
                                echo round($porcentajed3, 1) . "%"; ?></td>
                            <td><?php echo $total3; ?></td>
                            <td><?php $diferencia3 = $nro - $total3;
                                echo $diferencia3; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">4</td>
                            <td class="nro">
                                <?PHP echo $competencia4a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items4; ?></td>
                            <td>
                                <?PHP echo $desempeno4a; ?>
                            </td>

                            <?php $porcentaje4 = round((($total4 * 100) / $nro), 1);
                            if ($porcentaje4 >= 0 and $porcentaje4 <= 33.3) {
                                $nialcanzado4 = "Critico";
                            } else if ($porcentaje4 >= 33.4 and $porcentaje4 <= 66.6) {
                                $nialcanzado4 = "Promedio";
                            } else {
                                $nialcanzado4 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado4; ?></td>
                            <td><?php echo $porcentaje4 . "%"; ?></td>
                            <td><?php $porcentajed4 = 100 - $porcentaje4;
                                echo round($porcentajed4, 1) . "%"; ?></td>
                            <td><?php echo $total4; ?></td>
                            <td><?php $diferencia4 = $nro - $total4;
                                echo $diferencia4; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">5</td>
                            <td class="nro">
                                <?PHP echo $competencia5a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items5; ?></td>
                            <td>
                                <?PHP echo $desempeno5a; ?>
                            </td>

                            <?php $porcentaje5 = round((($total5 * 100) / $nro), 1);
                            if ($porcentaje5 >= 0 and $porcentaje5 <= 33.3) {
                                $nialcanzado5 = "Critico";
                            } else if ($porcentaje5 >= 33.4 and $porcentaje5 <= 66.6) {
                                $nialcanzado5 = "Promedio";
                            } else {
                                $nialcanzado5 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado5; ?></td>
                            <td><?php echo $porcentaje5 . "%"; ?></td>



                            <td><?php $porcentajed5 = 100 - $porcentaje5;
                                echo round($porcentajed5, 1) . "%"; ?></td>
                            <td><?php echo $total5; ?></td>
                            <td><?php $diferencia5 = $nro - $total5;
                                echo $diferencia5; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">6</td>
                            <td class="nro">
                                <?PHP echo $competencia6a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items6; ?></td>
                            <td>
                                <?PHP echo $desempeno6a; ?>
                            </td>


                            <?php $porcentaje6 = round((($total6 * 100) / $nro), 1);
                            if ($porcentaje6 >= 0 and $porcentaje6 <= 33.3) {
                                $nialcanzado6 = "Critico";
                            } else if ($porcentaje6 >= 33.4 and $porcentaje6 <= 66.6) {
                                $nialcanzado6 = "Promedio";
                            } else {
                                $nialcanzado6 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado6; ?></td>
                            <td><?php echo $porcentaje6 . "%"; ?></td>


                            <td><?php $porcentajed6 = 100 - $porcentaje6;
                                echo round($porcentajed6, 1) . "%"; ?></td>
                            <td><?php echo $total6; ?></td>
                            <td><?php $diferencia6 = $nro - $total6;
                                echo $diferencia6; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">7</td>
                            <td class="nro">
                                <?PHP echo $competencia7a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items7; ?></td>
                            <td>
                                <?PHP echo $desempeno7a; ?>
                            </td>

                            <?php $porcentaje7 = round((($total7 * 100) / $nro), 1);
                            if ($porcentaje7 >= 0 and $porcentaje7 <= 33.3) {
                                $nialcanzado7 = "Critico";
                            } else if ($porcentaje7 >= 33.4 and $porcentaje7 <= 66.6) {
                                $nialcanzado7 = "Promedio";
                            } else {
                                $nialcanzado7 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado7; ?></td>
                            <td><?php echo $porcentaje7 . "%"; ?></td>
                            <td><?php $porcentajed7 = 100 - $porcentaje7;
                                echo round($porcentajed7, 1) . "%"; ?></td>
                            <td><?php echo $total7; ?></td>
                            <td><?php $diferencia7 = $nro - $total7;
                                echo $diferencia7; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">8</td>
                            <td class="nro">
                                <?PHP echo $competencia8a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items8; ?></td>
                            <td>
                                <?PHP echo $desempeno8a; ?>
                            </td>
                            <?php $porcentaje8 = round((($total8 * 100) / $nro), 1);
                            if ($porcentaje8 >= 0 and $porcentaje8 <= 33.3) {
                                $nialcanzado8 = "Critico";
                            } else if ($porcentaje8 >= 33.4 and $porcentaje8 <= 66.6) {
                                $nialcanzado8 = "Promedio";
                            } else {
                                $nialcanzado8 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado8; ?></td>
                            <td><?php echo $porcentaje8 . "%"; ?></td>
                            <td><?php $porcentajed8 = 100 - $porcentaje8;
                                echo round($porcentajed8, 1) . "%"; ?></td>
                            <td><?php echo $total8; ?></td>
                            <td><?php $diferencia8 = $nro - $total8;
                                echo $diferencia8; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">9</td>
                            <td class="nro">
                                <?PHP echo $competencia9a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items9; ?></td>
                            <td>
                                <?PHP echo $desempeno9a; ?>
                            </td>

                            <?php $porcentaje9 = round((($total9 * 100) / $nro), 1);
                            if ($porcentaje9 >= 0 and $porcentaje9 <= 33.3) {
                                $nialcanzado9 = "Critico";
                            } else if ($porcentaje9 >= 33.4 and $porcentaje9 <= 66.6) {
                                $nialcanzado9 = "Promedio";
                            } else {
                                $nialcanzado9 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado9; ?></td>
                            <td><?php echo $porcentaje9 . "%"; ?></td>

                            <td><?php $porcentajed9 = 100 - $porcentaje9;
                                echo round($porcentajed9, 1) . "%"; ?></td>
                            <td><?php echo $total9; ?></td>
                            <td><?php $diferencia9 = $nro - $total9;
                                echo $diferencia9; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">10</td>
                            <td class="nro">
                                <?PHP echo $competencia10a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items10; ?></td>
                            <td>
                                <?PHP echo $desempeno10a; ?>
                            </td>

                            <?php $porcentaje10 = round((($total10 * 100) / $nro), 1);
                            if ($porcentaje10 >= 0 and $porcentaje10 <= 33.3) {
                                $nialcanzado10 = "Critico";
                            } else if ($porcentaje10 >= 33.4 and $porcentaje10 <= 66.6) {
                                $nialcanzado10 = "Promedio";
                            } else {
                                $nialcanzado10 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado10; ?></td>
                            <td><?php echo $porcentaje10 . "%"; ?></td>


                            <td><?php $porcentajed10 = 100 - $porcentaje10;
                                echo round($porcentajed10, 1) . "%"; ?></td>
                            <td><?php echo $total10; ?></td>
                            <td><?php $diferencia10 = $nro - $total10;
                                echo $diferencia10; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">11</td>
                            <td class="nro">
                                <?PHP echo $competencia11a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items11; ?></td>
                            <td>
                                <?PHP echo $desempeno11a; ?>
                            </td>

                            <?php $porcentaje11 = round((($total11 * 100) / $nro), 1);
                            if ($porcentaje11 >= 0 and $porcentaje11 <= 33.3) {
                                $nialcanzado11 = "Critico";
                            } else if ($porcentaje11 >= 33.4 and $porcentaje11 <= 66.6) {
                                $nialcanzado11 = "Promedio";
                            } else {
                                $nialcanzado11 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado11; ?></td>
                            <td><?php echo $porcentaje11 . "%"; ?></td>


                            <td><?php $porcentajed11 = 100 - $porcentaje11;
                                echo round($porcentajed11, 1) . "%"; ?></td>
                            <td><?php echo $total11; ?></td>
                            <td><?php $diferencia11 = $nro - $total11;
                                echo $diferencia11; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">12</td>
                            <td class="nro">
                                <?PHP echo $competencia12a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items12; ?></td>
                            <td>
                                <?PHP echo $desempeno12a; ?>
                            </td>

                            <?php $porcentaje12 = round((($total12 * 100) / $nro), 1);
                            if ($porcentaje12 >= 0 and $porcentaje12 <= 33.3) {
                                $nialcanzado12 = "Critico";
                            } else if ($porcentaje12 >= 33.4 and $porcentaje12 <= 66.6) {
                                $nialcanzado12 = "Promedio";
                            } else {
                                $nialcanzado12 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado12; ?></td>
                            <td><?php echo $porcentaje12 . "%"; ?></td>

                            <td><?php $porcentajed12 = 100 - $porcentaje12;
                                echo round($porcentajed12, 1) . "%"; ?></td>
                            <td><?php echo $total12; ?></td>
                            <td><?php $diferencia12 = $nro - $total12;
                                echo $diferencia12; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">13</td>
                            <td class="nro">
                                <?PHP echo $competencia13a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items13; ?></td>
                            <td>
                                <?PHP echo $desempeno13a; ?>
                            </td>

                            <?php $porcentaje13 = round((($total13 * 100) / $nro), 1);
                            if ($porcentaje13 >= 0 and $porcentaje13 <= 33.3) {
                                $nialcanzado13 = "Critico";
                            } else if ($porcentaje13 >= 33.4 and $porcentaje13 <= 66.6) {
                                $nialcanzado13 = "Promedio";
                            } else {
                                $nialcanzado13 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado13; ?></td>
                            <td><?php echo $porcentaje13 . "%"; ?></td>


                            <td><?php $porcentajed13 = 100 - $porcentaje13;
                                echo round($porcentajed13, 1) . "%"; ?></td>
                            <td><?php echo $total13; ?></td>
                            <td><?php $diferencia13 = $nro - $total13;
                                echo $diferencia13; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">14</td>
                            <td class="nro">
                                <?PHP echo $competencia14a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items14; ?></td>
                            <td>
                                <?PHP echo $desempeno14a; ?>
                            </td>

                            <?php $porcentaje14 = round((($total14 * 100) / $nro), 1);
                            if ($porcentaje14 >= 0 and $porcentaje14 <= 33.3) {
                                $nialcanzado14 = "Critico";
                            } else if ($porcentaje14 >= 33.4 and $porcentaje14 <= 66.6) {
                                $nialcanzado14 = "Promedio";
                            } else {
                                $nialcanzado14 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado14; ?></td>
                            <td><?php echo $porcentaje14 . "%"; ?></td>


                            <td><?php $porcentajed14 = 100 - $porcentaje14;
                                echo round($porcentajed14, 1) . "%"; ?></td>
                            <td><?php echo $total14; ?></td>
                            <td><?php $diferencia14 = $nro - $total14;
                                echo $diferencia14; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">15</td>
                            <td class="nro">
                                <?PHP echo $competencia15a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items15; ?></td>
                            <td>
                                <?PHP echo $desempeno15a; ?>
                            </td>

                            <?php $porcentaje15 = round((($total15 * 100) / $nro), 1);
                            if ($porcentaje15 >= 0 and $porcentaje15 <= 33.3) {
                                $nialcanzado15 = "Critico";
                            } else if ($porcentaje15 >= 33.4 and $porcentaje15 <= 66.6) {
                                $nialcanzado15 = "Promedio";
                            } else {
                                $nialcanzado15 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado15; ?></td>
                            <td><?php echo $porcentaje15 . "%"; ?></td>


                            <td><?php $porcentajed15 = 100 - $porcentaje15;
                                echo round($porcentajed15, 1) . "%"; ?></td>
                            <td><?php echo $total15; ?></td>
                            <td><?php $diferencia15 = $nro - $total15;
                                echo $diferencia15; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">16</td>
                            <td class="nro">
                                <?PHP echo $competencia16a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items16; ?></td>
                            <td>
                                <?PHP echo $desempeno16a; ?>
                            </td>

                            <?php $porcentaje16 = round((($total16 * 100) / $nro), 1);
                            if ($porcentaje16 >= 0 and $porcentaje16 <= 33.3) {
                                $nialcanzado16 = "Critico";
                            } else if ($porcentaje16 >= 33.4 and $porcentaje16 <= 66.6) {
                                $nialcanzado16 = "Promedio";
                            } else {
                                $nialcanzado16 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado16; ?></td>
                            <td><?php echo $porcentaje16 . "%"; ?></td>
                            <td><?php $porcentajed16 = 100 - $porcentaje16;
                                echo round($porcentajed16, 1) . "%"; ?></td>
                            <td><?php echo $total16; ?></td>
                            <td><?php $diferencia16 = $nro - $total16;
                                echo $diferencia16; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">17</td>
                            <td class="nro">
                                <?PHP echo $competencia17a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items17; ?></td>
                            <td>
                                <?PHP echo $desempeno17a; ?>
                            </td>


                            <?php $porcentaje17 = round((($total17 * 100) / $nro), 1);
                            if ($porcentaje17 >= 0 and $porcentaje17 <= 33.3) {
                                $nialcanzado17 = "Critico";
                            } else if ($porcentaje17 >= 33.4 and $porcentaje17 <= 66.6) {
                                $nialcanzado17 = "Promedio";
                            } else {
                                $nialcanzado17 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado17; ?></td>
                            <td><?php echo $porcentaje17 . "%"; ?></td>


                            <td><?php $porcentajed17 = 100 - $porcentaje17;
                                echo round($porcentajed17, 1) . "%"; ?></td>
                            <td><?php echo $total17; ?></td>
                            <td><?php $diferencia17 = $nro - $total17;
                                echo $diferencia17; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">18</td>
                            <td class="nro">
                                <?PHP echo $competencia18a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items18; ?></td>
                            <td>
                                <?PHP echo $desempeno18a; ?>
                            </td>

                            <?php $porcentaje18 = round((($total18 * 100) / $nro), 1);
                            if ($porcentaje18 >= 0 and $porcentaje18 <= 33.3) {
                                $nialcanzado18 = "Critico";
                            } else if ($porcentaje18 >= 33.4 and $porcentaje18 <= 66.6) {
                                $nialcanzado18 = "Promedio";
                            } else {
                                $nialcanzado18 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado18; ?></td>
                            <td><?php echo $porcentaje18 . "%"; ?></td>


                            <td><?php $porcentajed18 = 100 - $porcentaje18;
                                echo round($porcentajed18, 1) . "%"; ?></td>
                            <td><?php echo $total18; ?></td>
                            <td><?php $diferencia18 = $nro - $total18;
                                echo $diferencia18; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">19</td>
                            <td class="nro">
                                <?PHP echo $competencia19a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items19; ?></td>
                            <td>
                                <?PHP echo $desempeno19a; ?>
                            </td>

                            <?php $porcentaje19 = round((($total19 * 100) / $nro), 1);
                            if ($porcentaje19 >= 0 and $porcentaje19 <= 33.3) {
                                $nialcanzado19 = "Critico";
                            } else if ($porcentaje19 >= 33.4 and $porcentaje19 <= 66.6) {
                                $nialcanzado19 = "Promedio";
                            } else {
                                $nialcanzado19 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado19; ?></td>
                            <td><?php echo $porcentaje19 . "%"; ?></td>



                            <td><?php $porcentajed19 = 100 - $porcentaje19;
                                echo round($porcentajed19, 1) . "%"; ?></td>
                            <td><?php echo $total19; ?></td>
                            <td><?php $diferencia19 = $nro - $total19;
                                echo $diferencia19; ?></td>
                        </tr>

                        <tr>
                            <td class="nro">20</td>
                            <td class="nro">
                                <?PHP echo $competencia20a; ?>
                            </td>
                            <td class="respuestase"><?php echo  $items20; ?></td>
                            <td>
                                <?PHP echo $desempeno20a; ?>
                            </td>


                            <?php $porcentaje20 = round((($total20 * 100) / $nro), 1);
                            if ($porcentaje20 >= 0 and $porcentaje20 <= 33.3) {
                                $nialcanzado20 = "Critico";
                            } else if ($porcentaje20 >= 33.4 and $porcentaje20 <= 66.6) {
                                $nialcanzado20 = "Promedio";
                            } else {
                                $nialcanzado20 = "Logrado";
                            }
                            ?>
                            <td class="nilogro" style="display:none;"><?php echo $nialcanzado20; ?></td>
                            <td><?php echo $porcentaje20 . "%"; ?></td>



                            <td><?php $porcentajed20 = 100 - $porcentaje20;
                                echo round($porcentajed20, 1) . "%"; ?></td>
                            <td><?php echo $total20; ?></td>
                            <td><?php $diferencia20 = $nro - $total20;
                                echo $diferencia20; ?></td>

                        </tr>


                        <tr>
                            <td colspan="8" style="background-color: #222b35; font-size: 13px; color:#ffffff;">Total
                                alumnos</td>
                            <td style="background-color: #222b35; font-size: 13px; color:#ffffff;"><?php echo $nro; ?>
                            </td>
                        </tr>

                    </table>




                    <table id="datatable" style="display:none;">
                        <thead>
                            <tr>
                                <th>ITEMS</th>
                                <th>Nro Aciertos</th>
                                <th>Nro Desaciertos</th>
                                <th>Nro Blancos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>UNO(01)</td>
                                <td><?php echo $total1; ?></td>
                                <td><?php echo $diferencia1; ?></td>
                                <td><?php echo $blanco1v; ?></td>


                            </tr>
                            <tr>
                                <td>DOS(02)</td>
                                <td><?php echo $total2; ?></td>
                                <td><?php echo $diferencia2; ?></td>
                                <td><?php echo $blanco2v; ?></td>
                            </tr>
                            <tr>
                                <td>TRES(03)</td>
                                <td><?php echo $total3; ?></td>
                                <td><?php echo $diferencia3; ?></td>
                                <td><?php echo $blanco3v; ?></td>
                            </tr>
                            <tr>
                                <td>CUATRO(04)</td>
                                <td><?php echo $total4; ?></td>
                                <td><?php echo $diferencia4; ?></td>
                                <td><?php echo $blanco4v; ?></td>
                            </tr>
                            <tr>
                                <td>CINCO(05)</td>
                                <td><?php echo $total5; ?></td>
                                <td><?php echo $diferencia5; ?></td>
                                <td><?php echo $blanco5v; ?></td>
                            </tr>
                            <tr>
                                <td>SEIS(06)</td>
                                <td><?php echo $total6; ?></td>
                                <td><?php echo $diferencia6; ?></td>
                                <td><?php echo $blanco6v; ?></td>
                            </tr>
                            <tr>
                                <td>SIETE(07)</td>
                                <td><?php echo $total7; ?></td>
                                <td><?php echo $diferencia7; ?></td>
                                <td><?php echo $blanco7v; ?></td>
                            </tr>
                            <tr>
                                <td>OCHO(08)</td>
                                <td><?php echo $total8; ?></td>
                                <td><?php echo $diferencia8; ?></td>
                                <td><?php echo $blanco8v; ?></td>
                            </tr>
                            <tr>
                                <td>NUEVE(09)</td>
                                <td><?php echo $total9; ?></td>
                                <td><?php echo $diferencia9; ?></td>
                                <td><?php echo $blanco9v; ?></td>
                            </tr>
                            <tr>
                                <td>DIEZ(10)</td>
                                <td><?php echo $total10; ?></td>
                                <td><?php echo $diferencia10; ?></td>
                                <td><?php echo $blanco10v; ?></td>
                            </tr>
                            <tr>
                                <td>ONCE(11)</td>
                                <td><?php echo $total11; ?></td>
                                <td><?php echo $diferencia11; ?></td>
                                <td><?php echo $blanco11v; ?></td>
                            </tr>
                            <tr>
                                <td>DOCE(12)</td>
                                <td><?php echo $total12; ?></td>
                                <td><?php echo $diferencia12; ?></td>
                                <td><?php echo $blanco12v; ?></td>
                            </tr>
                            <tr>
                                <td>TRECE(13)</td>
                                <td><?php echo $total13; ?></td>
                                <td><?php echo $diferencia13; ?></td>
                                <td><?php echo $blanco13v; ?></td>
                            </tr>
                            <tr>
                                <td>CATORCE(14)</td>
                                <td><?php echo $total14; ?></td>
                                <td><?php echo $diferencia14; ?></td>
                                <td><?php echo $blanco14v; ?></td>
                            </tr>
                            <tr>
                                <td>QUINCE(15)</td>
                                <td><?php echo $total15; ?></td>
                                <td><?php echo $diferencia15; ?></td>
                                <td><?php echo $blanco15v; ?></td>
                            </tr>
                            <td>DIECISEIS(16)</td>
                            <td><?php echo $total16; ?></td>
                            <td><?php echo $diferencia16; ?></td>
                            <td><?php echo $blanco16v; ?></td>
                            </tr>
                            <td>DIECISIETE(17)</td>
                            <td><?php echo $total17; ?></td>
                            <td><?php echo $diferencia17; ?></td>
                            <td><?php echo $blanco17v; ?></td>
                            </tr>
                            <tr>
                                <td>DIECIOCHO(18)</td>
                                <td><?php echo $total18; ?></td>
                                <td><?php echo $diferencia18; ?></td>
                                <td><?php echo $blanco18v; ?></td>
                            </tr>
                            <tr>
                                <td>DIECINUEVE(19)</td>
                                <td><?php echo $total19; ?></td>
                                <td><?php echo $diferencia19; ?></td>
                                <td><?php echo $blanco19v; ?></td>
                            </tr>
                            <tr>
                                <td>VEINTE(20)</td>
                                <td><?php echo $total20; ?></td>
                                <td><?php echo $diferencia20; ?></td>
                                <td><?php echo $blanco20v; ?></td>
                            </tr>
                        </tbody>
                    </table>


                    <table id="datatablee" style="display:none;">
                        <thead>
                            <tr>
                                <th>ITEMS</th>
                                <th>% Aciertos</th>
                                <th>% Desaciertos</th>
                                <th>% Blancos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>UNO(01)</td>
                                <td><?php echo round($porcentaje1, 1); ?></td>
                                <td><?php echo round($porcentajed1, 1); ?></td>
                                <td><?php echo round($porcentajed1b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>DOS(02)</td>
                                <td><?php echo round($porcentaje2, 1); ?></td>
                                <td><?php echo round($porcentajed2, 1); ?></td>
                                <td><?php echo round($porcentajed2b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>TRES(03)</td>
                                <td><?php echo round($porcentaje3, 1); ?></td>
                                <td><?php echo round($porcentajed3, 1); ?></td>
                                <td><?php echo round($porcentajed3b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>CUATRO(04)</td>
                                <td><?php echo round($porcentaje4, 1); ?></td>
                                <td><?php echo round($porcentajed4, 1); ?></td>
                                <td><?php echo round($porcentajed4b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>CINCO(05)</td>
                                <td><?php echo round($porcentaje5, 1); ?></td>
                                <td><?php echo round($porcentajed5, 1); ?></td>
                                <td><?php echo round($porcentajed5b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>SEIS(06)</td>
                                <td><?php echo round($porcentaje6, 1); ?></td>
                                <td><?php echo round($porcentajed6, 1); ?></td>
                                <td><?php echo round($porcentajed6b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>SIETE(07)</td>
                                <td><?php echo round($porcentaje7, 1); ?></td>
                                <td><?php echo round($porcentajed7, 1); ?></td>
                                <td><?php echo round($porcentajed7b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>OCHO(08)</td>
                                <td><?php echo round($porcentaje8, 1); ?></td>
                                <td><?php echo round($porcentajed8, 1); ?></td>
                                <td><?php echo round($porcentajed8b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>NUEVE(09)</td>
                                <td><?php echo round($porcentaje9, 1); ?></td>
                                <td><?php echo round($porcentajed9, 1); ?></td>
                                <td><?php echo round($porcentajed9b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>DIEZ(10)</td>
                                <td><?php echo round($porcentaje10, 1); ?></td>
                                <td><?php echo round($porcentajed10, 1); ?></td>
                                <td><?php echo round($porcentajed10b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>ONCE(11)</td>
                                <td><?php echo round($porcentaje11, 1); ?></td>
                                <td><?php echo round($porcentajed11, 1); ?></td>
                                <td><?php echo round($porcentajed11b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>DOCE(12)</td>
                                <td><?php echo round($porcentaje12, 1); ?></td>
                                <td><?php echo round($porcentajed12, 1); ?></td>
                                <td><?php echo round($porcentajed12b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>TRECE(13)</td>
                                <td><?php echo round($porcentaje13, 1); ?></td>
                                <td><?php echo round($porcentajed13, 1); ?></td>
                                <td><?php echo round($porcentajed13b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>CATORCE(14)</td>
                                <td><?php echo round($porcentaje14, 1); ?></td>
                                <td><?php echo round($porcentajed14, 1); ?></td>
                                <td><?php echo round($porcentajed14b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>QUINCE(15)</td>
                                <td><?php echo round($porcentaje15, 1); ?></td>
                                <td><?php echo round($porcentajed15, 1); ?></td>
                                <td><?php echo round($porcentajed15b, 1); ?></td>
                            </tr>
                            <td>DIECISEIS(16)</td>
                            <td><?php echo round($porcentaje16, 1); ?></td>
                            <td><?php echo round($porcentajed16, 1); ?></td>
                            <td><?php echo round($porcentajed16b, 1); ?></td>
                            </tr>
                            <td>DIECISIETE(17)</td>
                            <td><?php echo round($porcentaje17, 1); ?></td>
                            <td><?php echo round($porcentajed17, 1); ?></td>
                            <td><?php echo round($porcentajed17b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>DIECIOCHO(18)</td>
                                <td><?php echo round($porcentaje18, 1); ?></td>
                                <td><?php echo round($porcentajed18, 1); ?></td>
                                <td><?php echo round($porcentajed18b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>DIECINUEVE(19)</td>
                                <td><?php echo round($porcentaje19, 1); ?></td>
                                <td><?php echo round($porcentajed19, 1); ?></td>
                                <td><?php echo round($porcentajed19b, 1); ?></td>
                            </tr>
                            <tr>
                                <td>VEINTE(20)</td>
                                <td><?php echo round($porcentaje20, 1); ?></td>
                                <td><?php echo round($porcentajed20, 1); ?></td>
                                <td><?php echo round($porcentajed20b, 1); ?></td>
                            </tr>
                        </tbody>
                    </table>


                    <table id="datatablee" class="table table-striped">
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

                            <?php } ?>
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



        <br><br>
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
                    pieStartAngle: 100,
                    fontSize: 12
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
?>