<?php
date_default_timezone_set('America/Lima');

function estoyATiempo($fechaVencimiento) : bool {
    $hoy = new DateTime();
    $hoy->setTime(0, 0, 0); // Establecer hora a 23:59:59
    $vencimiento = new DateTime($fechaVencimiento);
    $vencimiento->setTime(23, 59, 59); // Establecer hora a medianoche
    
    return $hoy <= $vencimiento;
}

function formatoFecha($fecha): string {
    $fechaObj = new DateTime($fecha);
    $diaSemana = [
        'Mon' => 'lunes,',
        'Tue' => 'martes, ',
        'Wed' => 'miércoles, ',
        'Thu' => 'jueves, ',
        'Fri' => 'viernes, ',
        'Sat' => 'sábado, ',
        'Sun' => 'domingo, '
    ];
    $diaSemanaFormateado = $diaSemana[$fechaObj->format('D')];
    return $diaSemanaFormateado.  $fechaObj->format('d/m/Y');
}
function formatearNumero($numero,$decimiales = 2) : string {
    return number_format($numero, $decimiales, ',', ' ');
    
}
function getArrayFromGET($texto,$caracter='|') : array {
   return explode($caracter, $texto);
}
