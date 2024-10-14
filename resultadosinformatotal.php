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

        $nivel = $_POST['nivel'];
        $gradoc = $_POST['gradoc'];




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
                        <div class="alert alert-secondary" role="alert">
Evaluación : <B><?PHP ECHO $desugelq;?></B>  |  | NIVEL : <B><?PHP ECHO $nivel;?></B> |GRADO:<B><?PHP ECHO $gradoc;?></B>
</div>
                    
                    </div>
                            <div class="col-12">

                                <div class="alert alert-warning" role="alert">
                                    <h6 class="alert-heading">INSTITUCIÓN EDUCATIVA:</h6>
                                    <hr>
                                    <p class="mb-0">
                                    <table class="table table-striped table-sm  letramenub table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th >GRADO</th>
                                                <th >TOTAL</th>
                                                <th >%</th>
                                                             
  
                                        </thead>


                                        <?php
                                        $variablead = 'ies';
                                        $campoae = 'codigomodular';
                                        $sumartriaate = 0;
                                        $sumartriaatew=0;
                                        $sumartriaatewa=0;
                                        $sumartriaatewar=0;
                                        $sumartriaateware=0;
                                        $sumartriaatewaree=0;
                                        $sumartriaatewareey=0;

                                        $totalbteh = $asistencia->contargradostotal($nivele,$nivel,$gradoc);
                                        while ($tateh = mysqli_fetch_array($totalbteh)) {
                                            $toateh = $tateh[0];
                                           
                                        }
                                        


                                        $totalbtew = $asistencia->areastotales();
                                            while ($tatew = mysqli_fetch_array($totalbtew)) {
                                                
                                                echo "<td>" . $tatew[1] . "</td>";

                                                $totalbte = $asistencia->contargrados($nivele,$nivel,$gradoc,$tatew[0]);
                                                while ($tate = mysqli_fetch_array($totalbte)) {
                                                    $toate = $tate[0];
                                                    $sumartriaate = $sumartriaate + $toate;
                                                }
                                                echo "<td>" . $toate . "</td>";
                                                $por=round(($toate * 100) / $toateh,1);
                                                echo "<td>" . $por. "</td>";
                                                $sumartriaatew=$sumartriaatew+$por;
                                            echo "</tr>";
                                        } ?>
                                       <tr>
                                            <td >Total</td>
                                            <td><?php echo $sumartriaate; ?></td>
                                            <td><?php echo $sumartriaatew; ?></td>
                                  
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