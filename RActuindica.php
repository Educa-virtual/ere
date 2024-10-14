<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php
	require_once "cAdmision.php";
	$claseAulaV = new cAdmision;



	error_reporting(0);

	$id=$_POST['id'];
	$nvelel=$_POST['nvelel'];
	$descripcion=$_POST['descripcion'];
	$grado=$_POST['grado'];

	$iniciala=$_POST['iniciala'];
	$finala=$_POST['finala'];
	$resultadoa=$_POST['resultadoa'];

	$inicialb=$_POST['inicialb'];
	$finalb=$_POST['finalb'];
	$resultadob=$_POST['resultadob'];

	$inicialc=$_POST['inicialc'];
	$finalc=$_POST['finalc'];
	$resultadoc=$_POST['resultadoc'];

	$iniciald=$_POST['iniciald'];
	$finald=$_POST['finald'];
	$resultadod=$_POST['resultadod'];



	if ($claseAulaV->actualizarlogro($id,$iniciala,$finala,$resultadoa,$inicialb,$finalb,$resultadob,$inicialc,$finalc,$resultadoc,$iniciald,$finald,$resultadod) == true) {
		echo "<br>";
		echo "<center><a href='#' id='salir'><i class='fas fa-check fa-9x'></i><br><b>Se ha Actualizado Correctamente para continuar click aqui..</br></a><br><br><br></a></center>";
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