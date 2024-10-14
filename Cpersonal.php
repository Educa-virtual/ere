<?php session_start();

if ($_SESSION["dni"] != '') {

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/disenooptimizado.css">
		<title>Document</title>

	</head>

	<body>
		<?php

		require_once "cAdmision.php";
		$claseAulaV = new cAdmision;

		$textop = $_POST['textop'];
		$textoperfil = $_POST['textoperfil'];

		?>


		<table class="table table-sm table-bordered  table-striped table-hover">
			<thead>
				<tr class="tablatitulo">
					<th scope="col">N</th>
					<th scope="col">DNI</th>
					<th scope="col">NOMBRE</th>
					<th scope="col">APE. PATERNO</th>
					<th scope="col">APE. MATERNO</th>
					<th scope="col">CELULAR</th>
					<th scope="col">EMAIL</th>
					<th scope="col">ROL</th>
					<th scope="col">ESTADO</th>
					<th scope="col">OPCIONES</th>
				</tr>
			</thead>
			<?php
			$nro = 0;

if($textoperfil <> '')
{

	$listado = $claseAulaV->listatexttipo($textoperfil);
	

}else{
	$listado = $claseAulaV->listatext($textop);

}
	

			while ($lis = mysqli_fetch_array($listado)) {
				$nro = $nro + 1;
				echo "<tr id='row" . $lis['dni'] . "' class='tablacontenidor'>";
				echo "<td>" . $nro . "</td>";
				echo "<td>" . $lis['dni'] . "</td>";
				echo "<td>" . strtoupper($lis['nombres']) . "</td>";
				echo "<td>" . strtoupper($lis['apellidopat']) . "</td>";
				echo "<td>" . strtoupper($lis['apellidomat']) . "</td>";
				echo "<td>" . strtoupper($lis['celular']) . "</td>";
				echo "<td>" . strtoupper($lis['email']) . "</td>";
				$listadot = $claseAulaV->verestado($lis['dni']);
				while ($lise = mysqli_fetch_array($listadot)) {
					$estadow = $lise[0];
				}

				echo "<td>";
				$listadote = $claseAulaV->verestadorol($lis['dni']);
				while ($lisee = mysqli_fetch_array($listadote)) {
					echo $lisee['descripciontipo'] . "<br>";
				}
				echo "</td>";
				if ($estadow == '0') {
					echo "<td><button type='button' class='btn btn-danger btn-sm'>Inactivo</button></td>";
				} else {
					echo "<td><button type='button' class='btn btn-primary  btn-sm'>Activo</button></td>";
				}

				echo "<td><button type='button' title='opciones' class='btn btn-light-primary btn-sm configurar'    dnic='" . $lis['dni'] . "'>
				<i class='fas fa-user-cog'></i></button>
				<button type='button' title='Eliminar' class='btn btn-light-primary btn-sm eliminaruser'   ednic='" . $lis['dni'] . "' enombresc='" . $lis['nombres'] . "'  eapellidospatc='" . $lis['apellidopat']  . "' eapellidosmatc='" . $lis['apellidomat'] . "' celularc='" . $lis['celular'] . "' emailc='" . $lis['email'] . "'>
				<i class='fas fa-user-times'></i></button>
				</td>";
				echo "</tr>";
			}
			?>
		</table>



		<!-- Modal -->
		<div class="modal fade" id="eliminarm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content respuestaeli">
					<div class="modal-header modeldi">
						<h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
					</div>
					<form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
						<div class="modal-body">
							<input type="hidden" class="form-control" id="ednielis" name="ednielis" readonly>
							<div class="form-group">
								<label for="exampleInputEmail1">Usuario:</label>
								<input type="text" class="form-control" id="enombreseli" readonly><br>
								<center><i class="fas fa-trash-alt fa-7x"></i></center>
							</div>
						</div>
						<div id="respuestaeliminarnuevo"></div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							<button type="button" class="btn btn-danger eliminarnewslista">Eliminar</button>
						</div>
					</form>
				</div>
			</div>
		</div>



		


		<script>
			$(".configurar").click(function() {

				var dnic = $(this).attr('dnic');



				var data = 'dnic=' + dnic ;
				$.ajax({
					type: "POST",
					url: "configurarusuario.php",
					data: data,
					success: function(data) {

						$('.respuestap').html(data);

					}
				})

			})

			$(".eliminaruser").click(function() {
				$('#eliminarm').modal('show');

				var ednic = $(this).attr('ednic');
				var enombresc = $(this).attr('enombresc');
				var eapellidospatc = $(this).attr('eapellidospatc');
				var eapellidosmatc = $(this).attr('eapellidosmatc');

				var enombrecompleto = ednic + " : " + enombresc + " " + eapellidospatc + " " + eapellidosmatc;


				$('#ednielis').val(ednic);
				$('#enombreseli').val(enombrecompleto);
			});

			$(".eliminarnewslista").click(function() {
				var id = $('#ednielis').val();
				var data = 'id=' + id;

				$.ajax({
					type: "POST",
					url: "eliminarlista.php",
					data: data,
					success: function(data) {
						$("#row" + id).hide();
						$('#respuestaeliminarnuevo').html(data);
						setTimeout(function() {
							$('#eliminarm').modal('hide');
						}, 2000);
					}
				})
			})



			
		</script>
	</body>

	</html>
<?php
} else {
	header("location:index.php");
}
?>