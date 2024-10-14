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

        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">

                    <div class="card">
                        <h6 class="card-header">.:: <i class="fas fa-database"></i> REGISTROS </h6>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select class="form-control" id="evaluaci">
                                            <option value="">...</option>
                                            <?php
                                            $Listape = $asistencia->datacompletaevaluacion();
                                            while ($Lp = mysqli_fetch_array($Listape)) {
                                            ?>
                                                <option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
                                            <?php }; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <button class="btn btn-primary " type="button" id="btn">
                                        <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                        Procesar...
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <br>

                    <div id="respuesta">

                    </div>
                </div>
            </div>
        </div>


        <script>
            $('#btn').click(function() {

                var evaluacion = document.getElementById('evaluaci').value;

                var ruta = "evaluacion=" + evaluacion;

                if (evaluacion == '') {
                    $('#evaluaci').focus();
                    $('#evaluaci').css("background-color", "#ffe7e7");
                } else {
                    $.ajax({
                            url: 'asistenciacompleta.php',
                            type: 'POST',
                            data: ruta,
                            dataType: 'html',
                            beforeSend: function() {
                                $('.spinner-border').removeClass("carga");
                            }
                        })
                        .done(function(res) {
                            $('#respuesta').html(res);
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