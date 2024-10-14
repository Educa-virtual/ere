<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

$seleeva= $_POST["seleeva"];
        $niveles= $_POST["niveles"];
   
        $Listape = $asistencia->mostrardatosmatriz($seleeva,$niveles);
        echo "<option value=''>Seleccione...</option>";
        while ($Lp = mysqli_fetch_array($Listape)) {
            echo '<option value="' . $Lp[1] . '">' . $Lp[0] . '</option>';
        }
