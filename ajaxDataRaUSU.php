<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

$ugelID= $_POST["ugelID"];
        $distritoID= $_POST["distritoID"];
        $nivelID= $_POST["nivelID"];
   
        $Listaperq = $asistencia->veriesfilro($distritoID,$ugelID,$nivelID);
        echo "<option value=''>Seleccione...</option>";
        while ($Lpr = mysqli_fetch_array($Listaperq)) {
            echo '<option value="' . $Lpr['codmodular'] . '">' . $Lpr['descripcion'] . '</option>';
        }
