<?php 
  function inject($cad)
  { $nop = array('"','<','>','=','where','select','from','*','inner');
	$cad=str_replace($nop, "", $cad);$cad=trim($cad);return $cad;}
  
  function elimina_car1($cad)//todo en mayusculas
  {  
   $cad=strtoupper($cad);
   $cad = ereg_replace('√°|√Å', 'A', $cad);//ereg_replace('·|,¡''A', $cad);
   $cad = ereg_replace('√©|√â', 'E', $cad);
   $cad = ereg_replace('√≠|√ç', 'I', $cad);
   $cad = ereg_replace('√≥|√ì', 'O', $cad);
   $cad = ereg_replace('√ë', '&Ntilde;', $cad);//— Ò
   $cad = ereg_replace('√±', '&Ntilde;', $cad);//— Ò
   $cad = ereg_replace('<', '<&nbsp;', $cad);//— Ò
   $cad = ereg_replace('>', '>&nbsp;', $cad);//— Ò
   $cad = ereg_replace('¬ø', '&iquest;', $cad);// ø
   $cad = ereg_replace('¬°', '&iexcl;', $cad);// °
	 return $cad;
  }
 ?>
