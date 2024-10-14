<?php session_start();

if ($_SESSION["dni"] != '') {

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>

	<body>
		<?php

		require_once "cAdmision.php";
		$claseAulaV = new cAdmision;


		sleep(1);

		$idexamen = $_POST['idexaemen'];
		$idpregunta = $_POST['idpreguntas'];
	
		$foro = addslashes($_POST['foro']); 

		$valuea = addslashes($_POST['valuea']);
		$valueb = addslashes($_POST['valueb']);
		$valuec = addslashes($_POST['valuec']);
		$valued = addslashes($_POST['valued']); 
	
		$preguntaa = $_POST['preguntaa'];
		$preguntab = $_POST['preguntab'];
		$preguntac = $_POST['preguntac'];
		$preguntad = $_POST['preguntad'];
		
		
$estado=0;



		error_reporting(0);

		// -----------------------------------Hora y Fecha-------------------
		setlocale(LC_ALL, 'es_PE');
		// Setea el huso horario del servidor...
		date_default_timezone_set('America/Caracas');
		// Imprime la fecha, hora y huso horario.
		date_default_timezone_set("America/Lima");
		$horaas = date("H:i:s");
		$diapublicacion = date("Y-m-d");
		// -----------------------------------Fin Hora y Fecha-------------------

		if ($claseAulaV->guardarpregunta($idexamen,$idpregunta,$foro,$preguntaa,$valuea,$preguntab,$valueb,$preguntac,$valuec,$preguntad,$valued) == true) {

		?>
			<div class="alert alert-primary" role="alert">
				Se a Registrado Correctamente...
			</div>

		<?php


		} else {
			echo "Error de grabacion";
		}
		?>

		<script>
			$("#salir").click(function() {
				//Actualizamos la página
				location.reload();
			});
		</script>

	</body>

	</html>
<?php
} else {

	header("location:index.php");
}
?>