<?php
require_once "../../modelo/Ere.php";
require_once '../../vendor/autoload.php'; // Incluye la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

// var_dump($_POST);

/* $estado = (strtoupper($_GET['accion'])=="VALIDAR")?'1':'0'; */

$accion = $_GET['accion'];
$historial = $_POST['historial'];

$detalle = $_POST['detalle'];

$codmodular = $_POST['codmodular'];

$area = $_POST['area'];
$ugel = $_POST['ugel'];

$tipo = $_POST['tipo'];
/* $obs=($_POST['obs']!=''?$_POST['obs']:'-'); */

$ere = new Ere;
$examen = $ere->getExamen($historial, $detalle, $codmodular);

$historialBD = $ere->getOne('historial_ere', $historial);
$evaluacion = $historialBD[0]['evaluacion'];

$examen = $examen[0];
if (!is_array($examen)) {
    die('No se encontró el Examen');
}

// Borramos los datos del Examen si existen
$miHistorial = $ere->getDataHistorialIE($evaluacion, $codmodular, $detalle)[0];
$wh = [
    'codmodular' => $miHistorial['codmodular'],
    'nivel' => $miHistorial['nivel'],
    'grado' => $miHistorial['grado'],
    'area' => $miHistorial['area']
];
$ere->eliminarDatosExamen($evaluacion, $wh);
// var_dump($examen); exit;

$error = '';

$inputFileName = '../../' . $examen['examen']; // Ruta al archivo Excel

// Cargar el archivo Excel
$spreadsheet = IOFactory::load($inputFileName);
// $worksheet = $spreadsheet->getActiveSheet();
$worksheet = $spreadsheet->getSheetByName('Consolidado');
if ($worksheet === null) {
    die('Hoja no encontrada.');
}

$startRow = 2; // Suponiendo que los datos comienzan en la fila 5
$highestRow = $worksheet->getHighestRow(); // Obtiene la última fila con datos en la hoja


