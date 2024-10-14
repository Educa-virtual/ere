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
	$asistencia = new cAdmision;

	$dni = $_SESSION["dni"];
	$nombre = $_SESSION["nombres"];
	

	$contraanterior=$_POST['claveanterior'];
	$nclave=trim($_POST['nuactuclave']);
	$rnclave=trim($_POST['renuactuclave']);



	$totalb = $asistencia->areadescon($dni);
	while ($tiasib = mysqli_fetch_array($totalb)) {
		$totala = $tiasib['clave'];
	}


	if ($totala ==  $contraanterior)
{

	if($nclave == $rnclave){

		if($asistencia->actualizarclavenueva($dni,$nclave)==true){
			echo "<br>";
	echo "<center><a href='#' id='salir'><i class='fas fa-check fa-9x'></i><br><b>Se a Actualizado Correctamente para continuar click aqui..</br></a><br><br><br></a></center>";
			}
	}else
	{

		echo "<center><a href='#' id='salir'><b>Error de grabacion</br></a><br><br><br></a></center>";
		
	}
}else{
	echo "<center><a href='#' id='salir'><b>Error de grabacion</br></a><br><br><br></a></center>";
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