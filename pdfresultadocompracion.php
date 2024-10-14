<?php

require 'fpdf/fpdf.php';

require_once "cAdmision.php";
$asistencia = new cAdmision;

$curso = $_POST['curso'];
$nivel = $_POST['nivel'];
$grado = $_POST['grado'];
$ugel = $_POST['ugel'];
$gestion = $_POST['gestion'];
$zona = $_POST['zona'];
$distrito = $_POST['distrito'];
$sexo = $_POST['sexo'];
$seccion = $_POST['seccion'];
$ie = $_POST['ie'];
$evaluaci = $_POST['evaluaci'];

$anoa = $_POST['anoa'];
$anob = $_POST['anob'];

$imagena = $_POST['imagena'];
$imga = explode(',', $imagena, 2)[1];
$pica = 'data://text/plain;base64,' . $imga;


$imagenb = $_POST['imagenb'];
$imgb = explode(',', $imagenb, 2)[1];
$picb = 'data://text/plain;base64,' . $imgb;



		$desinicial = $_POST['desnombresinicial'];
		$desfinal = $_POST['desnombresfinal'];


$texta1 = $_POST['texta1'];
$respa1 = $_POST['respa1'];
$pora1 = $_POST['pora1'].'%';
$respa2 = $_POST['respa2'];
$pora2 = $_POST['pora2'].'%';


$texta11 = $_POST['texta11'];
$respa11 = $_POST['respa11'];
$pora11 = $_POST['pora11'].'%';
$respa21 = $_POST['respa21'];
$pora21 = $_POST['pora21'].'%';

$texta12 = $_POST['texta12'];
$respa12 = $_POST['respa12'];
$pora12 = $_POST['pora12'].'%';
$respa22 = $_POST['respa22'];
$pora22 = $_POST['pora22'].'%';

$texta14 = $_POST['text4'];
$respa14 = $_POST['resp14'];
$pora14 = $_POST['pord14'].'%';
$respa24 = $_POST['resp24'];
$pora24 = $_POST['pord24'].'%';


$sumatoriofinacf = $_POST['sumatoriofinacf'];
$porcenajefinalcf = $_POST['porcenajefinalcf'].'%';
$sumatoriofinacfc = $_POST['sumatoriofinacfc'];
$porcenajefinalcfc = $_POST['porcenajefinalcfc'].'%';





//-----------------Descripcion UGEL--------------------------------
if ($ugel == '') {
	$desugel = '--';
} else {
	$cursodesg = $asistencia->ugelre($ugel);
	while ($mascuf = mysqli_fetch_array($cursodesg)) {
		$desugel = $mascuf['ugeldescripcion'];
	}
}

//-----------------Descripcion AREA--------------------------------
$cursodes = $asistencia->iesareasdes($curso);
while ($mascu = mysqli_fetch_array($cursodes)) {
	$descurso = $mascu['descripcionarea'];
}

if ($ie == '') {
	$desies = '--';
} else {

	//-----------------Descripcion IE--------------------------------
	$cursodesnrq = $asistencia->mostracolegio($ie);
	while ($mascuwq = mysqli_fetch_array($cursodesnrq)) {
		$desies = $mascuwq['descripcion'];
	}
}



$cursodesf = $asistencia->descripcionealuacion($evaluaci);
while ($mascuf = mysqli_fetch_array($cursodesf)) {
	$descursof = $mascuf['descripcion'];
}


class PDF extends FPDF
{

	// Cabecera de página

	function Header()
	{
		$this->SetFont('Times', 'B', 8);
		$this->setXY(8, 2);
		$this->Cell(100, 8, utf8_decode('.:: Dirección Regional de Educación de Moquegua'), 0, 1, 'L', 0);
		$this->Ln(4);
	}

	// Pie de página

