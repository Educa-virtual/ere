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
        <br>
        <div class="col-sm-12 col-md-12">
            <div class="card col-sm-6 mx-auto">
                <h6 class="card-header">.:: <i class="fas fa-cogs"></i> CREAR EVALUACIÓN</h6>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="sut"><i class="fas fa-caret-right"></i> Nombre</label><br>
                            <input type="text" class="form-control" name="evaluacion" id="evanuevo"
                                style="text-align: center;"><br>
                            <label class="sut"><i class="fas fa-caret-right"></i> Descripción</label><br>
                            <input type="text" class="form-control" name="evaluacion" id="evanuevodes"
                                style="text-align: center;"><br>
                            <button class="btn btn-primary mx-auto d-block" type="button" id="btn">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                                <span class="visually-hidden">Crear Evaluación</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#btn').click(function() {
                $(this).attr('disabled', true); // Desactiva el botón
                var evaluacion = document.getElementById('evanuevo').value;
                var evanuevodes = document.getElementById('evanuevodes').value;
                var ruta = "evaluacion=" + evaluacion + "&evanuevodes=" + evanuevodes;
                if (evaluacion == '') {
                    $('#evanuevo').focus();
                    $('#evanuevo').css("background-color", "#ffe7e7");
                    $(this).attr('disabled', false);
                } else {
                    $('.spinner-border').show();
                    $.ajax({
                        url: 'Gevaluacion.php',
                        type: 'POST',
                        data: ruta,
                        dataType: 'html',
                        success: function(res) {
                            $('.respuestagp').html(res);
                        },
                        complete: function() {
                            $('.spinner-border').hide();
                            $('#btn').attr('disabled', false);
                        }
                    });
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