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

$imagena = $_POST['imagena'];
$variableR = $_POST['variableR'];



$img = explode(',', $imagena, 2)[1];
$pic = 'data://text/plain;base64,' . $img;

$imgR = explode(',', $variableR, 2)[1];
$picR = 'data://text/plain;base64,' . $imgR;


$textaf = $_POST['textaf'];
$respaf = $_POST['respaf'];
$poraf = $_POST['poraf'];

$textbf = $_POST['textbf'];
$respbf = $_POST['respbf'];
$porbf = $_POST['porbf'];


$textcf = $_POST['textcf'];
$respcf = $_POST['respcf'];
$porcf = $_POST['porcf'];

$textdf = $_POST['textdf'];
$respdf = $_POST['respdf'];
$pordf = $_POST['pordf'];


$sumatoriofinacf = $_POST['sumatoriofinacf'];
$porcenajefinalcf= $_POST['porcenajefinalcf'];



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

//-----------------Extraer Datos de Matriz-------------------------------


for ($i = 1; $i <= 20; $i++) {

	$matrist1 = $asistencia->matrisres($curso, $grado, $nivel, $i, $evaluaci);
	while ($maser1 = mysqli_fetch_array($matrist1)) {
		$demoab1[$i] = $maser1['clave'];
		$nivel1a[$i] = $maser1['nivelp'];
		$competencia1a[$i] = $maser1['competencia'];
		$desempeno1a[$i] = $maser1['desempeno'];
		$items1[$i] = $maser1['item'];
		$estado1[$i] = $maser1['estado'];
	}
}
//-----------------Extraer Datos de Matriz-------------------------------


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

//--------------------------Nuevos Contadores--------------------
$sumador1 = 0;
$sumador2 = 0;
$sumador3 = 0;
$sumador4 = 0;
$sumador5 = 0;
$sumador6 = 0;
$sumador7 = 0;
$sumador8 = 0;
$sumador9 = 0;
$sumador10 = 0;
$sumador11 = 0;
$sumador12 = 0;
$sumador13 = 0;
$sumador14 = 0;
$sumador15 = 0;
$sumador16 = 0;
$sumador17 = 0;
$sumador18 = 0;
$sumador19 = 0;
$sumador20 = 0;


$blanco1 = 0;
$blanco2 = 0;
$blanco3 = 0;
$blanco4 = 0;
$blanco5 = 0;
$blanco6 = 0;
$blanco7 = 0;
$blanco8 = 0;
$blanco9 = 0;
$blanco10 = 0;
$blanco11 = 0;
$blanco12 = 0;
$blanco13 = 0;
$blanco14 = 0;
$blanco15 = 0;
$blanco16 = 0;
$blanco17 = 0;
$blanco18 = 0;
$blanco19 = 0;
$blanco20 = 0;

$incorrecto1 = 0;
$incorrecto2 = 0;
$incorrecto3 = 0;
$incorrecto4 = 0;
$incorrecto5 = 0;
$incorrecto6 = 0;
$incorrecto7 = 0;
$incorrecto8 = 0;
$incorrecto9 = 0;
$incorrecto10 = 0;
$incorrecto11 = 0;
$incorrecto12 = 0;
$incorrecto13 = 0;
$incorrecto14 = 0;
$incorrecto15 = 0;
$incorrecto16 = 0;
$incorrecto17 = 0;
$incorrecto18 = 0;
$incorrecto19 = 0;
$incorrecto20 = 0;

$totalpreinicio = 0;
$totalinicio = 0;
$totalproceso = 0;
$totalsatisfactorio = 0;

//--------------------------medidas de numeros--------------------
$datnu = 4;
$acier = 9;
$annivel = 16;
$datnuc = 11;


$decimal = 1;
//--------------------------FIn medidas de numeros--------------------

$datoscalculo = $asistencia->calculoindicador($evaluaci, $curso, $grado, $nivel);
while ($asic = mysqli_fetch_array($datoscalculo)) {
	$iniciocala = $asic['iniciala'];
	$fincala = $asic['finala'];
	$resultadocala = $asic['resultadoa'];
	$iniciocalb = $asic['inicialb'];
	$fincalb = $asic['finalb'];
	$resultadocalb = $asic['resultadob'];
	$iniciocalc = $asic['inicialc'];
	$fincalc = $asic['finalc'];
	$resultadocalc = $asic['resultadoc'];
	$iniciocald = $asic['iniciald'];
	$fincald = $asic['finald'];
	$resultadocald = $asic['resultadod'];
	$calinivel = $asic['calinivel'];
}



