<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;


        $distritoID= $_POST["distritoID"];
        $nivelID= $_POST["nivelID"];
   
        $Listaper = $asistencia->iesdistrito($distritoID,$nivelID);
        echo "<option value=''>Seleccione...</option>";
        while ($Lpr = mysqli_fetch_array($Listaper)) {
            echo '<option value="' . $Lpr['codmodular'] . '">' . $Lpr['descripcion'] . '</option>';
        }
  
 




        
?>