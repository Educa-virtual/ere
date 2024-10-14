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

	error_reporting(0);

	require_once "cAdmision.php";
	$claseAulaV = new cAdmision;
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

	$contpw = $claseAulaV->contarprerguntascuadr($dnicf);
	while ($contppw = mysqli_fetch_array($contpw)) {
		$contadorw = $contppw[0] + 1;
	}
	?>


	<div class="card respuestafi">
		<div class="card-header">
			Area : <b><?php echo $areades; ?> </b> | Nivel : <b><?php echo $nivel; ?> </b>| Grado : <b><?php echo $grado; ?> </b> | Pregunta Nro : <b><input type="text" value="<?php echo $contadorw; ?>" id="idpreguntas"> </b>
		</div>
		<div class="card-body">
			<h5 class="card-title">Pregunta .-</h5>
			<input type="hidden" value="<?php echo $dnicf; ?>" name="idexaemen" id="idexaemen">
			<textarea class="ckeditor" name="ckeditor" id="ckeditor"></textarea><br>
			<h5 class="card-title">Alternativas.-</h5>
			<div class="row">

				<div class="col-sm-2"><input type="text" value="A" class="inputaltern" id="preguntaa"></div>
				<div class="col-sm-8"><textarea class="ckeditora" name="ckeditora" id="ckeditora"></textarea></div>
			</div>
			<div class="row">

				<div class="col-sm-2"><input type="text" value="B" readonly class="inputaltern" id="preguntab"></div>
				<div class="col-sm-8"><textarea class="ckeditorb" name="ckeditorb" id="ckeditorb"></textarea></div>
			</div>
			<div class="row">

				<div class="col-sm-2"><input type="text" value="C" readonly class="inputaltern" id="preguntac"></div>
				<div class="col-sm-8"><textarea class="ckeditorc" name="ckeditorc" id="ckeditorc"></textarea></div>
			</div>
			<div class="row">

				<div class="col-sm-2"><input type="text" value="D" readonly class="inputaltern" id="preguntad"></div>
				<div class="col-sm-8"><textarea class="ckeditord" name="ckeditord" id="ckeditord"></textarea></div>
			</div>






			<br>
			<center>
				<button class="btn btn-primary enviarpreg btn-lg" type="button">
					<span class="spinner-border spinner-border-sm cargar " role="status" aria-hidden="true"></span>
					Grabar Pregunta
				</button>
			</center>
		</div>
	</div>




	<script src="ckeditor/ckeditor.js" type="text/javascript">

	</script>



	<script>
		CKEDITOR.replace('ckeditor', {
			filebrowserUploadUrl: 'ckeditor/ck_upload.php',
			filebrowserUploadMethod: 'form'
		});


		CKEDITOR.replace('ckeditora', {
			filebrowserUploadUrl: 'ckeditor/ck_upload.php',
			filebrowserUploadMethod: 'form'
		});

		CKEDITOR.replace('ckeditorb', {
			filebrowserUploadUrl: 'ckeditor/ck_upload.php',
			filebrowserUploadMethod: 'form'
		});

		CKEDITOR.replace('ckeditorc', {
			filebrowserUploadUrl: 'ckeditor/ck_upload.php',
			filebrowserUploadMethod: 'form'
		});

		CKEDITOR.replace('ckeditord', {
			filebrowserUploadUrl: 'ckeditor/ck_upload.php',
			filebrowserUploadMethod: 'form'
		});
	</script>



	<script>
		$('.enviarpreg').click(function() {

			var preguntaa = document.getElementById('preguntaa').value;
			var preguntab = document.getElementById('preguntab').value;
			var preguntac = document.getElementById('preguntac').value;
			var preguntad = document.getElementById('preguntad').value;

			var valuea = CKEDITOR.instances['ckeditora'].getData();
			var valueb = CKEDITOR.instances['ckeditorb'].getData();
			var valuec = CKEDITOR.instances['ckeditorc'].getData();
			var valued = CKEDITOR.instances['ckeditord'].getData();

			var value = CKEDITOR.instances['ckeditor'].getData();
			var idexaemen = document.getElementById('idexaemen').value;
			var idpreguntas = document.getElementById('idpreguntas').value;

			var ruta = "foro=" + value + "&idexaemen=" + idexaemen + "&idpreguntas=" + idpreguntas + "&preguntaa=" + preguntaa + "&preguntab=" + preguntab + "&preguntac=" + preguntac + "&preguntad=" + preguntad + "&valuea=" + valuea + "&valueb=" + valueb + "&valuec=" + valuec + "&valued=" + valued;

			$.ajax({

					url: 'Gpregunta.php',

					type: 'POST',

					data: ruta,

					dataType: 'html',

				})

				.done(function(res) {

					$('.respuestafi').html(res);

				})

		});
	</script>

</body>

</html>