// Creación del objeto de la clase heredada
$pdf = new PDF('L', 'mm', 'A4'); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('times', 'B', 14);
$pdf->SetXY(0, 9);
$pdf->Cell(0, 8, utf8_decode('RESULTADOS DE EVALUACIÓN : '.$descursof), 0, 0, 'C', 0);
$pdf->Ln(10);

$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetFillColor(213, 211, 211);

$pdf->Cell(21, 6, utf8_decode('Nivel'), 1, 0, 'C', 'true');
$pdf->Cell(45, 6, utf8_decode('Area'), 1, 0, 'C', 'true');
$pdf->Cell(45, 6, utf8_decode('UGEL'), 1, 0, 'C', 'true');
$pdf->Cell(44, 6, utf8_decode('Distrito'), 1, 0, 'C', 'true');
$pdf->Cell(73, 6, utf8_decode('I.E.'), 1, 0, 'L', 'true');
$pdf->Cell(17, 6, utf8_decode('Gestión'), 1, 0, 'C', 'true');
$pdf->Cell(15, 6, utf8_decode('Zona'), 1, 0, 'C', 'true');
$pdf->Cell(7, 6, utf8_decode('Sec.'), 1, 0, 'C', 'true');
$pdf->Cell(17, 6, utf8_decode('Sexo'), 1, 1, 'C', 'true');

$pdf->Cell(21, 6, utf8_decode($nivel), 1, 0, 'C', 0);
$pdf->Cell(45, 6, utf8_decode($descurso), 1, 0, 'C', 0);
$pdf->Cell(45, 6, utf8_decode($desugel), 1, 0, 'C', 0);
$pdf->Cell(44, 6, utf8_decode($distrito), 1, 0, 'C', 0);
$pdf->Cell(73, 6, utf8_decode($ie . " - " .  $desies), 1, 0, 'C', 0);
$pdf->Cell(17, 6, utf8_decode($gestion), 1, 0, 'C', 0);
$pdf->Cell(15, 6, utf8_decode($zona), 1, 0, 'C', 0);
$pdf->Cell(7, 6, utf8_decode($seccion), 1, 0, 'C', 0);
$pdf->Cell(17, 6, utf8_decode($sexo), 1, 1, 'C', 0);
$pdf->Ln(0);
$pdf->Image($pic, 20, 31, 250, 0, 'png');
$pdf->Ln(120);

$anchor='30';


