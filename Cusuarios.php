<?php session_start();

if ($_SESSION["dni"] != '') {

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link rel="stylesheet" href="css/disenooptimizado.css">
	</head>
	<body>
		<?php
		require_once "cAdmision.php";
		$claseAulaV = new cAdmision;

		$textop = $_POST['textop'];
		sleep(0.5);
		error_reporting(0);
		?>

		<table  class="table table-sm table-bordered  table-striped table-hover ">
			<thead>
				<tr class="tablatitulo">
					<th scope="col">N</th>
					<th scope="col">DNI</th>
					<th scope="col">NOMBRE</th>
					<th scope="col">APELLIDOS</th>
					<th scope="col">IP</th>
					<th scope="col">NAVEGADOR</th>
					<th scope="col">SISTEMA OPERATIVO</th>
					<th scope="col">FECHA</th>
					<th scope="col">HORA</th>
				</tr>
			</thead>
			<?php
			$nro = 0;
				$listado = $claseAulaV->listapersofecha($textop);
			while ($lis = mysqli_fetch_array($listado)) {
				$nro = $nro + 1;
				echo "<tr class='tablacontenido'>";
				echo "<td>" . $nro . "</td>";
				echo "<td>" . $lis['dni'] . "</td>";
				echo "<td>" . $lis['nombres'] . "</td>";
				echo "<td>" . $lis['fullnombre'] . "</td>";
				echo "<td>" . $lis['ip'] . "</td>";
				echo "<td>" . $lis['navegador'] . "</td>";
				echo "<td>" . $lis['so'] . "</td>";
				echo "<td>" . $lis['fecha'] . "</td>";
				echo "<td>" . $lis['hora'] . "</td>";
				echo "</tr>";
			}
			?>
		</table>
	</body>
	</html>
<?php
} else {

	header("location:index.php");
}
?>