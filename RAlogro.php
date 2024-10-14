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
$seleeva	= $_POST['seleeva'];
$nivele	= $_POST['nivele'];
$cursoe	= $_POST['cursoe'];
$gradoe	= $_POST['gradoe'];
$inia	= $_POST['inia'];
$fina	= $_POST['fina'];
$resa	= $_POST['resa'];
$inib	= $_POST['inib'];
$finb	= $_POST['finb'];
$resb	= $_POST['resb'];
$inic	= $_POST['inic'];
$finc	= $_POST['finc'];
$resc	= $_POST['resc'];
$inid	= $_POST['inid'];
$find	= $_POST['find'];
$resd	= $_POST['resd'];
$calnivel	= $_POST['calnivel'];







	if ($claseAulaV->Crearlogro($seleeva,$nivele,$cursoe,$gradoe,$inia,$fina,$resa,$inib,$finb,$resb,$inic,$finc,$resc,$inid,$find,$resd,$calnivel) == true) {
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