$pdf->SetXY(204,50);
$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell($anchor, 6, utf8_decode('NIVEL DE LOGRO'), 1, 0, 'c', 'true');
$pdf->Cell($anchor, 6, utf8_decode('NUMERO'), 1, 0, 'C', 'true');
$pdf->Cell($anchor, 6, utf8_decode('%'), 1, 1, 'C', 'true');
$pdf->SetXY(204,56);
$pdf->Cell($anchor, 6, utf8_decode($textaf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($respaf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($poraf.'%'), 1, 1, 'C', 0);
$pdf->SetXY(204,62);
$pdf->Cell($anchor, 6, utf8_decode($textbf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($respbf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($porbf.'%'), 1, 1, 'C', 0);
$pdf->SetXY(204,68);
$pdf->Cell($anchor, 6, utf8_decode($textcf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($respcf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($porcf.'%'), 1, 1, 'C', 0);

if($textdf == '')
{
	$pdf->SetXY(204,74);
}else{
	$pdf->SetXY(204,74);
	$pdf->Cell($anchor, 6, utf8_decode($textdf), 1, 0, 'C', 0);
	$pdf->Cell($anchor, 6, utf8_decode($respdf), 1, 0, 'C', 0);
	$pdf->Cell($anchor, 6, utf8_decode($pordf.'%'), 1, 1, 'C', 0);
	$pdf->SetXY(204,80);
}

$pdf->Cell($anchor, 6, utf8_decode('TOTAL'), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($sumatoriofinacf), 1, 0, 'C', 0);
$pdf->Cell($anchor, 6, utf8_decode($porcenajefinalcf.'%'), 1, 1, 'C', 0);




$pdf->Ln(120);

$pdf->SetFont('Helvetica', 'B', 6.5);
$pdf->Cell(7, 6, utf8_decode('N.'), 1, 0, 'L', 'true');
$pdf->Cell(62, 6, utf8_decode('CÓD. MOD.| I.E.'), 1, 0, 'C', 'true');
$pdf->Cell(22, 6, utf8_decode('DISTRITO'), 1, 0, 'C', 'true');
$pdf->Cell(6, 6, utf8_decode('SEC'), 1, 0, 'C', 'true');
$pdf->Cell(65, 6, utf8_decode('APELLIDO Y NOMBRES'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('1'), 1, 0, 'L', 'true');
$pdf->Cell($datnu, 6, utf8_decode('2'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('3'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('4'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('5'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('6'), 1, 0, 'L', 'true');
$pdf->Cell($datnu, 6, utf8_decode('7'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('8'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('9'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('10'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('11'), 1, 0, 'L', 'true');
$pdf->Cell($datnu, 6, utf8_decode('12'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('13'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('14'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('15'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('16'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('17'), 1, 0, 'L', 'true');
$pdf->Cell($datnu, 6, utf8_decode('18'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('19'), 1, 0, 'C', 'true');
$pdf->Cell($datnu, 6, utf8_decode('20'), 1, 0, 'C', 'true');
$pdf->Cell($acier, 6, utf8_decode('Aciert'), 1, 0, 'C', 'true');
$pdf->Cell($acier, 6, utf8_decode('Desac'), 1, 0, 'C', 'true');
$pdf->Cell($acier, 6, utf8_decode('Blanco'), 1, 0, 'C', 'true');
$pdf->Cell($annivel, 6, utf8_decode('Nivel'), 1, 1, 'C', 'true');

$nro = 0;

$asistencia = $asistencia->consultanew($curso, $nivel, $grado, $ugel, $gestion, $zona, $distrito, $sexo, $seccion, $ie, $evaluaci);
while ($asi = mysqli_fetch_array($asistencia)) {
	$nro = $nro + 1;

	$contadorc = 0;
	$contadori = 0;
	$blancoc = 0;
	$totalnivel=0;


	$pdf->Cell(7, 6, utf8_decode($nro), 1, 0, 'L', 0);
	$pdf->Cell(62, 6, utf8_decode($asi['codigomodular'] . "|" . $asi['ie']), 1, 0, 'L', 0);
	$pdf->Cell(22, 6, utf8_decode($asi['distrito']), 1, 0, 'L', 0);
	$pdf->Cell(6, 6, utf8_decode($asi['seccion']), 1, 0, 'L', 0);
	$pdf->Cell(65, 6, utf8_decode($asi['apellidopaterno'] . " " . $asi['apellidomaterno'] . ";" . $asi['primernombre'] . " " . $asi['segundonombre'] . " " . $asi['tercernombre']), 1, 0, 'L', 0);

	if ($estado1[1] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas1'] == '') {
			$blancoc = $blancoc + 1;
			$blanco1 = $blanco1 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas1'] == $demoab1[1]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas1']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador1 = $sumador1 + 1;
				$totalnivel=$totalnivel+$nivel1a[1];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas1']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto1 = $incorrecto1 + 1;
			}
		}
	}
	//--------------------------------------------------------------------------------------------------
	if ($estado1['2'] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas2'] == '') {
			$blancoc = $blancoc + 1;
			$blanco2 = $blanco2 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas2'] == $demoab1[2]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas2']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador2 = $sumador2 + 1;
				$totalnivel=$totalnivel+$nivel1a[2];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas2']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto2 = $incorrecto2 + 1;
			}
		}
	}
	//-------------------------------------------------------------------------------------------                          
	//--------------------------------------------------------------------------------------------------
	if ($estado1[3] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas3'] == '') {
			$blancoc = $blancoc + 1;
			$blanco3 = $blanco3 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas3'] == $demoab1[3]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas3']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador3 = $sumador3 + 1;
				$totalnivel=$totalnivel+$nivel1a[3];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas3']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto3 = $incorrecto3 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 

	//--------------------------------------------------------------------------------------------------
	if ($estado1[4] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas4'] == '') {
			$blancoc = $blancoc + 1;
			$blanco4 = $blanco4 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas4'] == $demoab1[4]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas4']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador4 = $sumador4 + 1;
				$totalnivel=$totalnivel+$nivel1a[4];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas4']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto4 = $incorrecto4 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 

	//--------------------------------------------------------------------------------------------------
	if ($estado1[5] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas5'] == '') {
			$blancoc = $blancoc + 1;
			$blanco5 = $blanco5 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas5'] == $demoab1[5]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas5']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador5 = $sumador5 + 1;
				$totalnivel=$totalnivel+$nivel1a[5];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas5']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto5 = $incorrecto5 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[6] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas6'] == '') {
			$blancoc = $blancoc + 1;
			$blanco6 = $blanco6 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas6'] == $demoab1[6]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas6']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador6 = $sumador6 + 1;
				$totalnivel=$totalnivel+$nivel1a[6];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas6']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto6 = $incorrecto6 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[7] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas7'] == '') {
			$blancoc = $blancoc + 1;
			$blanco7 = $blanco7 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas7'] == $demoab1[7]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas7']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador7 = $sumador7 + 1;
				$totalnivel=$totalnivel+$nivel1a[7];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas7']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto7 = $incorrecto7 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[8] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas8'] == '') {
			$blancoc = $blancoc + 1;
			$blanco8 = $blanco8 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas8'] == $demoab1[8]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas8']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador8 = $sumador8 + 1;
				$totalnivel=$totalnivel+$nivel1a[8];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas8']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto8 = $incorrecto8 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[9] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas9'] == '') {
			$blancoc = $blancoc + 1;
			$blanco9 = $blanco9 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas9'] == $demoab1[9]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas9']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador9 = $sumador9 + 1;
				$totalnivel=$totalnivel+$nivel1a[9];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas9']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto9 = $incorrecto9 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[10] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas10'] == '') {
			$blancoc = $blancoc + 1;
			$blanco10 = $blanco10 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas10'] == $demoab1[10]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas10']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador10 = $sumador10 + 1;
				$totalnivel=$totalnivel+$nivel1a[10];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas10']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto10 = $incorrecto10 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[11] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas11'] == '') {
			$blancoc = $blancoc + 1;
			$blanco11 = $blanco11 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas11'] == $demoab1[11]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas11']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador11 = $sumador11 + 1;
				$totalnivel=$totalnivel+$nivel1a[11];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas11']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto11 = $incorrecto11 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[12] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas12'] == '') {
			$blancoc = $blancoc + 1;
			$blanco12 = $blanco12 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas12'] == $demoab1[12]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas12']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador12 = $sumador12 + 1;
				$totalnivel=$totalnivel+$nivel1a[12];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas12']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto12 = $incorrecto12 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 

	//--------------------------------------------------------------------------------------------------
	if ($estado1[13] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas13'] == '') {
			$blancoc = $blancoc + 1;
			$blanco13 = $blanco13 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas13'] == $demoab1[13]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas13']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador13 = $sumador13 + 1;
				$totalnivel=$totalnivel+$nivel1a[13];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas13']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto13 = $incorrecto13 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[14] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas14'] == '') {
			$blancoc = $blancoc + 1;
			$blanco14 = $blanco14 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas14'] == $demoab1[14]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas14']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador14 = $sumador14 + 1;
				$totalnivel=$totalnivel+$nivel1a[14];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas14']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto14 = $incorrecto14 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[15] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas15'] == '') {
			$blancoc = $blancoc + 1;
			$blanco15 = $blanco15 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas15'] == $demoab1[15]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas15']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador15 = $sumador15 + 1;
				$totalnivel=$totalnivel+$nivel1a[15];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas15']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto15 = $incorrecto15 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 

	//--------------------------------------------------------------------------------------------------
	if ($estado1[16] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas16'] == '') {
			$blancoc = $blancoc + 1;
			$blanco16 = $blanco16 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas16'] == $demoab1[16]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas16']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador16 = $sumador16 + 1;
				$totalnivel=$totalnivel+$nivel1a[16];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas16']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto16 = $incorrecto16 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[17] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas17'] == '') {
			$blancoc = $blancoc + 1;
			$blanco17 = $blanco17 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas17'] == $demoab1[17]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas17']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador17 = $sumador17 + 1;
				$totalnivel=$totalnivel+$nivel1a[17];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas17']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto17 = $incorrecto17 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[18] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas18'] == '') {
			$blancoc = $blancoc + 1;
			$blanco18 = $blanco18 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas18'] == $demoab1[18]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas18']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador18 = $sumador18 + 1;
				$totalnivel=$totalnivel+$nivel1a[18];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas18']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto18 = $incorrecto18 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[19] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas19'] == '') {
			$blancoc = $blancoc + 1;
			$blanco19 = $blanco19 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas19'] == $demoab1[19]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas19']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador19 = $sumador19 + 1;
				$totalnivel=$totalnivel+$nivel1a[19];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas19']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto19 = $incorrecto19 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 
	//--------------------------------------------------------------------------------------------------
	if ($estado1[20] == 1) {
		$pdf->Cell($datnu, 6, utf8_decode('Anular'), 1, 0, 'L', 0);
	} else {

		if ($asi['respuestas20'] == '') {
			$blancoc = $blancoc + 1;
			$blanco20 = $blanco20 + 1;
			$pdf->Cell($datnu, 6, utf8_decode('-'), 1, 0, 'L', 0);
		} else {
			if ($asi['respuestas20'] == $demoab1[20]) {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas20']), 1, 0, 'L', 0);
				$contadorc = $contadorc + 1;
				$sumador20 = $sumador20 + 1;
				$totalnivel=$totalnivel+$nivel1a[20];
			} else {
				$pdf->Cell($datnu, 6, utf8_decode($asi['respuestas20']), 1, 0, 'L', 0);
				$contadori = $contadori + 1;
				$incorrecto20 = $incorrecto20 + 1;
			}
		}
	}
	//------------------------------------------------------------------------------------------- 


	$pdf->Cell($acier, 6, utf8_decode($contadorc), 1, 0, 'C', 0);
	$pdf->Cell($acier, 6, utf8_decode($contadori), 1, 0, 'C', 0);
	$pdf->Cell($acier, 6, utf8_decode($blancoc), 1, 0, 'C', 0);


	$numerosec[$nro] = $totalnivel;
	$numerofr[$nro] = $contadorc;

	if ($calinivel == 1) {
		if ($totalnivel <= $fincala) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocala), 1, 1, 'C', 'true');
			$totalpreinicio = $totalpreinicio + 1;
		} elseif ($totalnivel >= $iniciocalb and $totalnivel <= $fincalb) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocalb), 1, 1, 'C', 'true');
			$totalinicio = $totalinicio + 1;
		} elseif ($totalnivel >= $iniciocalc and $totalnivel <= $fincalc) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocalc), 1, 1, 'C', 'true');
			$totalproceso = $totalproceso + 1;
		} elseif ($totalnivel >= $iniciocald and $totalnivel<= $fincald) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocald), 1, 1, 'C', 'true');
			$totalsatisfactorio = $totalsatisfactorio + 1;
		}
	} else {
		if ($contadorc <= $fincala) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocala), 1, 1, 'C', 'true');
			$totalpreinicio = $totalpreinicio + 1;
		} elseif ($contadorc >= $iniciocalb and $contadorc <= $fincalb) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocalb), 1, 1, 'C', 'true');
			$totalinicio = $totalinicio + 1;
		} elseif ($contadorc >= $iniciocalc and $contadorc <= $fincalc) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocalc), 1, 1, 'C', 'true');
			$totalproceso = $totalproceso + 1;
		} elseif ($contadorc >= $iniciocald and $contadorc <= $fincald) {
			$pdf->Cell($annivel, 6, utf8_decode($resultadocald), 1, 1, 'C', 'true');
			$totalsatisfactorio = $totalsatisfactorio + 1;
		}
	}
}


