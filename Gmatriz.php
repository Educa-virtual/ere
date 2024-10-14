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


		$seleeva = $_POST['seleeva'];
		$selenivel = $_POST['selenivel'];
		$selegra = $_POST['selegra'];
		$seleare = $_POST['seleare'];
		$competese = $_POST['competese'];
		$capacidas = $_POST['capacidas'];
		$desempa = $_POST['desempa'];
		$conocimient = $_POST['conocimient'];
		$items = $_POST['items'];
		$nivell = $_POST['nivell'];
		$clavees = $_POST['clavees'];
		$caracteriten = $_POST['caracteriten'];

		
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

		if ($claseAulaV->guardarmatriz($seleeva,$seleare,$seleare,$competese,$capacidas,$desempa,$conocimient,$caracteriten,$items,$nivell,$clavees,$selegra,$selenivel,$estado) == true) {

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