	function Footer()
	{
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
		$this->Cell(100, 5, 'Hora|Dia : ' . $horaas . ' | ' . $dia, 0, 0, 'C', 0);
		$this->Cell(0, 5, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}


//--------------TERMINA BASE DE DATOS-----------------------------------------------




// Creación del objeto de la clase heredada
$pdf = new PDF('p', 'mm', 'A4'); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('times', 'B', 14);
$pdf->SetXY(0, 9);
$pdf->Cell(0, 8, utf8_decode('RESULTADO COMPARATIVO POR EVALUACIÓN'), 0, 0, 'C', 0);
$pdf->Ln(10);

$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetFillColor(213, 211, 211);
$cndato=48;
$pdf->Cell($cndato, 6, utf8_decode('EVALUACIÓN'), 1, 0, 'C', 'true');
$pdf->Cell($cndato, 6, utf8_decode($desinicial), 1, 0, 'C',0);
$pdf->Cell($cndato, 6, utf8_decode('EVALUACIÓN'), 1, 0, 'C', 'true');
$pdf->Cell($cndato, 6, utf8_decode($desfinal), 1, 1, 'C',0);
$pdf->Ln(3);

$anchoq=48;
$anchoqc=25;
$pdf->Cell($anchoq, 6, utf8_decode('Nivel'), 1, 0, 'C', 'true');
$pdf->Cell($anchoq, 6, utf8_decode('Area'), 1, 0, 'C', 'true');
$pdf->Cell($anchoq, 6, utf8_decode('UGEL'), 1, 0, 'C', 'true');
$pdf->Cell($anchoq, 6, utf8_decode('Distrito'), 1, 1, 'C', 'true');
$pdf->Cell($anchoq, 6, utf8_decode($nivel), 1, 0, 'C', 0);
$pdf->Cell($anchoq, 6, utf8_decode($descurso), 1, 0, 'C', 0);
$pdf->Cell($anchoq, 6, utf8_decode($desugel), 1, 0, 'C', 0);
$pdf->Cell($anchoq, 6, utf8_decode($distrito), 1, 1, 'C', 0);

$pdf->Cell(92, 6, utf8_decode('I.E.'), 1, 0, 'C', 'true');
$pdf->Cell($anchoqc, 6, utf8_decode('Gestión'), 1, 0, 'C', 'true');
$pdf->Cell($anchoqc, 6, utf8_decode('Zona'), 1, 0, 'C', 'true');
$pdf->Cell($anchoqc, 6, utf8_decode('Sec.'), 1, 0, 'C', 'true');
$pdf->Cell($anchoqc, 6, utf8_decode('Sexo'), 1, 1, 'C', 'true');

$pdf->Cell(92, 6, utf8_decode($ie . " - " .  $desies), 1, 0, 'C', 0);
$pdf->Cell($anchoqc, 6, utf8_decode($gestion), 1, 0, 'C', 0);
$pdf->Cell($anchoqc, 6, utf8_decode($zona), 1, 0, 'C', 0);
$pdf->Cell($anchoqc, 6, utf8_decode($seccion), 1, 0, 'C', 0);
$pdf->Cell($anchoqc, 6, utf8_decode($sexo), 1, 1, 'C', 0);

$pdf->Image($pica, 10, 54, 196, 0, 'png');

$pdf->Image($picb, 10, 90, 196, 0, 'png');

$anchoqcnu=39;

$pdf->Ln(80);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(39, 6, utf8_decode('NIVEL DE LOGRO'), 1, 0, 'C', 'true');
$pdf->Cell(78, 6, utf8_decode($desinicial), 1, 0, 'C', 'true');
$pdf->Cell(78, 6, utf8_decode($desfinal), 1, 1, 'C', 'true');
$pdf->Cell($anchoqcnu, 6, utf8_decode($texta1), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa1), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora1), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa2), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora2), 1, 1, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($texta11), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa11), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora11), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa21), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora21), 1, 1, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($texta12), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa12), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora12), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($respa22), 1, 0, 'C', 0);
$pdf->Cell($anchoqcnu, 6, utf8_decode($pora22), 1, 1, 'C', 0);


if ($texta14 == '')
{

}else{
	$pdf->Cell($anchoqcnu, 6, utf8_decode($texta14), 1, 0, 'C', 0);
	$pdf->Cell($anchoqcnu, 6, utf8_decode($respa14), 1, 0, 'C', 0);
	$pdf->Cell($anchoqcnu, 6, utf8_decode($pora14), 1, 0, 'C', 0);
	$pdf->Cell($anchoqcnu, 6, utf8_decode($respa24), 1, 0, 'C', 0);
	$pdf->Cell($anchoqcnu, 6, utf8_decode($pora24), 1, 1, 'C', 0);
}



$pdf->Cell($anchoqcnu, 6, utf8_decode('TOTAL'), 1, 0, 'C', 'true');
$pdf->Cell($anchoqcnu, 6, utf8_decode($sumatoriofinacf), 1, 0, 'C', 'true');
$pdf->Cell($anchoqcnu, 6, utf8_decode($porcenajefinalcf), 1, 0, 'C', 'true');
$pdf->Cell($anchoqcnu, 6, utf8_decode($sumatoriofinacfc), 1, 0, 'C', 'true');
$pdf->Cell($anchoqcnu, 6, utf8_decode($porcenajefinalcfc ), 1, 1, 'C', 'true');





$pdf->Output();
