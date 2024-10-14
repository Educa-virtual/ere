<?php

require 'fpdf/fpdf.php';

require_once "cAdmision.php";
$asistencia = new cAdmision;

$evaluacion =$_GET['evaluacion'];
$curso=$_GET['curso'];
$nivel=$_GET['nivel'];
$grado=$_GET['grado'];



class PDF extends FPDF {

// Cabecera de página

	function Header() {
        $evaluacion =$_GET['evaluacion'];
$curso=$_GET['curso'];
$nivel=$_GET['nivel'];
$grado=$_GET['grado'];
        $asistencia = new cAdmision;
        $cursodes = $asistencia->iesareasdes($curso);
        while ($mascu = mysqli_fetch_array($cursodes)) {
            $descurso = $mascu['descripcionarea'];
        }
        
        $cursodesf = $asistencia->descripcionealuacion($evaluacion);
        while ($mascuf = mysqli_fetch_array($cursodesf)) {
            $descursof = $mascuf['descripcion'];
        }

		$this->SetFont('Times', 'B', 8);
		$this->setXY(8, 2);
		$this->Cell(100, 8, utf8_decode('.:: Dirección Regional de Educación de Moquegua'), 0, 1, 'L', 0);
		$this->Ln(4);
        $this->setXY(8, 9);
		$this->SetFillColor(193, 193, 193); //color de fondo rgb
        $this->SetFont('Times', 'B', 9);
		$this->Cell(24, 8, utf8_decode('EVALUACIÓN'), 1, 0, 'C', 'true');
        $this->Cell(22, 8, utf8_decode(strtoupper($descursof)), 1, 0, 'C', 0);
        $this->Cell(15, 8, utf8_decode('AREA'), 1, 0, 'C', 'true');
        $this->Cell(50, 8, utf8_decode(strtoupper($descurso)), 1, 0, 'C', 0);
        $this->Cell(18, 8, utf8_decode('NIVEL'), 1, 0, 'C', 'true');
        $this->Cell(30, 8, utf8_decode(strtoupper($nivel)), 1, 0, 'C', 0);
        $this->Cell(20, 8, utf8_decode('GRADO'), 1, 0, 'C', 'true');
        $this->Cell(15, 8, utf8_decode(strtoupper($grado)), 1, 1, 'C', 0);
		$this->Ln(3);

 


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


    
// --------------------METODO PARA ADAPTAR LAS CELDAS------------------------------
	var $widths;
	var $aligns;

	function SetWidths($w) {
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a) {
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data, $setX) //yo modifique el script a  mi conveniencia :D
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}

		$h = 4 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h, $setX);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h, 'DF');
			//Print the text
			$this->MultiCell($w, 4, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h, $setX) {
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger) {
			$this->AddPage($this->CurOrientation);
			$this->SetX($setX);

			//volvemos a definir el  encabezado cuando se crea una nueva pagina
			$this->SetFont('Helvetica', 'B', 9);
			$this->Cell(9, 5, utf8_decode('ITEM'), 1, 0, 'C', 'true');
			$this->Cell(35, 5, utf8_decode('COMPETENCIA'), 1, 0, 'C', 'true');
			$this->Cell(42, 5, utf8_decode('CAPACIDAD'), 1, 0, 'C', 'true');
			$this->Cell(42, 5, utf8_decode('DESEMPEÑO'), 1, 0, 'C', 'true');
            $this->Cell(42, 5, utf8_decode('CONOCIMIENTO'), 1, 0, 'C', 'true');
            $this->Cell(12, 5, utf8_decode('NIVEL'), 1, 0, 'C', 'true');
            $this->Cell(12, 5, utf8_decode('CLAVE'), 1, 1, 'C', 'true');
			$this->SetFont('Arial', '', 8);
		}

		if ($setX == 100) {
			$this->SetX(100);
		} else {
			$this->SetX($setX);
		}

	}

	function NbLines($w, $txt) {
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0) {
			$w = $this->w - $this->rMargin - $this->x;
		}

		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n") {
			$nb--;
		}

		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ') {
				$sep = $i;
			}

			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j) {
						$i++;
					}

				} else {
					$i = $sep + 1;
				}

				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else {
				$i++;
			}

		}
		return $nl;
	}
// -----------------------------------TERMINA---------------------------------
}

//------------------OBTENES LOS DATOS DE LA BASE DE DATOS-------------------------


$matrisr = $asistencia->matrisnuevo($evaluacion, $curso, $grado, $nivel);





/* IMPORTANTE: si estan usando MVC o algún CORE de php les recomiendo hacer uso del metodo
que se llama *select_all* ya que es el que haria uso del *fetchall* tal y como ven en la linea 161
ya que es el que devuelve un array de todos los registros de la base de datos
si hacen uso de el metodo *select* hara uso de fetch y este solo selecciona una linea*/

//--------------TERMINA BASE DE DATOS-----------------------------------------------

// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetMargins(0, 0, 0); //MARGENES
$pdf->SetAutoPageBreak(true, 5); //salto de pagina automatico



// -----------ENCABEZADO------------------


$pdf->SetX(8);
$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(9, 5, utf8_decode('ITEM'), 1, 0, 'C', 0 );
$pdf->Cell(35, 5, utf8_decode('COMPETENCIA'), 1, 0, 'C', 0);
$pdf->Cell(42, 5, utf8_decode('CAPACIDAD'), 1, 0, 'C', 0);
$pdf->Cell(42, 5, utf8_decode('DESEMPEÑO'), 1, 0, 'C',0);
$pdf->Cell(42, 5, utf8_decode('CONOCIMIENTO'), 1, 0, 'C', 0);
$pdf->Cell(12, 5, utf8_decode('NIVEL'), 1, 0, 'C', 0);
$pdf->Cell(12, 5, utf8_decode('CLAVE'), 1, 1, 'C',0 );
$pdf->SetFont('Arial', '', 8);

// -------TERMINA----ENCABEZADO------------------

$pdf->SetFillColor(255, 255, 255); //color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

$pdf->SetFont('Arial', '', 8);

//El ancho de las celdas
$pdf->SetWidths(array(9, 35, 42, 42, 42, 12, 12)); //???

// esto no lo mencione en el video pero también pueden poner la alineación de cada COLUMNA!!!
$pdf->SetAligns(array('C','C','C','L'));


while ($masi = mysqli_fetch_array($matrisr)) {

    $pdf->Row(array($masi['item'],utf8_decode( $masi['competencia']), utf8_decode($masi['capacidad']), utf8_decode($masi['desempeno']),utf8_decode($masi['conocimiento']),$masi['nivelp'],$masi['clave']), 8);

}





// cell(ancho, largo, contenido,borde?, salto de linea?)

$pdf->Output();
