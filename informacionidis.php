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
                    <h6 class="card-header">.:: INSTITUCIÓN EDUCATIVA</h6>
                    <div class="card-body respuestag">

                        <div class="row">


                            

                            <div class="col-6">
                                <select id="ugel" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <option value="gsc">General Sánchez Cerro</option>
                                    <option value="mn">Mariscal Nieto</option>
                                    <option value="ilo">Ilo</option>
                                    <option value="sanig">San Ignacio de Loyola</option>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">UGEL</small>
                            </div>

                            <div class="col-6">
                                                            
                                <button class="btn btn-primary enviar" type="button" >
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


                var ugele = document.getElementById('ugel').value;
                var ruta = "ugele=" + ugele;

                if (ugele == '') {
                        $("#ugel").focus();
                        $('#ugel').addClass("color");
                } else {
                    
                        $.ajax({
							url: 'resultadosinformacionmdist.php',
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


                }



            });
        </script>

    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>