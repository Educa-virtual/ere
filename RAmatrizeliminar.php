<?php session_start();?>

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

$dni = $_SESSION["dni"];
$nombre = $_SESSION["nombres"];
$apellidos = $_SESSION["apellidos"];



error_reporting(0);

$ieseli=$_POST['idelimine'];


if($claseAulaV->eliminarmatriz($ieseli)==true){
	echo "<br>";
	echo "<center><a href='#' id='salir'><i class='fas fa-check fa-9x'></i><br><b>Se ha Eliminado Correctamente para continuar click aqui..</br></a><br><br><br></a></center>";
	}
	else
	{
		echo "Error de grabacion";
	}
?>
<script>
$("#salir").click(function () {
  //Actualizamos la página
  location.reload();
});
</script>


</body>
</html>
