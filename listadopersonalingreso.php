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

            .suta {
                font-size: 12px;
                font-weight: bolder;
            }

            .sutanumer{
                font-size: 20px;
                font-weight: bolder;
     
            }

            .alineacion{
              
                text-align: center;
            }

        </style>
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
                    <h6 class="card-header">.:: <i class="fas fa-clipboard-list"></i> INFORMACION DE INGRESOS DE USUARIOS</h6>
                    <div class="card-body respuesta">
                        <form>
                            <div class="row">
                                <div class="col-sm-12 col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="textopd" placeholder="Ingrese datos a buscar...">
                                    </div>
                                </div>

                                
                                <div class="col-sm-12 col-md-2">
                                    <button class="btn btn-primary Cpersonal" type="button">
                                        <span class="spinner-border spinner-border-sm carga" role="status" aria-hidden="true"></span>
                                        <span class="visually-hidden"> Procesar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <h6 class="card-header">.:: <i class="fas fa-user-alt"></i> INFORMACIÓN DE USUARIOS</h6>
                    <div class="card-body respuestap">
                    </div>
                </div>
            </div>
        </div>
        </div>



        <script>
            $(" .Cpersonal").click(function() {
                var textop = document.getElementById("textopd").value;
                
                var ruta = "textop=" + textop ;
                
                $.ajax({
                    url: "Cusuarios.php",
                    type: "POST",
                    data: ruta,
                    dataType: "html",
                    beforeSend: function() {
                        $('.spinner-border').removeClass("carga");
                    }
                }).done(function(res) {
                    $(".respuestap").html(res);
                    $('.spinner-border').addClass("carga");
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