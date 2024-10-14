<?php session_start();

if ($_SESSION["dni"] != '') {

?>
	<!DOCTYPE html>
	<html lang="en">

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
		$idtipo = $_SESSION['idtipo'];
		$dnicf = $_POST['dnicf'];

		$lidpregunta = $claseAulaV->idpregunta($dnicf);
		while ($lisid = mysqli_fetch_array($lidpregunta)) {
			$nivel = $lisid['nivel'];
			$area = $lisid['area'];
			$grado = $lisid['grado'];
		}

		$matrisrarea = $claseAulaV->matrisnuevoarea($area);
		while ($masiarea = mysqli_fetch_array($matrisrarea)) {
			$areades = $masiarea['descripcionarea'];
		}


		?>
		<input type="hidden" id="areaenvia" value="<?php echo $area; ?>">
		<div class="card respuestagprfs">
			<div class="card-header">
				.::PRUEBA REGIONAL DE INICIO
			</div>
			<div class="card-body">
				<CENTER>
					<h2 class="card-title"><b><?php echo strtoupper($areades); ?> </b></h2><br>
				</CENTER>
				<table class="table table-sm table-bordered  ">
					<?PHP
					$contn = 0;
					$lidpreguntaw = $claseAulaV->preguntase($dnicf);
					while ($lisidw = mysqli_fetch_array($lidpreguntaw)) {
						$contn = $contn + 1;
						$idpreguntan = $lisidw['descripcion'];
						echo "<tr>";
						echo "<td class='preguntaeva'>" . $lisidw['descripcion'] . "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td class='alternativaseva'>
					<div class='form-check'>
					<input class='form-check-input' type='radio' name='demo$contn' id='exampleRadios.$idpreguntan.1' value='" . $lisidw['a'] . "'>
					<label class='form-check-label' for='exampleRadios.$idpreguntan.1'>
					<div class='container'>
  <div class='row'>
    <div class='col'>
	" . $lisidw['a'] . " .-
    </div>
    <div class='col'>
    " . $lisidw['alternativaa'] . "
    </div>
  </div>
  </div>
					
					 </label>
				  </div>
				  <div class='form-check'>
					<input class='form-check-input' type='radio' name='demo$contn' id='exampleRadios.$idpreguntan.2' value='" . $lisidw['b'] . "'>
					<label class='form-check-label' for='exampleRadios.$idpreguntan.2'>
					<div class='container'>
					<div class='row'>
    <div class='col'>
	" . $lisidw['b'] . " .-
    </div>
    <div class='col'>
    " . $lisidw['alternativab'] . "
    </div>
  </div>
  </div>
			
					</label>
					</div>
					<div class='form-check'>
					<input class='form-check-input' type='radio' name='demo$contn' id='exampleRadios.$idpreguntan.3' value='" . $lisidw['c'] . "'>
					<label class='form-check-label' for='exampleRadios.$idpreguntan.3'>
					<div class='container'>
					<div class='row'>
    <div class='col'>
	" . $lisidw['c'] . " .-
    </div>
    <div class='col'>
    " . $lisidw['alternativac'] . "
    </div>
  </div>
  </div>
			
					</label>
				  </div>
				  <div class='form-check'>
					<input class='form-check-input' type='radio' name='demo$contn' id='exampleRadios.$idpreguntan.4' value='" . $lisidw['d'] . "'>
					<label class='form-check-label' for='exampleRadios.$idpreguntan.4'>
					<div class='container'>
					<div class='row'>
					<div class='col'>
					" . $lisidw['d'] . " .-
					</div>
					<div class='col'>
					" . $lisidw['alternativad'] . "
					</div>
				  </div>
				  </div>
							
					</label>
				  </div><br>
				  </td>";

						echo "</tr>";
					}
					?>
				</table>

				<?php
				if ($idtipo == '6') {
				?>

					<center>
						<button class="btn btn-primary enviarrespuesta" type="button">
							<span class="spinner-border spinner-border-sm cargar " role="status" aria-hidden="true"></span>
							Finalizar Evaluación
						</button>
					</center>

				<?php } ?>

			</div>
		</div>


		<script>
			$(".enviarrespuesta").click(function() {
				var areaenvia = document.getElementById('areaenvia').value;
				var opcion1 = $('input:radio[name=demo1]:checked').val();
				var opcion2 = $('input:radio[name=demo2]:checked').val();
				var opcion3 = $('input:radio[name=demo3]:checked').val();
				var opcion4 = $('input:radio[name=demo4]:checked').val();
				var opcion5 = $('input:radio[name=demo5]:checked').val();
				var opcion6 = $('input:radio[name=demo6]:checked').val();

				var data = 'opcion1=' + opcion1 + '&opcion2=' + opcion2 + '&opcion3=' + opcion3 + '&opcion4=' + opcion4 + '&opcion5=' + opcion5 + '&opcion6=' + opcion6 + '&areaenvia=' + areaenvia;
				$.ajax({
					type: "POST",
					url: "Gevaluacioncuadernillo.php",
					data: data,
					success: function(data) {

						$('.respuestagprfs').html(data);

					}
				})




			});
		</script>

	</body>

	</html>
<?php

} else {

	header("location:index.php");
}

?>