for ($row = $startRow; $row <= $highestRow; $row++) {
    $miDNI = $worksheet->getCell("C$row")->getValue(); // Obtener el valor de la celda en la columna B
    $miApellido = $worksheet->getCell("D$row")->getValue(); // Obtener el valor de la celda en la columna B
    if (!($miDNI == null && $miApellido == null)) {
        if ($miDNI == null) {
            $miDNI = '99999999';
        }
        if (!is_numeric($miDNI)) {
            die('DNI No válido: ' . $miDNI);
        }
        $sexo = $worksheet->getCell("I$row")->getValue();
        if ($sexo == null || strlen($sexo) == 1) {
            die('Error en Sexo: ' . $sexo);
        }
        // Aqui preparamos todo
        $fecha = $worksheet->getCell("B$row")->getValue();
        if (is_numeric($fecha)) {
            $date = Date::excelToDateTimeObject($fecha);
            $fecha = $date->format('Y-m-d');
        }
        $datos = [
            'fecha' => $fecha,
            'dni' => ($worksheet->getCell("C$row")->getValue() != null) ? $worksheet->getCell("C$row")->getValue() : '',
            'apepat' => ($worksheet->getCell("D$row")->getValue() != null) ? $worksheet->getCell("D$row")->getValue() : '',
            'apemat' => ($worksheet->getCell("E$row")->getValue() != null) ? $worksheet->getCell("E$row")->getValue() : '',
            'nombre1' => ($worksheet->getCell("F$row")->getValue() != null) ? $worksheet->getCell("F$row")->getValue() : '',
            'nombre2' => ($worksheet->getCell("G$row")->getValue() != null) ? $worksheet->getCell("G$row")->getValue() : '',
            'nombre3' => ($worksheet->getCell("H$row")->getValue() != null) ? $worksheet->getCell("H$row")->getValue() : '',
            'sexo' => $sexo,
            'ie' => $worksheet->getCell("J$row")->getValue(),
            'codModular' => $worksheet->getCell("K$row")->getValue(),
            'nivel' => $worksheet->getCell("L$row")->getValue(),
            'distrito' => $worksheet->getCell("M$row")->getValue(),
            'zona' => $worksheet->getCell("N$row")->getValue(),
            'gestion' => $worksheet->getCell("O$row")->getValue(),
            'seccion' => $worksheet->getCell("P$row")->getValue(),
            'r1' => ($worksheet->getCell("Q$row")->getValue() != null) ? trim($worksheet->getCell("Q$row")->getValue()) : '',
            'r2' => ($worksheet->getCell("R$row")->getValue() != null) ? trim($worksheet->getCell("R$row")->getValue()) : '',
            'r3' => ($worksheet->getCell("S$row")->getValue() != null) ? trim($worksheet->getCell("S$row")->getValue()) : '',
            'r4' => ($worksheet->getCell("T$row")->getValue() != null) ? trim($worksheet->getCell("T$row")->getValue()) : '',
            'r5' => ($worksheet->getCell("U$row")->getValue() != null) ? trim($worksheet->getCell("U$row")->getValue()) : '',
            'r6' => ($worksheet->getCell("V$row")->getValue() != null) ? trim($worksheet->getCell("V$row")->getValue()) : '',
            'r7' => ($worksheet->getCell("W$row")->getValue() != null) ? trim($worksheet->getCell("W$row")->getValue()) : '',
            'r8' => ($worksheet->getCell("X$row")->getValue() != null) ? trim($worksheet->getCell("X$row")->getValue()) : '',
            'r9' => ($worksheet->getCell("Y$row")->getValue() != null) ? trim($worksheet->getCell("Y$row")->getValue()) : '',
            'r10' => ($worksheet->getCell("Z$row")->getValue() != null) ? trim($worksheet->getCell("Z$row")->getValue()) : '',
            'r11' => ($worksheet->getCell("AA$row")->getValue() != null) ? trim($worksheet->getCell("AA$row")->getValue()) : '',
            'r12' => ($worksheet->getCell("AB$row")->getValue() != null) ? trim($worksheet->getCell("AB$row")->getValue()) : '',
            'r13' => ($worksheet->getCell("AC$row")->getValue() != null) ? trim($worksheet->getCell("AC$row")->getValue()) : '',
            'r14' => ($worksheet->getCell("AD$row")->getValue() != null) ? trim($worksheet->getCell("AD$row")->getValue()) : '',
            'r15' => ($worksheet->getCell("AE$row")->getValue() != null) ? trim($worksheet->getCell("AE$row")->getValue()) : '',
            'r16' => ($worksheet->getCell("AF$row")->getValue() != null) ? trim($worksheet->getCell("AF$row")->getValue()) : '',
            'r17' => ($worksheet->getCell("AG$row")->getValue() != null) ? trim($worksheet->getCell("AG$row")->getValue()) : '',
            'r18' => ($worksheet->getCell("AH$row")->getValue() != null) ? trim($worksheet->getCell("AH$row")->getValue()) : '',
            'r19' => ($worksheet->getCell("AI$row")->getValue() != null) ? trim($worksheet->getCell("AI$row")->getValue()) : '',
            'r20' => ($worksheet->getCell("AJ$row")->getValue() != null) ? trim($worksheet->getCell("AJ$row")->getValue()) : '',
            'grado' => $worksheet->getCell("AK$row")->getValue(),
            'area' => $area,
            'ugel' => $ugel,
            'dnidoc' => ($worksheet->getCell("AN$row")->getValue() != null) ? trim($worksheet->getCell("AN$row")->getValue()) : 'x22222',
            'apepatdoc' => ($worksheet->getCell("AO$row")->getValue() != null) ? trim($worksheet->getCell("AO$row")->getValue()) : 'xxxxx',
            'apematdoc' => ($worksheet->getCell("AP$row")->getValue() != null) ? trim($worksheet->getCell("AP$row")->getValue()) : 'xxxxx',
            'nombredoc' => ($worksheet->getCell("AQ$row")->getValue() != null) ? trim($worksheet->getCell("AQ$row")->getValue()) : 'xxxxx'
        ];
        //Enviarmos para agregar a Evaluacion

        $data = $ere->guardarRespuestas($evaluacion, $datos);
        if (!$data['success']) {
            $error = $data['error'];
            break;
        } else {
            $error = 'success';
        }
    }
}
if ($error == 'success') {
    $actualizar = $ere->checkUpdateProcesarExamen($historial, $detalle, $codmodular);
    if ($actualizar['success'])
        echo 'Examen procesado con éxito.';
    else
        echo 'Error al procesar el examen.';
} elseif ($error == '') {
    echo 'Examen sin datos!!!';
} else {
    echo $error;
}
