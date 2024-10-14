<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

$seleeva= $_POST["seleeva"];

   
        $Listape = $asistencia->regitroalto($seleeva);

        while ($Lpf = mysqli_fetch_array($Listape)) {
            $total=$Lpf[0];
        }
        echo $total;
        ?>
