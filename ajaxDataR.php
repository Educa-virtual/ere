<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

        $ugel= $_POST["ugelID"];
        $distritoID= $_POST["distritoID"];
   
        $Listape = $asistencia->iesugel($ugel);
        echo "<option value=''>Seleccione...</option>";
        while ($Lp = mysqli_fetch_array($Listape)) {
            echo '<option value="' . $Lp['distrito'] . '">' . $Lp['distrito'] . '</option>';
        }        
?>