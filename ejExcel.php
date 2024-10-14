<?php

require_once "../../modelo/Ere.php";
require 'vendor/autoload.php'; // Incluye la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;


$inputFileName = 'archivos/1/2SecundariaCyTecnologiaP.xlsm'; // Ruta al archivo Excel


// Cargar el archivo Excel
$spreadsheet = IOFactory::load($inputFileName);
// $worksheet = $spreadsheet->getActiveSheet();
$worksheet = $spreadsheet->getSheetByName('Consolidado');
if ($worksheet === null) {
    die('Hoja no encontrada.');
}
// Recorrer las filas del archivo Excel
/* foreach ($worksheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); 

    $data = [];
    foreach ($cellIterator as $cell) {
        $data[] = $cell->getValue();
    }


} */
/* $range = 'A2:E10';
$data = $worksheet->rangeToArray(
    $range,     // El rango de celdas que deseas leer
    null,       // Valor para las celdas vacías
    true,       // Calcular las fórmulas
    true,       // Formatear los valores según se muestran en Excel
    true        // Retornar las claves de las filas y columnas como valores de array
); */

// Iterar sobre las filas para detectar la primera fila sin datos en la columna C
$startRow = 2; // Suponiendo que los datos comienzan en la fila 5
$highestRow = $worksheet->getHighestRow(); // Obtiene la última fila con datos en la hoja
echo "Total filas: $highestRow <br>";
$emptyRow = null;

for ($row = $startRow; $row <= $highestRow; $row++) {
    $dateValue = $worksheet->getCell("B$row")->getValue(); // Obtener el valor de la celda en la columna B
    echo " Dato: $dateValue<br>";
    // Convertir la fecha de dd/mm/yyyy a yyyy-mm-dd
    /* if (!empty($dateValue)) { */
    if (is_numeric($dateValue)) {
        // $date = DateTime::createFromFormat('d/m/Y', $dateValue);
        $date = Date::excelToDateTimeObject($dateValue);
        if ($date) {
            $formattedDate = $date->format('Y-m-d');
            echo "Fecha original: $dateValue -> Fecha formateada: $formattedDate<br>";

            // Aquí puedes usar $formattedDate para insertar en la base de datos
        } else {
            echo "Error al convertir la fecha en la fila $row<br>";
        }
    } else {
        echo "La celda de la fila $row está vacía<br>";
    }
}

/* echo "Datos importados con éxito"; */

//var_dump($data);
?>
