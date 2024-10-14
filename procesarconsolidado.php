<?php session_start();

if ($_SESSION["dni"] != '') {

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel='stylesheet' href='css/stylep.css'>
        <style>
            .carga {
                display: none;
            }

            .color {
                border-color: red;
            }
        </style>
    </head>

    <body>

        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;


        error_reporting(0);
        ?>

        <br>



        <div class="row">
            <div class="col-sm-12 col-md-12">

                <div class="card">
                    <h6 class="card-header">.:: Procesar Evaluación</h6>
                    <div class="card-body respuestag">

                        <div class="row">
                            <div class="col-2">
                                <select class="form-control" id="evaluacion">
									<option value="" selected>...</option>
									<?php
									$Listape = $asistencia->datacompletaevaluacionlista();
									while ($Lp = mysqli_fetch_array($Listape)) {
									?>
										<option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
									<?php }; ?>
								</select>
                                <small id="emailHelp" class="form-text text-muted">Evaluación</small>
                            </div>
                            <div class="col-4">
                                <select class="form-control" id="evaugel">
									<option value="" selected>...</option>
                                    <option value="gsc">General Sanchez Cerro</option>
                                    <option value="ilo">Ilo</option>
                                    <option value="mn">Mariscal nieto</option>
                                    <option value="sanig">San Ignacion de Loyola</option>
								</select>
                                <small id="emailHelp" class="form-text text-muted">UGEL</small>
                            </div>
                            <div class="col-2">
                                <select class="form-control" id="nivel">
									<option value="" selected>...</option>
                                    <option value="PRIMARIA">PRIMARIA</option>
                                    <option value="SECUNDARIA">SECUNDARIA</option>
								</select>
                                <small id="emailHelp" class="form-text text-muted">NIVEL</small>
                            </div>
                            <div class="col-2">
                                <select class="form-control" id="gradoc">
									<option value="" selected>...</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="6">6</option>
								</select>
                                <small id="emailHelp" class="form-text text-muted">GRADO</small>
                            </div>

                            <div class="col-2">
                                <button class="btn btn-primary enviar" type="button">
                                    <span class="spinner-border spinner-border-sm carga" role="status" aria-hidden="true"></span>
                                    Procesar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><BR>

        <div id="resultaint">

        </div>



        <script>
            $('.enviar').click(function() {

                var nivele = document.getElementById('evaluacion').value;
                var evaugel = document.getElementById('evaugel').value;
                var nivel = document.getElementById('nivel').value;
                var gradoc = document.getElementById('gradoc').value;

                
                
                 var ruta = "nivele=" + nivele + "&evaugel=" + evaugel+ "&nivel=" + nivel+ "&gradoc=" + gradoc;

                    $.ajax({
                            url: 'resultadosinformaconsolidado.php',
                            type: 'POST',
                            data: ruta,
                            dataType: 'html',
                            beforeSend: function() {
                                $('.spinner-border').removeClass("carga");
                            }
                        })
                        .done(function(res) {
                            $('#resultaint').html(res);
                            $('.spinner-border').addClass("carga");
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