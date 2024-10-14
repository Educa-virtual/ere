    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
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
                <h6 class="card-header">.:: <i class="fas fa-user-alt"></i> Crear Matriz de Evaluación</h6>
                <div class="card-body respuestafi">
                    <div class="container-fluid">
                        <form id="formulario-matriz" name="formulario-matriz" method=" POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Evaluación</small>
                                    <select class="form-control" name="seleeva" id="seleeva"><br><br>
                                        <option value="">Seleccione Evaluación</option>
                                        <?php
                                        $Listape = $asistencia->datacompletaevaluacionestado();
                                        while ($Lp = mysqli_fetch_array($Listape)) {
                                        ?>
                                            <option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Nivel</small>
                                    <select class="form-control" name="selenivel" id="selenivel"><br><br>
                                        <option value="">Seleccione Nivel</option>
                                        <option value="Primaria">Primaria</option>
                                        <option value="Secundaria">Sedundaria</option>

                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Grado</small>
                                    <select class="form-control" name="selegra" id="selegra"><br><br>
                                        <option value="">Seleccione Grado</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Area</small>
                                    <select class="form-control" name="seleare" id="seleare"><br><br>
                                        <option value="">Seleccione Area</option>
                                        <?php
                                        $Listaper = $asistencia->iverareas();
                                        while ($Lpr = mysqli_fetch_array($Listaper)) {
                                        ?>
                                            <option value="<?php echo $Lpr['cod']; ?>"><?php echo $Lpr['descripcionarea'];  ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <small id="emailHelp" class="form-text text-muted">Competencia</small>
                                    <input type="text" class="form-control" name="competese">
                                </div>
                                <div class="col-md-6">
                                    <small id="emailHelp" class="form-text text-muted">Capacidad</small>
                                    <input type="text" class="form-control" name="capacidas">
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <small id="emailHelp" class="form-text text-muted">Desempeño</small>
                                    <input type="text" class="form-control" name="desempa">
                                </div>
                                <div class="col-md-6">
                                    <small id="emailHelp" class="form-text text-muted">Caracterización del ITEM</small>
                                    <input type="text" class="form-control" name="caracteriten">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Conocimiento</small>
                                    <input type="text" class="form-control" name="conocimient">
                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Item</small>
                                    <input type="text" class="form-control" name="items" id="items">
                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Nivel</small>
                                    <input type="text" class="form-control" name="nivell" id="nivell">
                                </div>
                                <div class="col-md-3">
                                    <small id="emailHelp" class="form-text text-muted">Clave</small>
                                    <input type="text" class="form-control" name="clavees" id="clavees">
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <button class="btn btn-primary" type="button" id="btngrabar" onclick="actualizar_asistenciad()">
                                            <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                            Grabar
                                        </button>
                                    </center>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <script>
                function actualizar_asistenciad() {


                    var parametros = new FormData($("#formulario-matriz")[0]);
                    $.ajax({
                            type: "POST",
                            url: "Gmatriz.php",
                            data: parametros,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('.spinner-border').removeClass("cargar");
                            }

                        })
                        .done(function(data) {
                            $(".respuestafi").html(data);
                            $('.spinner-border').addClass("cargar");
                        })
                        .fail(function(data) {
                            alert("error");
                        })
                        .always(function() {});

                };
            </script>

    </body>

    </html>