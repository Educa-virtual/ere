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





error_reporting(0);

$dnielieditar=$_POST['ideditar'];
$nuevonombre=$_POST['nuevonombre'];
$nuevocomentario=$_POST['nuevocomentario'];


if($claseAulaV->actualizarvisibleeditar($dnielieditar,$nuevonombre,$nuevocomentario)==true){

	echo "<div class='alert alert-primary' role='alert'>
	<i class='fas fa-check'></i> La operación se ha realizado con Éxito
  </div>";
	}
	else
	{
		echo "<div class='alert alert-danger' role='alert'>
		<i class='fas fa-times'></i> Error
  </div>";
	}
?>


</body>
</html>
