<?php 
  function inject($cad)
  { $nop = array('"','<','>','=','where','select','from','*','inner');
	$cad=str_replace($nop, "", $cad);$cad=trim($cad);return $cad;}
  
  function elimina_car1($cad)//todo en mayusculas
  {  
   $cad=strtoupper($cad);
   $cad = ereg_replace('á|Á', 'A', $cad);//ereg_replace('�|,�''A', $cad);
   $cad = ereg_replace('é|É', 'E', $cad);
   $cad = ereg_replace('í|Í', 'I', $cad);
   $cad = ereg_replace('ó|Ó', 'O', $cad);
   $cad = ereg_replace('Ñ', '&Ntilde;', $cad);//� �
   $cad = ereg_replace('ñ', '&Ntilde;', $cad);//� �
   $cad = ereg_replace('<', '<&nbsp;', $cad);//� �
   $cad = ereg_replace('>', '>&nbsp;', $cad);//� �
   $cad = ereg_replace('¿', '&iquest;', $cad);// �
   $cad = ereg_replace('¡', '&iexcl;', $cad);// �
	 return $cad;
  }
 ?>
