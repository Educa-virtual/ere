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


    </head>

    <body>

        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;

        ?>

        <br>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <h6 class="card-header">.:: <i class="fas fa-clipboard-list"></i> INFORMACION DE PERSONAL</h6>
                    <div class="card-body respuesta">
                        <div class="row">

                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="textop" placeholder="buscar...">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">

                                    <select class="form-control" id="perfilusuarios">
                                        <option value="">Perfil de Usuario</option>
                                        <option value="1">ADMINISTRADOR</option>
                                        <option value="3">DREMO</option>
                                        <option value="4">UGEL</option>
                                        <option value="5">DIRECTOR IE</option>
                                        <option value="6">ESTUDIANTE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <button class="btn btn-primary Cpersonal" type="button">
                                    <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                    <span class="visually-hidden"> Procesar</span>
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <h6 class="card-header">.:: <i class="fas fa-user-alt"></i> INFORMACIÓN USUARIOS</h6>
                    <div class="card-body respuestap">
                    </div>
                </div>
            </div>
        </div>



 
        <script>
            $(".Cpersonal").click(function() {
                var textop = document.getElementById("textop").value;
                var textoperfil = document.getElementById("perfilusuarios").value;
                
                var ruta = "textop=" + textop + "&textoperfil=" + textoperfil;
                $.ajax({
                    url: "Cpersonal.php",
                    type: "POST",
                    data: ruta,
                    dataType: "html",
                    beforeSend: function() {
                        $('.spinner-border').removeClass("cargar");
                    }
                }).done(function(res) {
                    $(".respuestap").html(res);
                    $('.spinner-border').addClass("cargar");
                });
            });
        </script>

    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>