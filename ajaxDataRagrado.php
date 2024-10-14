<?php

require_once "cAdmision.php";
$asistencia = new cAdmision;

        $nivelID= $_POST["nivelID"];
   
        $Listapera = $asistencia->iesgrado($nivelID);
        echo "<option value=''>Seleccione...</option>";
        while ($Lpra = mysqli_fetch_array($Listapera)) {
            echo '<option value="' . $Lpra['grado'] . '">' . $Lpra['grado'] . '</option>';
        }
  
 

 


        
?>