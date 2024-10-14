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

error_reporting(0);

$dniactu=$_POST['dni'];
$idactua=$_POST['id'];



if($claseAulaV->restablecercontrasena($idactua,$dniactu)==true){
	echo "<br>";
	echo "<center><a href='#' id='salir'><i class='fas fa-check fa-9x'></i><br><b>Se a reseteado a su contraseña inicial..</br></a><br><br><br></a></center>";
	}
	else
	{
		echo "Error de grabacion";
	}
?>


</body>
</html>
