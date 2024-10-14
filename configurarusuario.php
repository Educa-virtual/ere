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
	$dnic = $_POST['dnic'];

	$Lsp = $claseAulaV->verusuarios($dnic);
	while ($Lwp = mysqli_fetch_array($Lsp)) {
		$dniusu = $Lwp['dni'];
		$nombresc = $Lwp['nombres'];
		$apellidospatc = $Lwp['apellidopat'];
		$apellidosmatc = $Lwp['apellidomat'];
		$email = $Lwp['email'];
		$celularc = $Lwp['celular'];
		$fecna = $Lwp['fechanacimiento'];
		$sexov = $Lwp['sexo'];
	}

	$Lspw = $claseAulaV->verusuariosdetalle($dnic);
	while ($Lwpw = mysqli_fetch_array($Lspw)) {
		$iddetalleusmo = $Lwpw['iddetalleus'];
		$tipom = $Lwpw['tipo'];
		$evaluacio = $Lwpw['idevaluacion'];
	}


	$Lspwnum = $claseAulaV->conteverusuariosdetalle($dnic);
	while ($Lwpwz = mysqli_fetch_array($Lspwnum)) {
		$rescon = $Lwpwz[0];
	}

	if ($rescon == 0) {
	} else {
		$Lspwa = $claseAulaV->evaluacionmoestrar($evaluacio);
		while ($Lwpwa = mysqli_fetch_array($Lspwa)) {

			$deseva = $Lwpwa['descripcion'];
		}

		$Lspwae = $claseAulaV->evaluacionmoestrartipo($tipom);
		while ($Lwpwae = mysqli_fetch_array($Lspwae)) {

			$destipo = $Lwpwae['descripciontipo'];
		}
	}



	?>
	<input type="hidden" value="<?php echo $iddetalleusmo; ?>" id="iddetalleusmo">
	<input type="hidden" value="<?php echo $dnic ?>" id="dnicambiar">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<h5 class="card-title"><?php echo $nombresc . " " . $apellidospatc . " " . $apellidosmatc; ?></h5>
							<h6 class="card-subtitle mb-2 text-muted">DNI: <?PHP echo $dnic; ?></h6>
							<h7 class="card-text"><i class="fas fa-mobile-alt"> </i> <?PHP echo $celularc;  ?> <i class="fas fa-envelope"></i> <?PHP echo $email; ?></h7><br><br>

							

								<h7 class="card-text">Rol : <b id="tipon"> <?PHP echo $destipo;  ?></b></h7><br>
							
							<button type="button" class="btn btn-primary btn-sm cambiaresta" dnices="<?php echo $dnic; ?>">Asignar Rol</button>
							<button type="button" class="btn btn-primary btn-sm cambiarestaagre" dnices="<?php echo $dnic; ?>">Asignar Institución</button>


						</div>
						<div class="col-6">

							<button type="button" class="btn btn-primary btn-sm reestablecer" dnices="<?php echo $dnic; ?>">Reestablecer Contraseña</button><br>
							<a href="#" class="card-link">Información Profesional</a><br>
							<a href="#" class='card-link editarusuario' dnicu='<?php echo  $dni; ?>' nombrescu='<?php echo $nombresc; ?>' apellidospatcu='<?php echo $apellidospatc; ?>' apellidosmatcu='<?php echo $apellidosmatc; ?>' celularcu='<?php echo $celularc; ?>' emailcu='<?php echo $emailc; ?>'>
								Actualizar Información</a>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-body">

					</p>

					<div id="resultadocomplemento">
						<table class="table table-striped">
							<thead>
								<tr class="tablatitulo">
									<th scope="col">#</th>
									<th scope="col">UGEL</th>
									<th scope="col">CODIGO MODULAR</th>
									<th scope="col">DESCRIPCION</th>
									<th scope="col">NIVEL</th>
									<th scope="col">GRADO</th>
									<th scope="col">SECCION</th>
									<th scope="col">OPCIONES</th>
								</tr>
							</thead>
							<tbody>
								<?php


								if ($rescon == 0) {
								} else {


									$cond = 0;
									$Lstz = $claseAulaV->mostracomplemente($iddetalleusmo);
									while ($Lw = mysqli_fetch_array($Lstz)) {
										$cond = $cond + 1;
										echo "<tr id='row" . $Lw['id'] . "' class='tablacontenido'>";
										echo "<td>" . $cond . "</td>";

										$Lstwz = $claseAulaV->verugel($Lw['ugel']);
										while ($Lwe = mysqli_fetch_array($Lstwz)) {
											echo "<td>" . $Lwe['ugeldescripcion']  . "</td>";
										}


										echo "<td>" . $Lw['codmodular'] . "</td>";
										$Lstwzw = $claseAulaV->veries($Lw['codmodular']);
										while ($Lwet = mysqli_fetch_array($Lstwzw)) {
											echo "<td>" . $Lwet['descripcion']  . "</td>";
										}
										echo "<td>" . $Lw['nivel'] . "</td>";
										echo "<td>" . $Lw['grado'] . "</td>";
										echo "<td>" . $Lw['seccion'] . "</td>";

										echo "<td><button type='button' title='Eliminar' class='btn btn-light-primary btn-sm eliminaruserinfo'   ednice='" . $Lw['id'] . "' ><i class='fas fa-user-times'></i></button></td>";
										echo "</tr>";
									}
								}
								?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
			<br>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="estadonew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content respuestaeli">
					<div class="modal-header modeldi">
						<h5 class="modal-title" id="exampleModalLabel">Actualizar Estado</h5>
					</div>
					<form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
						<div class="modal-body">

							<input type="text" class="form-control" id="ednielisesta" name="ednielis" readonly>
							<br>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text" for="inputGroupSelect01">Rol</label>
								</div>
								<select class="custom-select" id="perfilusuario">
									<option value="">...</option>
									<?php

									$Listapewt = $claseAulaV->datacompletaevaluaciontabla('tipo');
									while ($Lpwt = mysqli_fetch_array($Listapewt)) {
									?>
										<option value="<?php echo $Lpwt['idtipo']; ?>"><?php echo $Lpwt['descripciontipo'];  ?></option>
									<?php }; ?>
								</select>
							</div>
							<br>
							<div class="input-group mb-3">

								<input type="hidden" value="" id="Evaluacionusu">

							</div>
							<div class="input-group mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="revisarie" name="revisarie">
									<label class="form-check-label" for="defaultCheck1">
										Insitución Educativa
									</label>
								</div>
							</div>
						</div>

						<div id="respuesore"></div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							<button type="button" class="btn btn-danger actualizares">Actualizar Estado</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="agregaries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content infodetak">


				</div>
			</div>
		</div>



		<!-- Modal -->
		<div class="modal fade" id="eliminarminfon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content respuestaeli">
					<div class="modal-header modeldi">
						<h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
					</div>
					<form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
						<div class="modal-body">
							<input type="hidden" class="form-control" id="ednielisr" name="ednielisr" readonly>
							<div class="form-group">

								<center><i class="fas fa-trash-alt fa-7x"></i></center>
							</div>
						</div>
						<div id="respuestaeliminarnuevo"></div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							<button type="button" class="btn btn-danger eliminarnewslistanuevo">Eliminar</button>
						</div>
					</form>
				</div>
			</div>
		</div>



		<!-- Modal -->
		<div class="modal fade" id="reestablecerm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content respuestaeli">
					<div class="modal-header modeldi">
						<h5 class="modal-title" id="exampleModalLabel">Reestablecer Contraseña</h5>
					</div>
					<form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
						<div class="modal-body">
							<input type="hidden" id="ednielisrt" name="ednielisrt">
							<input type="hidden" id="iddnian" name="iddnian">
							<div class="form-group">
								<center><i class="fas fa-key fa-7x"></i></center>
							</div>
						</div>
						<div id="respuestaeliminarnuevoat"></div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							<button type="button" class="btn btn-danger reetablecerdni">Reestablecer Contraseña</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script>
			$(".eliminaruserinfo").click(function() {
				$('#eliminarminfon').modal('show');

				var ednice = $(this).attr('ednice');

				$('#ednielisr').val(ednice);

			});

			$(".eliminarnewslistanuevo").click(function() {
				var id = $('#ednielisr').val();
				var data = 'id=' + id;

				$.ajax({
					type: "POST",
					url: "eliminarlistausuario.php",
					data: data,
					success: function(data) {
						$("#row" + id).hide();
						$('#respuestaeliminarnuevo').html(data);
						setTimeout(function() {
							$('#eliminarminfon').modal('hide');
						}, 500);
					}
				})
			})

			$(".reetablecerdni").click(function() {
				var id = $('#ednielisrt').val();
				var dnienvi = $('#iddnian').val();

				var data = 'id=' + id + '&dni=' + dnienvi;

				$.ajax({
					type: "POST",
					url: "RAasistenciaclave.php",
					data: data,
					success: function(data) {
						$("#row" + id).hide();
						$('#respuestaeliminarnuevoat').html(data);
						setTimeout(function() {
							$('#reestablecerm').modal('hide');
						}, 500);
					}
				})
			})


			$(".reestablecer").click(function() {

				$('#reestablecerm').modal('show');


				var ednicee = $('#iddetalleusmo').val();
				var dnicam = $('#dnicambiar').val();

				$('#ednielisrt').val(ednicee);
				$('#iddnian').val(dnicam);



			});



			$(".cambiaresta").click(function() {
				$('#estadonew').modal('show');
				var idnuevo = $(this).attr('dnices');
				$('#ednielisesta').val(idnuevo);

			});


			$(".cambiarestaagre").click(function() {
				$('#agregaries').modal('show');
				var idnuevo = $(this).attr('dnices');
				var data = 'idnuevo=' + idnuevo;

				$.ajax({
					type: "POST",
					url: "infodetalle.php",
					data: data,
					success: function(data) {
						$('.infodetak').html(data);
					}
				})


			});



			$(".actualizares").click(function() {
				var dnies = $('#ednielisesta').val();
				var perfilusu = $('#perfilusuario').val();
				var Evaluacionusu = $('#Evaluacionusu').val();
				var iddetalle = $('#iddetalleusmo').val();
				var revisarie = $('input[name=revisarie]:checked').val();


				if (perfilusu == 1) {
					var descirp = 'Administrador'
				} else if (perfilusu == 2) {
					var descirp = 'DOCENTE'
				} else if (perfilusu == 3) {
					var descirp = 'DREMO'
				} else if (perfilusu == 4) {
					var descirp = 'UGEL'
				} else {
					var descirp = 'DIRECTOR I.E.'
				}

				if (Evaluacionusu == 1) {
					var Evaluacionusud = 'ERE2021-I'
				} else if (Evaluacionusu == 2) {
					var Evaluacionusud = 'ERE2021-II'
				} else if (Evaluacionusu == 136) {
					var Evaluacionusud = 'ERE2022-I'
				} else {
					var Evaluacionusud = 'ERE2022-II'
				}



				var data = 'dniesf=' + dnies + '&perfilusu=' + perfilusu + '&Evaluacionusu=' + Evaluacionusu + '&iddetalle=' + iddetalle + '&revisarie=' + revisarie;
				$.ajax({
					type: "POST",
					url: "Aestado.php",
					data: data,
					success: function(data) {

						$('#deseval').text(Evaluacionusud)
						$('#tipon').text(descirp);


						$('#respuesore').html(data);

						setTimeout(function() {
							$('#estadonew').modal('hide');
						}, 5000);
					}
				})
			})
		</script>
</body>

</html>