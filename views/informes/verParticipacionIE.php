<?php session_start();
if ($_SESSION["dni"] != '') {
    require_once "./../../modelo/Ere.php";

    $ere = new Ere;
    // $ugeles = $ere->getUgeles();
    $evaluaciones = $ere->getAllData('historial_ere', 'id desc');
    $ugeles = $ere->getAllData('ugel', 'ugel desc');

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
        require_once "./../../cAdmision.php";
        $asistencia = new cAdmision;
        error_reporting(0);
        ?>
        <br>
        <div class="alert alert-warning alert-dismissible fade show" id="warningAlert" style="position: fixed; top: 20px; right: 20px; z-index: 1050; display: none;" role="alert">
            <strong>¡Advertencia!</strong> Por favor, selecciona un nivel y una UGEL y una evaluacion.
        </div>
        <div class="card">
            <h6 class="card-header">.:: INSTITUCIÓN EDUCATIVA</h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <select id="nivele" class="form-control">
                            <option value="" hidden selected>Nivel...</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select id="ugel" class="form-control">
                            <!-- <option value="">Ugel...</option> -->
                            <option value="" hidden selected>Ugel...</option>
                            <?php
                            foreach ($ugeles as $u)
                                echo "<option value='" . $u['ugel'] . "'>" . $u['ugeldescripcion'] . "</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="" id="evaluacion">
                            <option value="0" hidden selected>Evaluacion...</option>
                            <?php
                            foreach ($evaluaciones as $u)
                                echo "<option value='" . $u['id'] . "'>" . $u['desceva'] . "</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary enviar type=" button"><span class="spinner-border spinner-border-sm carga" role="status" aria-hidden="true"></span>
                            Procesar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="resultaint"></div>
        <!-- <script>
            $(document).ready(function() {
                $('.enviar').click(function() {
                    const nivele = $('#nivele').val();
                    const ugele = $('#ugel').val();
                    const evaluacion = $('#evaluacion').val();
                    if (nivele && ugele) {
                        $.ajax({
                            url: 'views/informes/iesQueParticipan.php',
                            type: 'POST',
                            data: {
                                nivele,
                                ugele,
                                evaluacion
                            },
                            success: function(res) {
                                $('#resultaint').html(res);
                            }
                        });
                    } else {
                        //alert("Por favor, selecciona un nivel y una UGEL.");
                        $('#warningAlert').fadeIn().delay(3000).fadeOut();
                        return;
                    }
                });
            });
        </script> -->
        <script>
            $(document).ready(function() {
                $('.enviar').click(function() {
                    const nivele = $('#nivele').val();
                    const ugele = $('#ugel').val();
                    const evaluacion = $('#evaluacion').val();

                    if (nivele && ugele && evaluacion != "0") {
                        // Si las tres opciones están seleccionadas
                        $.ajax({
                            url: 'views/informes/iesQueParticipan.php',
                            type: 'POST',
                            data: {
                                nivele,
                                ugele,
                                evaluacion
                            },
                            success: function(res) {
                                $('#resultaint').html(res); // Muestra la tabla con la respuesta
                            }
                        });
                    } else {
                        // Si alguna opción no está seleccionada, muestra el alerta y borra la tabla
                        $('#resultaint').html(''); // Borra la tabla
                        $('#warningAlert').fadeIn().delay(3000).fadeOut(); // Muestra el mensaje de advertencia
                    }
                });

                // Para borrar la tabla si se cambia alguna opción a "Seleccionar..."
                $('#nivele, #ugel, #evaluacion').change(function() {
                    const nivele = $('#nivele').val();
                    const ugele = $('#ugel').val();
                    const evaluacion = $('#evaluacion').val();

                    if (!nivele || !ugele || evaluacion == "0") {
                        $('#resultaint').html(''); // Borra la tabla si alguna opción no está seleccionada
                    }
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