$pdf->Ln(5);
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(65, 6, utf8_decode('ITEMS'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('1'), 1, 0, 'L', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('2'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('3'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('4'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('5'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('6'), 1, 0, 'L', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('7'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('8'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('9'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('10'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('11'), 1, 0, 'L', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('12'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('13'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('14'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('15'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('16'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('17'), 1, 0, 'L', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('18'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('19'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode('20'), 1, 1, 'C', 'true');

$pdf->Cell(65, 6, utf8_decode('NIVEL'), 1, 0, 'C', 'true');
for ($ii = 1; $ii <= 20; $ii++) {

	$pdf->Cell($datnuc, 6, utf8_decode($nivel1a[$ii]), 1, 0, 'C', 0);
}
$pdf->Ln(6);
$pdf->Cell(65, 6, utf8_decode('Nro Aciertos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($sumador1), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador2), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador3), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador4), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador5), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador6), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador7), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador8), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador9), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador10), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador11), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador12), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador13), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador14), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador15), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador16), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador17), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador18), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador19), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($sumador20), 1, 1, 'C', 0);


$pdf->Cell(65, 6, utf8_decode('Nro Desaciertos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto1), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto2), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto3), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto4), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto5), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto6), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto7), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto8), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto9), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto10), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto11), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto12), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto13), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto14), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto15), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto16), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto17), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto18), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto19), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($incorrecto20), 1, 1, 'C', 0);

$pdf->Cell(65, 6, utf8_decode('Blancos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($blanco1), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco2), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco3), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco4), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco5), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco6), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco7), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco8), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco9), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco10), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco11), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco12), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco13), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco14), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco15), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco16), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco17), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco18), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco19), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($blanco20), 1, 1, 'C', 0);
// cell(ancho, largo, contenido,borde?, salto de linea?)



$porcentaje1r = round((($sumador1 * 100) / $nro), $decimal);
$porcentaje2r = round((($sumador2 * 100) / $nro), $decimal);
$porcentaje3r = round((($sumador3 * 100) / $nro), $decimal);
$porcentaje4r = round((($sumador4 * 100) / $nro), $decimal);
$porcentaje5r = round((($sumador5 * 100) / $nro), $decimal);
$porcentaje6r = round((($sumador6 * 100) / $nro), $decimal);
$porcentaje7r = round((($sumador7 * 100) / $nro), $decimal);
$porcentaje8r = round((($sumador8 * 100) / $nro), $decimal);
$porcentaje9r = round((($sumador9 * 100) / $nro), $decimal);
$porcentaje10r = round((($sumador10 * 100) / $nro), $decimal);
$porcentaje11r = round((($sumador11 * 100) / $nro), $decimal);
$porcentaje12r = round((($sumador12 * 100) / $nro), $decimal);
$porcentaje13r = round((($sumador13 * 100) / $nro), $decimal);
$porcentaje14r = round((($sumador14 * 100) / $nro), $decimal);
$porcentaje15r = round((($sumador15 * 100) / $nro), $decimal);
$porcentaje16r = round((($sumador16 * 100) / $nro), $decimal);
$porcentaje17r = round((($sumador17 * 100) / $nro), $decimal);
$porcentaje18r = round((($sumador18 * 100) / $nro), $decimal);
$porcentaje19r = round((($sumador19 * 100) / $nro), $decimal);
$porcentaje20r = round((($sumador20 * 100) / $nro), $decimal);






$pdf->Cell(65, 6, utf8_decode('% Aciertos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje1r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje2r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje3r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje4r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje5r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje6r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje7r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje8r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje9r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje10r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje11r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje12r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje13r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje14r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje15r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje16r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje17r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje18r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje19r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentaje20r . '%'), 1, 1, 'C', 0);

$porcentajed1r = round((($incorrecto1 * 100) / $nro), $decimal);
$porcentajed2r = round((($incorrecto2 * 100) / $nro), $decimal);
$porcentajed3r = round((($incorrecto3 * 100) / $nro), $decimal);
$porcentajed4r = round((($incorrecto4 * 100) / $nro), $decimal);
$porcentajed5r = round((($incorrecto5 * 100) / $nro), $decimal);
$porcentajed6r = round((($incorrecto6 * 100) / $nro), $decimal);
$porcentajed7r = round((($incorrecto7 * 100) / $nro), $decimal);
$porcentajed8r = round((($incorrecto8 * 100) / $nro), $decimal);
$porcentajed9r = round((($incorrecto9 * 100) / $nro), $decimal);
$porcentajed10r = round((($incorrecto10 * 100) / $nro), $decimal);
$porcentajed11r = round((($incorrecto11 * 100) / $nro), $decimal);
$porcentajed12r = round((($incorrecto12 * 100) / $nro), $decimal);
$porcentajed13r = round((($incorrecto13 * 100) / $nro), $decimal);
$porcentajed14r = round((($incorrecto14 * 100) / $nro), $decimal);
$porcentajed15r = round((($incorrecto15 * 100) / $nro), $decimal);
$porcentajed16r = round((($incorrecto16 * 100) / $nro), $decimal);
$porcentajed17r = round((($incorrecto17 * 100) / $nro), $decimal);
$porcentajed18r = round((($incorrecto18 * 100) / $nro), $decimal);
$porcentajed19r = round((($incorrecto19 * 100) / $nro), $decimal);
$porcentajed20r = round((($incorrecto20 * 100) / $nro), $decimal);



$pdf->Cell(65, 6, utf8_decode('% Desaciertos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed1r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed2r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed3r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed4r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed5r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed6r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed7r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed8r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed9r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed10r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed11r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed12r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed13r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed14r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed15r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed16r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed17r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed18r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed19r . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed20r . '%'), 1, 1, 'C', 0);



$porcentajed1b = round((($blanco1 * 100) / $nro), $decimal);
$porcentajed2b = round((($blanco2 * 100) / $nro), $decimal);
$porcentajed3b = round((($blanco3 * 100) / $nro), $decimal);
$porcentajed4b = round((($blanco4 * 100) / $nro), $decimal);
$porcentajed5b = round((($blanco5 * 100) / $nro), $decimal);
$porcentajed6b = round((($blanco6 * 100) / $nro), $decimal);
$porcentajed7b = round((($blanco7 * 100) / $nro), $decimal);
$porcentajed8b = round((($blanco8 * 100) / $nro), $decimal);
$porcentajed9b = round((($blanco9 * 100) / $nro), $decimal);
$porcentajed10b = round((($blanco10 * 100) / $nro), $decimal);
$porcentajed11b = round((($blanco11 * 100) / $nro), $decimal);
$porcentajed12b = round((($blanco12 * 100) / $nro), $decimal);
$porcentajed13b = round((($blanco13 * 100) / $nro), $decimal);
$porcentajed14b = round((($blanco14 * 100) / $nro), $decimal);
$porcentajed15b = round((($blanco15 * 100) / $nro), $decimal);
$porcentajed16b = round((($blanco16 * 100) / $nro), $decimal);
$porcentajed17b = round((($blanco17 * 100) / $nro), $decimal);
$porcentajed18b = round((($blanco18 * 100) / $nro), $decimal);
$porcentajed19b = round((($blanco19 * 100) / $nro), $decimal);
$porcentajed20b = round((($blanco20 * 100) / $nro), $decimal);



$pdf->Cell(65, 6, utf8_decode('% Blancos'), 1, 0, 'C', 'true');
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed1b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed2b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed3b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed4b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed5b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed6b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed7b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed8b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed9b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed10b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed11b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed12b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed13b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed14b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed15b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed16b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed17b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed18b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed19b . '%'), 1, 0, 'C', 0);
$pdf->Cell($datnuc, 6, utf8_decode($porcentajed20b . '%'), 1, 1, 'C', 0);

$pdf->Ln(5);
$pdf->Image($picR,null ,null , 290, 0, 'png');
$pdf->Ln(4);

$pdf->SetFont('Helvetica', 'B', 14);
$pdf->Cell(80, 6, utf8_decode('MEDIDA PROMEDIO'), 1, 0, 'C', 'true');

if ($calinivel == 1) {
	$totalres=round((array_sum($numerosec) / $nro), 2);

	$pdf->Cell(40, 6, utf8_decode($totalres), 1, 1, 'L', 'true');
}else{
	$totalres=round((array_sum($numerofr) / $nro), 2);

	$pdf->Cell(40, 6, utf8_decode($totalres), 1, 1, 'L', 'true');
}
                    

$pdf->Output();
