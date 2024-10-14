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
        <link rel='stylesheet' href='css/stylep.css'>
        <style>
            .carga {
                display: none;
            }

            .colorfila{ background-color:#cae4fe;}
        </style>
    </head>

    <body>



        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        $nivele = $_POST['nivele'];

        $nivel = $_POST['nivel'];
     



  

        //-----------------Descripcion UGEL--------------------------------
        $cursodesgq = $asistencia->evaluacionnombre($nivele);
        while ($mascufq = mysqli_fetch_array($cursodesgq)) {
            $desugelq = $mascufq['descripcion'];
        }

        ?>

        <div class="row">
            <div class="col-sm-12 col-md-12">

                <div class="card">
                    <h6 class="card-header">.:: Resultado</h6>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-12">
                                <div class="alert alert-light" role="alert">
                                    <?php
                                    $arean = 'mat';
                                    $totalbte = $asistencia->contardatosmatematica($nivele, $arean);
                                    while ($tate = mysqli_fetch_array($totalbte)) {
                                        $toate = $tate[0];
                                    }
                                    

                                    $totalbtep = $asistencia->contardatosmatematicanivel($nivele, $arean, 'PRIMARIA');
                                    while ($tatep = mysqli_fetch_array($totalbtep)) {
                                        $toatep = $tatep[0];
                                    }
                                 

                                    $totalbtes = $asistencia->contardatosmatematicanivel($nivele, $arean, 'SECUNDARIA');
                                    while ($tates = mysqli_fetch_array($totalbtes)) {
                                        $toates = $tates[0];
                                    }
                       
                                    ?>

                                    <table class="table table-striped table-sm  letramenub table-bordered  border-primary table-hover">
                                        <thead>
                                            <tr>
<th>Total de Alumnos:</th><th><?php echo $toate;?> </th><th>Primaria:</th><th><?php echo $toatep;?> </th><th>Secundaria:</th><th><?php echo $toates;?> </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table table-striped table-sm  letramenub table-bordered  border-primary table-hover">
                                        <thead>
                                            <tr>
<th>NIVEL : <?PHP ECHO $nivel; ?></th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <table class="table table-striped table-sm  letramenub table-bordered  border-primary table-hover">
                                        <thead>
                                            <tr>
                                                <th>UGEL</th>
                                                <th>Nivel</th>
                                                <th>Distrito</th>
                                                <th>Codigo Modular</th>
                                                <th>Descripción</th>
                                                <th class="colorfila">2</th>
                                                <th>A</th>
                                                <th>B</th>
                                                <th>C</th>
                                                <th>D</th>
                                                <th>E</th>
                                                <th>F</th>
                                                <th>G</th>
                                                <th>H</th>
                                                <th class="colorfila">4</th>
                                                <th>A</th>
                                                <th>B</th>
                                                <th>C</th>
                                                <th>D</th>
                                                <th>E</th>
                                                <th>F</th>
                                                <th>G</th>
                                                <th>H</th>
                                                <th class="colorfila">6</th>
                                                <th>A</th>
                                                <th>B</th>
                                                <th>C</th>
                                                <th>D</th>
                                                <th>E</th>
                                                <th>F</th>
                                                <th>G</th>
                                                <th>H</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sumarotiagradodos = 0;
                                        $sumarotiagradocuatro = 0;
                                        $sumarotiagradoseis = 0;
                                        $totalbtesmat = $asistencia->consultaiesmatermatica($nivel);
                                        while ($tatesmat = mysqli_fetch_array($totalbtesmat)) {

                                            echo "<tr>";
                                            echo "<td>" . $tatesmat[4] . "</td>";
                                            echo "<td>" . $tatesmat[5] . "</td>";
                                            echo "<td>" . $tatesmat[3] . "</td>";
                                            echo "<td>" . $tatesmat[1] . "</td>";
                                            echo "<td>" . $tatesmat[2] . "</td>";




                                            $totalbtescodg = $asistencia->contardatosmatematicanivelcodg($nivele, $arean, $tatesmat[1], '2');
                                            while ($tatescg = mysqli_fetch_array($totalbtescodg)) {
                                                $toatescg = $tatescg[0];
                                                $sumarotiagradodos = $sumarotiagradodos + $toatescg;
                                            }
                                            echo "<td class='colorfila'>" . $toatescg  . "</td>";


                                            $seca = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'A');
                                            while ($tseca = mysqli_fetch_array($seca)) {
                                                $tsecap = $tseca[0];
                                            }
                                            echo "<td>" . $tsecap . "</td>";

                                            $secb = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'B');
                                            while ($tsecb = mysqli_fetch_array($secb)) {
                                                $tsecbp = $tsecb[0];
                                            }
                                            echo "<td>" . $tsecbp . "</td>";

                                            $secc = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'C');
                                            while ($tsecc = mysqli_fetch_array($secc)) {
                                                $tseccp = $tsecc[0];
                                            }
                                            echo "<td>" . $tseccp . "</td>";

                                            $secd = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'D');
                                            while ($tsecd = mysqli_fetch_array($secd)) {
                                                $tsecdp = $tsecd[0];
                                            }
                                            echo "<td>" . $tsecdp . "</td>";



                                            $sece = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'E');
                                            while ($tsece = mysqli_fetch_array($sece)) {
                                                $tsecep = $tsece[0];
                                            }
                                            echo "<td>" . $tsecep . "</td>";


                                            $secf = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'F');
                                            while ($tsecf = mysqli_fetch_array($secf)) {
                                                $tsecfp = $tsecf[0];
                                            }
                                            echo "<td>" . $tsecfp . "</td>";


                                            $secg = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'G');
                                            while ($tsecg = mysqli_fetch_array($secg)) {
                                                $tsecgp = $tsecg[0];
                                            }
                                            echo "<td>" . $tsecgp . "</td>";


                                            $sech = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '2', 'H');
                                            while ($tsech = mysqli_fetch_array($sech)) {
                                                $tsechp = $tsech[0];
                                            }
                                            echo "<td>" . $tsechp . "</td>";

                                            $totalbtescodga = $asistencia->contardatosmatematicanivelcodg($nivele, $arean, $tatesmat[1], '4');
                                            while ($tatescga = mysqli_fetch_array($totalbtescodga)) {
                                                $toatescga = $tatescga[0];
                                                $sumarotiagradocuatro = $sumarotiagradocuatro + $toatescga;
                                            }
                                            echo "<td class='colorfila'>" . $toatescga  . "</td>";





                                            $secaa = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'A');
                                            while ($tsecaa = mysqli_fetch_array($secaa)) {
                                                $tsecapa = $tsecaa[0];
                                            }
                                            echo "<td>" . $tsecapa . "</td>";

                                            $secbb = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'B');
                                            while ($tsecbb = mysqli_fetch_array($secbb)) {
                                                $tsecbpb = $tsecbb[0];
                                            }
                                            echo "<td>" . $tsecbpb . "</td>";

                                            $seccc = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'C');
                                            while ($tseccc = mysqli_fetch_array($seccc)) {
                                                $tseccpc = $tseccc[0];
                                            }
                                            echo "<td>" . $tseccpc . "</td>";

                                            $secdd = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'D');
                                            while ($tsecdd = mysqli_fetch_array($secdd)) {
                                                $tsecdpd = $tsecdd[0];
                                            }
                                            echo "<td>" . $tsecdpd . "</td>";



                                            $secee = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'E');
                                            while ($tsecee = mysqli_fetch_array($secee)) {
                                                $tsecepe = $tsecee[0];
                                            }
                                            echo "<td>" . $tsecepe . "</td>";


                                            $secff = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'F');
                                            while ($tsecff = mysqli_fetch_array($secff)) {
                                                $tsecfpf = $tsecff[0];
                                            }
                                            echo "<td>" . $tsecfpf . "</td>";


                                            $secgg = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'G');
                                            while ($tsecgg = mysqli_fetch_array($secgg)) {
                                                $tsecgpg = $tsecgg[0];
                                            }
                                            echo "<td>" . $tsecgpg . "</td>";


                                            $sechh = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '4', 'H');
                                            while ($tsechh = mysqli_fetch_array($sechh)) {
                                                $tsechph = $tsechh[0];
                                            }
                                            echo "<td>" . $tsechph . "</td>";



                                            $totalbtescodgav = $asistencia->contardatosmatematicanivelcodg($nivele, $arean, $tatesmat[1], '6');
                                            while ($tatescgav = mysqli_fetch_array($totalbtescodgav)) {
                                                $toatescgav = $tatescgav[0];
                                                $sumarotiagradoseis = $sumarotiagradoseis + $toatescgav;
                                            }
                                            echo "<td class='colorfila'>" . $toatescgav  . "</td>";



                                            $secaaa = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'A');
                                            while ($tsecaaa = mysqli_fetch_array($secaaa)) {
                                                $tsecapaa = $tsecaaa[0];
                                            }
                                            echo "<td>" . $tsecapaa . "</td>";

                                            $secbba = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'B');
                                            while ($tsecbba = mysqli_fetch_array($secbba)) {
                                                $tsecbpba = $tsecbba[0];
                                            }
                                            echo "<td>" . $tsecbpba . "</td>";

                                            $seccca = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'C');
                                            while ($tseccca = mysqli_fetch_array($seccca)) {
                                                $tseccpca = $tseccca[0];
                                            }
                                            echo "<td>" . $tseccpca . "</td>";

                                            $secdda = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'D');
                                            while ($tsecdda = mysqli_fetch_array($secdda)) {
                                                $tsecdpda = $tsecdda[0];
                                            }
                                            echo "<td>" . $tsecdpda . "</td>";



                                            $seceea = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'E');
                                            while ($tseceea = mysqli_fetch_array($seceea)) {
                                                $tsecepea = $tseceea[0];
                                            }
                                            echo "<td>" . $tsecepea . "</td>";


                                            $secffa = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'F');
                                            while ($tsecffa = mysqli_fetch_array($secffa)) {
                                                $tsecfpfa = $tsecffa[0];
                                            }
                                            echo "<td>" . $tsecfpfa . "</td>";


                                            $secgga = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'G');
                                            while ($tsecgga = mysqli_fetch_array($secgga)) {
                                                $tsecgpga = $tsecgga[0];
                                            }
                                            echo "<td>" . $tsecgpga . "</td>";


                                            $sechha = $asistencia->contardatosmatematicanivelseci($nivele, $arean, $tatesmat[1], '6', 'H');
                                            while ($tsechha = mysqli_fetch_array($sechha)) {
                                                $tsechpha = $tsechha[0];
                                            }
                                            echo "<td>" . $tsechpha . "</td>";

                                            $totalestrudi= $toatescg + $toatescga + $toatescgav;
                                            echo "<td>" . $totalestrudi . "</td>";
                                            echo "</tr>";
                                        }

                                        ?>

                                        <tr>
                                            <td colspan="5">Total</td>
                                            <td><?php echo $sumarotiagradodos; ?></td>
                                            <td colspan="8">
                                                <center>--------</center>
                                            </td>
                                            <td><?php echo $sumarotiagradocuatro; ?></td>
                                            <td colspan="8">
                                                <center>--------</center>
                                            </td>
                                            <td><?php echo $sumarotiagradoseis; ?></td>
                                            <td colspan="8">
                                                <center>--------</center>
                                            </td>

                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>