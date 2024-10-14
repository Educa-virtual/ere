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
        $evaugel = $_POST['evaugel'];
        $nivel = $_POST['nivel'];
        $gradoc = $_POST['gradoc'];



        //-----------------Descripcion UGEL--------------------------------
        $cursodesg = $asistencia->ugelre($evaugel);
        while ($mascuf = mysqli_fetch_array($cursodesg)) {
            $desugel = $mascuf['ugeldescripcion'];
        }

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
Evaluación : <B><?PHP ECHO $desugelq;?></B>  | UGEL : <B><?PHP ECHO $desugel;?></B> | NIVEL : <B><?PHP ECHO $nivel;?></B> |GRADO:<B><?PHP ECHO $gradoc;?></B>
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
                                                <th >NIVEL</th>
                                                <th >CODIGO MODULAR</th>
                                                <th >IE</th>
                                                <th >TOTAL REGISTROS</th>
                                                <th >Ciencias Sociales</th>
                                                <th >Ciencia y Tecnología </th>
                                                <th >Comunicación - Lectura </th>
                                                <th >DPCC - Ciudadania</th>
                                                <th >Personal Social</th>
                                                <th >Matematica</th>
                                                <th ># de Alumnos</th>
  
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
                                        $conteogeneral=0;
                                        $totaltabdo = $asistencia->consultaconsolidado($evaugel,$nivel);
                                        while ($toudg = mysqli_fetch_array($totaltabdo)) {
                                            echo "<tr>";
                                            echo "<td>" . $toudg[5] . "</td>";
                                            echo "<td>" . $toudg[1] . "</td>";
                                            echo "<td>" . $toudg[2] . "</td>";
    
                                            $totalbte = $asistencia->contardatosmivel($nivele, $campoae, $toudg[1],$gradoc);
                                            while ($tate = mysqli_fetch_array($totalbte)) {
                                                $toate = $tate[0];
                                                $sumartriaate = $sumartriaate + $toate;
                                            }
                                            echo "<td>" . $toate . "</td>";

                                            $totalbteqw = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'ciensoc');
                                            while ($tatew = mysqli_fetch_array($totalbteqw)) {
                                                $toatew = $tatew[0];
                                                $sumartriaatew = $sumartriaatew + $toatew;
                                            }
                                            echo "<td>" . $toatew . "</td>";


                                            $totalbteqwa = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'cientec');
                                            while ($tatewa = mysqli_fetch_array($totalbteqwa)) {
                                                $toatewa = $tatewa[0];
                                                $sumartriaatewa = $sumartriaatewa + $toatewa;
                                            }
                                            echo "<td>" . $toatewa . "</td>";

                                            $totalbteqwar = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'comlec');
                                            while ($tatewar = mysqli_fetch_array($totalbteqwar)) {
                                                $toatewar = $tatewar[0];
                                                $sumartriaatewar = $sumartriaatewar + $toatewar;
                                            }
                                            echo "<td>" . $toatewar . "</td>";

                                            $totalbteqware = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'dpcc');
                                            while ($tateware = mysqli_fetch_array($totalbteqware)) {
                                                $toateware = $tateware[0];
                                                $sumartriaateware = $sumartriaateware + $toateware;
                                            }
                                            echo "<td>" . $toateware . "</td>";

                                            $totalbteqwaree = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'persoc');
                                            while ($tatewaree = mysqli_fetch_array($totalbteqwaree)) {
                                                $toatewaree = $tatewaree[0];
                                                $sumartriaatewaree = $sumartriaatewaree + $toatewaree;
                                            }
                                            echo "<td>" . $toatewaree . "</td>";

                                            $totalbteqwareey = $asistencia->contardatosevarea($nivele,$gradoc,$evaugel,$toudg[1],'mat');
                                            while ($tatewareey = mysqli_fetch_array($totalbteqwareey)) {
                                                $toatewareey = $tatewareey[0];
                                                $sumartriaatewareey = $sumartriaatewareey + $toatewareey;
                                            }
                                            echo "<td>" . $toatewareey . "</td>";

                                            if($toatew  !=  0)
                                            {
                                                $diva=1;
                                            }else
                                            {
                                                $diva=0; 
                                            }
                                            if($toatewar  !=  0)
                                            {
                                                $divb=1;
                                            }else
                                            {
                                                $divb=0; 
                                            }

                                            if($toateware  !=  0)
                                            {
                                                $divc=1;
                                            }else
                                            {
                                                $divc=0; 
                                            }

                                            if($toatewaree  !=  0)
                                            {
                                                $divd=1;
                                            }else
                                            {
                                                $divd=0; 
                                            }

                                            if($toatewareey  !=  0)
                                            {
                                                $dive=1;
                                            }else
                                            {
                                                $dive=0; 
                                            }
                                            
                                            if($toatewa  !=  0)
                                            {
                                                $divf=1;
                                            }else
                                            {
                                                $divf=0; 
                                            }
                                                $divicion= $diva + $divb + $divc +$divd +$dive+ $divf;
                                                
                                              if($divicion == 0)
                                              {
                                                $promedio =  0;
                                              }else
                                              {
                                                $promedio =  ($toatew + $toatewar + $toateware +$toatewaree+ $toatewareey +$toatewa)/$divicion;
                                              }  
                                            
                                            
                                            echo "<td>" . $promedio . "</td>";
                                            $conteogeneral=$conteogeneral+$promedio;
                                            echo "</tr>";
                                        } ?>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td><?php echo $sumartriaate; ?></td>
                                            <td><?php echo $sumartriaatew; ?></td>
                                            <td><?php echo $sumartriaatewa; ?></td>
                                            <td><?php echo $sumartriaatewar; ?></td>
                                            <td><?php echo $sumartriaateware; ?></td>
                                            <td><?php echo $sumartriaatewaree; ?></td>
                                            <td><?php echo $sumartriaatewareey; ?></td>
                                            <td><?php echo $conteogeneral; ?></td>
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