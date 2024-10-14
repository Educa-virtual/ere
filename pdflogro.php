<?php

require 'fpdf/fpdf.php';

require_once "cAdmision.php";
$asistencia = new cAdmision;

$evaluacion =$_GET['evaluacion'];

$cursodesf = $asistencia->descripcionealuacion($evaluacion);
        while ($mascuf = mysqli_fetch_array($cursodesf)) {
            $descursof = $mascuf['descripcion'];
        }

		$consl = 0;
		$matrisrl = $asistencia->listadologro($evaluacion);

class PDF extends FPDF {

// Cabecera de página

	function Header() {
 		$this->SetFont('Times', 'B', 8);
		$this->setXY(8, 2);
		$this->Cell(100, 8, utf8_decode('.:: Dirección Regional de Educación de Moquegua'), 0, 1, 'L', 0);
		$this->Ln(4);
	}

// Pie de página

	function Footer() {
		// Posición: a 1,5 cm del final
        // -----------------------------------Hora y Fecha-------------------
	setlocale(LC_ALL, 'es_PE');
	// Setea el huso horario del servidor...
	date_default_timezone_set("America/Lima");
	$horaas = date('G:i:s');
	$diapublicacion = date("Y-m-d");
	$dia = date("d-m-Y");
	// -----------------------------------Fin Hora y Fecha-------------------
		$this->SetY(-7);
		$this->SetFont('Arial', 'B', 8);
		// Número de página
        $this->Cell(100, 5,'Hora|Dia : '. $horaas.' | '.$dia, 0, 0, 'C', 0);

		$this->Cell(0, 5, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      
	}

}
// Creación del objeto de la clase heredada
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('times', 'B', 12);
$pdf->SetXY(0, 15);
$pdf->Cell(0, 8, utf8_decode('INDICADOR DE LOGRO'), 0, 0, 'C', 0);
$pdf->Ln(10);

$pdf->setXY(10, 25);
$pdf->SetFillColor(213, 211, 211);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(50, 8, utf8_decode('EVALUACIÓN'), 1, 0, 'C', 'true');
$pdf->Cell(50, 8, utf8_decode(strtoupper($descursof)), 1, 0, 'C', 0);
$pdf->Ln(4);
$datn=13;
$rean=21;
$pdf->setXY(10, 35);
$pdf->SetFont('Times', 'B', 8.5);
$pdf->SetFillColor(213, 211, 211);
$pdf->Cell(7, 8, utf8_decode('Nro'), 1, 0, 'C', 'true');
$pdf->Cell(19, 8, utf8_decode('Nivel'), 1, 0, 'C', 'true');
$pdf->Cell(40, 8, utf8_decode('Area'), 1, 0, 'C', 'true');
$pdf->Cell(11, 8, utf8_decode('Grado'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel 1'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel 1'), 1, 0, 'C', 'true');
$pdf->Cell($rean, 8, utf8_decode('Resultado 1'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  2'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  2'), 1, 0, 'C', 'true');
$pdf->Cell($rean, 8, utf8_decode('Resultado 2'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  3'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  3'), 1, 0, 'C', 'true');
$pdf->Cell($rean, 8, utf8_decode('Resultado 3'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  4'), 1, 0, 'C', 'true');
$pdf->Cell($datn, 8, utf8_decode('Nivel  4'), 1, 0, 'C', 'true');
$pdf->Cell($rean, 8, utf8_decode('Resultado 4'), 1, 0, 'C', 'true');
$pdf->Cell(12, 8, utf8_decode('Nivel'), 1, 1, 'C', 'true');

while ($masil = mysqli_fetch_array($matrisrl)) {
	$consl = $consl + 1;
	$pdf->SetFillColor(249, 249, 249 );
	$pdf->Cell(7, 8, utf8_decode($consl), 1, 0, 'C', 'true');
	$pdf->Cell(19, 8, utf8_decode($masil['idnivel']), 1, 0, 'C', 'true');
	$pdf->Cell(40, 8, utf8_decode($masil['descripcionarea']), 1, 0, 'C', 'true');
	$pdf->Cell(11, 8, utf8_decode($masil['grado']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['iniciala']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['finala']), 1, 0, 'C', 'true');
	$pdf->Cell($rean, 8, utf8_decode($masil['resultadoa']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['inicialb']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['finalb']), 1, 0, 'C', 'true');
	$pdf->Cell($rean, 8, utf8_decode($masil['resultadob'] ), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['inicialc']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['finalc']), 1, 0, 'C', 'true');
	$pdf->Cell($rean, 8, utf8_decode($masil['resultadoc']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['iniciald']), 1, 0, 'C', 'true');
	$pdf->Cell($datn, 8, utf8_decode($masil['finald']), 1, 0, 'C', 'true');
	$pdf->Cell($rean, 8, utf8_decode($masil['resultadod']), 1, 0, 'C', 'true');

	if ($masil['calinivel'] == 0) {
		$pdf->Cell(12, 8, utf8_decode(''), 1, 1, 'C', 'true');
	} else {
		$pdf->Cell(12, 8, utf8_decode('Si'), 1, 1, 'C', 'true');
	}


  }



$pdf->Output();

?>