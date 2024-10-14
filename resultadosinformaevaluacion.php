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
        </style>
    </head>

    <body>



        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        $nivele = $_POST['nivele'];
        ?>

        <div class="row">
            <div class="col-sm-12 col-md-12">

                <div class="card">
                    <h6 class="card-header">.:: Resultado</h6>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-2">

                                <?php
                                $totalta = $asistencia->datacompletaconciste($nivele);
                                while ($to = mysqli_fetch_array($totalta)) {
                                    $totaldat = $to[0];
                                } ?>




                                <div class="alert alert-success" role="alert">
                                    <h6 class="alert-heading">Registros:</h6>
                                    <hr>
                                    <h4 class="alert-heading"><?php
                                                                echo $totaldat;
                                                                ?></h4>
                                </div>

                            </div>

                            <div class="col-2">


                                <div class="alert alert-warning" role="alert">
                                    <h6 class="alert-heading">UGEL:</h6>
                                    <hr>
                                    <p class="mb-0">
                                    <table class="table table-striped table-sm  letramenub">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $variablea = 'ugel';
                                        $campoa = 'ugel';
                                        $sumartriaa = 0;
                                        $totaltab = $asistencia->consultacompleta($variablea);
                                        while ($tou = mysqli_fetch_array($totaltab)) {
                                            echo "<tr>";
                                            echo "<td>" . $tou[1] . "</td>";

                                            $totalb = $asistencia->contardatos($nivele, $campoa, $tou[0]);
                                            while ($ta = mysqli_fetch_array($totalb)) {
                                                $toa = $ta[0];
                                                $sumartriaa = $sumartriaa + $toa;
                                            }
                                            echo "<td>" . $toa . "</td>";
                                            echo "</tr>";
                                        } ?>
                                        <tr>
                                            <td>Total</td>
                                            <td><?php echo $sumartriaa; ?></td>
                                        </tr>
                                    </table>

                                    </p>
                                </div>
                            </div>

                            <div class="col-2">


                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading">NIVEL:</h6>
                                    <hr>
                                    <p class="mb-0">

                                    <table class="table table-striped table-sm letramenub ">

                                        <thead>
                                            <tr>
                                                <th>Nivel</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>


                                        <tr>
                                            <?php
                                            $campob = 'nivel';
                                            $totalbV = $asistencia->contardatos($nivele, $campob, 'PRIMARIA');
                                            while ($taV = mysqli_fetch_array($totalbV)) {
                                                $toaV = $taV[0];
                                            }
                                            $campob = 'nivel';
                                            $totalbVF = $asistencia->contardatos($nivele, $campob, 'SECUNDARIA');
                                            while ($taVF = mysqli_fetch_array($totalbVF)) {
                                                $toaVF = $taVF[0];
                                            }

                                            $SUTOTAL = $toaV + $toaVF;
                                            ?>
                                        <tr>
                                            <td>PRIMARIA</td>
                                            <td><?PHP echo $toaV; ?></td>
                                        </tr>

                                        <td>SECUNDARIA</td>
                                        <td><?PHP echo $toaVF; ?></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?PHP echo $SUTOTAL; ?></td>
                                        </tr>
                                    </table>

                                    </p>
                                </div>

                            </div>

                            <div class="col-2">


                                <div class="alert alert-light" role="alert">
                                    <h6 class="alert-heading">ZONA:</h6>
                                    <hr>
                                    <p class="mb-0">

                                    <table class="table table-striped table-sm letramenub ">

                                        <thead>
                                            <tr>
                                                <th>Zona</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>


                                        <tr>
                                            <?php
                                            $campoc = 'zona';
                                            $totalbVw = $asistencia->contardatos($nivele, $campoc, 'Urbano');
                                            while ($taVw = mysqli_fetch_array($totalbVw)) {
                                                $toaVw = $taVw[0];
                                            }
                                            $totalbVFq = $asistencia->contardatos($nivele, $campoc, 'Rural');
                                            while ($taVFq = mysqli_fetch_array($totalbVFq)) {
                                                $toaVFq = $taVFq[0];
                                            }

                                            $SUTOTALq = $toaVw + $toaVFq;
                                            ?>
                                        <tr>
                                            <td>Urbano</td>
                                            <td><?PHP echo $toaVw; ?></td>
                                        </tr>

                                        <td>Rural</td>
                                        <td><?PHP echo $toaVFq; ?></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?PHP echo $SUTOTALq; ?></td>
                                        </tr>
                                    </table>
                                    </p>
                                </div>



                            </div>


                            <div class="col-2">

                                <div class="alert alert-success" role="alert">
                                    <h6 class="alert-heading">Gestión:</h6>
                                    <hr>
                                    <p class="mb-0">

                                    <table class="table table-striped table-sm letramenub ">
                                        <thead>
                                            <tr>
                                                <th>Gestión</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <?php
                                            $campoe = 'gestion';
                                            $totalbVwq = $asistencia->contardatos($nivele, $campoe, 'Pública');
                                            while ($taVwq = mysqli_fetch_array($totalbVwq)) {
                                                $toaVwq = $taVwq[0];
                                            }
                                            $totalbVFqe = $asistencia->contardatos($nivele, $campoe, 'Privada');
                                            while ($taVFqe = mysqli_fetch_array($totalbVFqe)) {
                                                $toaVFqe = $taVFqe[0];
                                            }

                                            $SUTOTALqe = $toaVwq + $toaVFqe;
                                            ?>
                                        <tr>
                                            <td>Pública</td>
                                            <td><?PHP echo $toaVwq; ?></td>
                                        </tr>

                                        <td>Privada</td>
                                        <td><?PHP echo $toaVFqe; ?></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?PHP echo $SUTOTALqe; ?></td>
                                        </tr>
                                    </table>
                                    </p>
                                </div>
                            </div>





                            <div class="col-2">

                                <div class="alert alert-success" role="alert">
                                    <h6 class="alert-heading">sexo:</h6>
                                    <hr>
                                    <p class="mb-0">

                                    <table class="table table-striped table-sm letramenub ">
                                        <thead>
                                            <tr>
                                                <th>sexo</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <?php
                                            $campoe = 'sexo';
                                            $totalbVwqv = $asistencia->contardatos($nivele, $campoe, 'Femenino');
                                            while ($taVwqv = mysqli_fetch_array($totalbVwqv)) {
                                                $toaVwqv = $taVwqv[0];
                                            }
                                            $totalbVFqeg = $asistencia->contardatos($nivele, $campoe, 'Masculino');
                                            while ($taVFqeg = mysqli_fetch_array($totalbVFqeg)) {
                                                $toaVFqeg = $taVFqeg[0];
                                            }

                                            $SUTOTALqev = $toaVwqv + $toaVFqeg;
                                            ?>
                                        <tr>
                                            <td>Femenino</td>
                                            <td><?PHP echo $toaVwqv; ?></td>
                                        </tr>

                                        <td>Masculino</td>
                                        <td><?PHP echo $toaVFqeg; ?></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?PHP echo $SUTOTALqev; ?></td>
                                        </tr>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>




                        <div class="row">

                            <div class="col-2">

                                <div class="alert alert-primary" role="alert">
                                    <h6 class="alert-heading">DISTRITO:</h6>
                                    <hr>
                                    <p class="mb-0">
                                    <table class="table table-striped table-sm  letramenub">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $varid = 'distrito';
                                        $caad = 'distrito';
                                        $sumartriaatz = 0;
                                        $totdz = $asistencia->consultacompleta($varid);
                                        while ($tudz = mysqli_fetch_array($totdz)) {
                                            echo "<tr>";
                                            echo "<td>" . $tudz[2] . "</td>";

                                            $totabtz = $asistencia->contardatos($nivele, $caad, $tudz[2]);
                                            while ($tatz = mysqli_fetch_array($totabtz)) {
                                                $toatz = $tatz[0];
                                                $sumartriaatz = $sumartriaatz + $toatz;
                                            }
                                            echo "<td>" . $toatz . "</td>";
                                            echo "</tr>";
                                        } ?>
                                        <tr>
                                            <td>Total</td>
                                            <td><?php echo $sumartriaatz; ?></td>
                                        </tr>
                                    </table>

                                    </p>
                                </div>
                            </div>



                            <div class="col-6">

                                <div class="alert alert-secondary" role="alert">
                                    <h6 class="alert-heading">INSTITUCIÓN EDUCATIVA:</h6>
                                    <hr>
                                    <p class="mb-0">
                                    <table class="table table-striped table-sm  letramenub table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            <th>DISTRITO</th>  
                                            <th>UGEL</th>
                                            <th>NIVEL</th>      
                                            <th>DESCRIPCIÓN</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $variablead = 'ies';
                                        $campoae = 'codigomodular';
                                        $sumartriaate = 0;
                                        $totaltabdo = $asistencia->consultacompleta($variablead);
                                        while ($toudg = mysqli_fetch_array($totaltabdo)) {
                                            echo "<tr>";
                                            echo "<td>" . $toudg[3] ."</td>";
                                            echo "<td>" . $toudg[4] ."</td>";
                                            echo "<td>" . $toudg[5] ."</td>";
                                            echo "<td>" . $toudg[1] . " | " . $toudg[2] . "</td>";

                                            $totalbte = $asistencia->contardatos($nivele, $campoae, $toudg[1]);
                                            while ($tate = mysqli_fetch_array($totalbte)) {
                                                $toate = $tate[0];
                                                $sumartriaate = $sumartriaate + $toate;
                                            }
                                            echo "<td>" . $toate . "</td>";
                                            echo "</tr>";
                                        } ?>
                                        <tr>
                                            <td colspan="4">Total</td>
                                            <td><?php echo $sumartriaate; ?></td>
                                        </tr>
                                    </table>

                                    </p>
                                </div>
                            </div>


                            <div class="col-4">

<div class="alert alert-danger" role="alert">
    <h6 class="alert-heading">AREA:</h6>
    <hr>
    <p class="mb-0">
    <table class="table table-striped table-sm  letramenub">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Total</th>
            </tr>
        </thead>

        <?php
        $variableady = 'area';
        $campoaey = 'area';
        $sumartriaatey = 0;
        $totaltabdoy = $asistencia->consultacompleta($variableady);
        while ($toudgy = mysqli_fetch_array($totaltabdoy)) {
            echo "<tr>";
            echo "<td>" . $toudgy[1] . "</td>";

            $totalbtey = $asistencia->contardatos($nivele, $campoaey, $toudgy[0]);
            while ($tatey = mysqli_fetch_array($totalbtey)) {
                $toatey = $tatey[0];
                $sumartriaatey = $sumartriaatey + $toatey;
            }
            echo "<td>" . $toatey . "</td>";
            echo "</tr>";
        } ?>
        <tr>
            <td>Total</td>
            <td><?php echo $sumartriaatey; ?></td>
        </tr>
    </table>

    </p>
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