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
        <link rel="stylesheet" href="css/disenooptimizado.css">
    </head>

    <body>
        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        ?>
        <BR>
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <h6 class="card-header">.:: <i class="fas fa-user-alt"></i> REGISTRO DE PERSONAL</h6>
                <div class="card-body respuestagp">
                    <form id="formularioperso" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class="sut">DNI : </label>
                                <input type="text" class="form-control" id="dni" name="dni">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="sut">NOMBRES</label>
                                <input type="text" class="form-control" id="nombre" name="nombres">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="sut">APELLIDOS PATERNO</label>
                                <input type="text" class="form-control" id="apellidopat" name="apellidospat">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="sut">APELLIDOS MATERNO</label>
                                <input type="text" class="form-control" id="apellidomat" name="apellidosmat">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="sut">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="sut">Nro Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="sut">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="inputCity" name="fechanacimiento">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="sut">Sexo</label>
                                <select id="inputState" class="form-control" name="sexo">
                                    <option value="">Seleccione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <center>
                            <button class="btn btn-primary" type="button" onclick="guardarpersonal()">
                                <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Registrar Usuario</span>
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function guardarpersonal() {

                var dni = document.getElementById('dni').value;
                var nombre = document.getElementById('nombre').value;

                var apellidopat = document.getElementById('apellidopat').value;
                var apellidomat = document.getElementById('apellidomat').value;

                var email = document.getElementById('email').value;
                var celular = document.getElementById('celular').value;


                if (dni == '') {
                    $('#dni').css("background-color", "#ffe7e7");
                    $('#dni').focus();
                } else if (nombre == '') {
                    $('#nombre').css("background-color", "#ffe7e7");
                    $('#nombre').focus();
                } else if (apellidopat == '') {
                    $('#apellido').css("background-color", "#ffe7e7");
                    $('#apellido').focus();
                } else if (email == '') {
                    $('#email').css("background-color", "#ffe7e7");
                    $('#email').focus();
                } else if (celular == '') {
                    $('#celular').css("background-color", "#ffe7e7");
                    $('#celular').focus();
                } else {
                    var parametros = new FormData($("#formularioperso")[0]);

                    $.ajax({
                            type: "POST",
                            url: "Gpersonal.php",
                            data: parametros,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('.spinner-border').removeClass("cargar");
                            }
                        })
                        .done(function(data) {
                            $(".respuestagp").html(data);
                        })
                        .fail(function(data) {
                            alert("error");
                        })
                        .always(function() {});
                }
            }
        </script>

    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>