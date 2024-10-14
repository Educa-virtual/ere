<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

$seleeva= $_POST["seleeva"];
        $niveles= $_POST["niveles"];
        $cursos= $_POST["cursos"];


   
        $Listape = $asistencia->mostrardatosmatrizb($seleeva,$niveles,$cursos);
        echo "<option value=''>Seleccione...</option>";
        while ($Lp = mysqli_fetch_array($Listape)) {
            echo '<option value="' . $Lp[0] . '">' . $Lp[0] . '</option>';
        }
