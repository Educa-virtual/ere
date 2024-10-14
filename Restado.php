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

$dnielie=$_POST['dnielie'];
$vise=$_POST['vise'];


if($claseAulaV->actualizarvisibleg($dnielie,$vise)==true){
	echo "<br>";
	echo "<center><a href='#' id='salir'><i class='fas fa-check fa-9x'></i><br><b>Se ha Actualizado Correctamente para continuar click aqui..</br></a><br><br><br></a></center>";
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
