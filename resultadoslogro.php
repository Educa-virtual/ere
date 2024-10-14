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
        </style>
    </head>

    <body>


        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;


        sleep(0.5);

        $seleeva = $_POST['seleeva'];


        ?>


        <div class="card">
            <h6 class="card-header">


                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        .::Nivel de Logro
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" target="_blank" href="pdflogro.php?evaluacion=<?php echo $seleeva; ?>">Exportar en PDF</a>
                    </div>
                </div>



            </h6>


            <div class="card-body respuestagp">
                <table class="table table-sm table-bordered  table-striped table-hover ">
                    <thead>
                        <tr class="tablatitulor">
                            <th scope="col">Nro</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Area</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Nivel 1</th>
                            <th scope="col">Nivel 1</th>
                            <th scope="col">Resultado 1</th>
                            <th scope="col">Nivel 2</th>
                            <th scope="col">Nivel 2</th>
                            <th scope="col">Resultado 2</th>
                            <th scope="col">Nivel 3</th>
                            <th scope="col">Nivel 3</th>
                            <th scope="col">Resultado 3</th>
                            <th scope="col">Nivel 4</th>
                            <th scope="col">Nivel 4</th>
                            <th scope="col">Resultado 4</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Opciones</th>

                        </tr>
                    </thead>
                    <?php
                    $consl = 0;
                    $matrisrl = $asistencia->listadologro($seleeva);
                    while ($masil = mysqli_fetch_array($matrisrl)) {

                        $consl = $consl + 1;
                        echo "<tr class='tablacontenidor'>";

                        echo "<td>" . $consl . "</td>";
                        echo "<td>" . $masil['idnivel'] . "</td>";
                        echo "<td>" . $masil['descripcionarea'] . "</td>";
                        echo "<td>" . $masil['grado'] . "</td>";
                        echo "<td>" . $masil['iniciala'] . "</td>";
                        echo "<td>" . $masil['finala'] . "</td>";
                        echo "<td>" . $masil['resultadoa'] . "</td>";
                        echo "<td>" . $masil['inicialb'] . "</td>";
                        echo "<td>" . $masil['finalb'] . "</td>";
                        echo "<td>" . $masil['resultadob'] . "</td>";
                        echo "<td>" . $masil['inicialc'] . "</td>";
                        echo "<td>" . $masil['finalc'] . "</td>";
                        echo "<td>" . $masil['resultadoc'] . "</td>";
                        echo "<td>" . $masil['iniciald'] . "</td>";
                        echo "<td>" . $masil['finald'] . "</td>";
                        echo "<td>" . $masil['finald'] . "</td>";

                        if ($masil['calinivel'] == 0) {
                            echo "<td></td>";
                        } else {
                            echo "<td>Si</td>";
                        }

                        echo "<td><button type='button' title='Editar' class='btn btn-outline-primary btn-sm editarmatrie'  data-target='#editarmatri' id='" . $masil['idindicador']  . "' nivel='" . $masil['idnivel'] . "' descripcion='" . $masil['descripcionarea'] . "' grado='" . $masil['grado'] . "' inciala='" . $masil['iniciala'] . "' finala='" . $masil['finala'] . "' resultadoa='" . $masil['resultadoa'] . "'  incialb='" . $masil['inicialb'] . "' finalb='" . $masil['finalb'] . "' resultadob='" . $masil['resultadob'] . "' incialc='" . $masil['inicialc'] . "' finalc='" . $masil['finalc'] . "' resultadoc='" . $masil['resultadoc'] . "' inciald='" . $masil['iniciald'] . "' finald='" . $masil['finald'] . "' resultadod='" . $masil['resultadod'] . "'   >
                            <i class='fas fa-edit'></i></button>
                <button type='button' title='Eliminar' class='btn btn-outline-primary btn-sm editarmatrieef'  data-target='#editarmatrieef' idelimine='" . $masil['idindicador'] . "' ><i class='fas fa-eraser'></i></button>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editarmatrie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestacolmdr">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">EDITAR LOGRO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciacoml" id="formulario-asistenciacoml" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIVEL:</label>

                                        <input type="hidden" class="form-control" id="id" name="id">
                                        <input type="text" class="form-control" id="nvelel" name="nvelel" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">AREA:</label>
                                        <input type="text" class="form-control" id="aread" name="aread" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">GRADO:</label>
                                        <input type="text" class="form-control" id="grado" name="grado" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">INICIAL 1:</label>
                                        <input type="text" class="form-control" id="iniciala" name="iniciala">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">FINAL 1:</label>
                                        <input type="text" class="form-control" id="finala" name="finala">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">RESULTADO 1</label>
                                        <select class="form-control" id="resultadoa" name="resultadoa">
                                            <option value="">Seleccion</option>
                                            <option value="Previo Inicio">Previo Inicio</option>
                                            <option value="Inicio">Inicio</option>
                                            <option value="Proceso">Proceso</option>
                                            <option value="Satisfactorio">Satisfactorio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">INICIAL 2:</label>
                                        <input type="text" class="form-control" id="inicialb" name="inicialb">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">FINAL 2:</label>
                                        <input type="text" class="form-control" id="finalb" name="finalb">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">RESULTADO 2</label>


                                        <select class="form-control" id="resultadob" name="resultadob">
                                            <option value="">Seleccion</option>
                                            <option value="Previo Inicio">Previo Inicio</option>
                                            <option value="Inicio">Inicio</option>
                                            <option value="Proceso">Proceso</option>
                                            <option value="Satisfactorio">Satisfactorio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">INICIAL 3:</label>
                                        <input type="text" class="form-control" id="inicialc" name="inicialc">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">FINAL 3:</label>
                                        <input type="text" class="form-control" id="finalc" name="finalc">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">RESULTADO 3</label>


                                        <select class="form-control" id="resultadoc" name="resultadoc">
                                            <option value="">Seleccion</option>
                                            <option value="Previo Inicio">Previo Inicio</option>
                                            <option value="Inicio">Inicio</option>
                                            <option value="Proceso">Proceso</option>
                                            <option value="Satisfactorio">Satisfactorio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">INICIAL 4:</label>
                                        <input type="text" class="form-control" id="iniciald" name="iniciald">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">FINAL 4:</label>
                                        <input type="text" class="form-control" id="finald" name="finald">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">RESULTADO 4</label>

                                        <select class="form-control" id="resultadod" name="resultadod">
                                            <option value="">Seleccion</option>
                                            <option value="Previo Inicio">Previo Inicio</option>
                                            <option value="Inicio">Inicio</option>
                                            <option value="Proceso">Proceso</option>
                                            <option value="Satisfactorio">Satisfactorio</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" onclick="actualizar_logro()">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editarmatrieef" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestacolmdet">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciacomeliminar" id="formulario-asistenciacomeliminar" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Se eliminara el registro...</label>
                                <input type="text" class="form-control" id="idelimine" name="idelimine">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" onclick="eliminar_logro()">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <script>
            $(".editarmatrie").click(function() {
                $('#editarmatrie').modal('show');

                var id = $(this).attr('id');
                var nivel = $(this).attr('nivel');
                var descripcion = $(this).attr('descripcion');
                var grado = $(this).attr('grado');

                var inciala = $(this).attr('inciala');
                var finala = $(this).attr('finala');
                var resultadoa = $(this).attr('resultadoa');

                var incialb = $(this).attr('incialb');
                var finalb = $(this).attr('finalb');
                var resultadob = $(this).attr('resultadob');

                var incialc = $(this).attr('incialc');
                var finalc = $(this).attr('finalc');
                var resultadoc = $(this).attr('resultadoc');


                var inciald = $(this).attr('inciald');
                var finald = $(this).attr('finald');
                var resultadod = $(this).attr('resultadod');

                $('#id').val(id);
                $('#nvelel').val(nivel);
                $('#aread').val(descripcion);
                $('#grado').val(grado);

                $('#iniciala').val(inciala);
                $('#finala').val(finala);
                $('#resultadoa').val(resultadoa);

                $('#inicialb').val(incialb);
                $('#finalb').val(finalb);
                $('#resultadob').val(resultadob);

                $('#inicialc').val(incialc);
                $('#finalc').val(finalc);
                $('#resultadoc').val(resultadoc);

                $('#iniciald').val(inciald);
                $('#finald').val(finald);
                $('#resultadod').val(resultadod);


            });


            $(".editarmatrieef").click(function() {
                $('#editarmatrieef').modal('show');
                var idelimine = $(this).attr('idelimine');
                $('#idelimine').val(idelimine);
            });

            $(".editaranular").click(function() {
                $('#editaranular').modal('show');
                var idanu = $(this).attr('idanu');
                $('#idelimineanu').val(idanu);
            });


            function actualizar_logro() {
                var parametros = new FormData($("#formulario-asistenciacoml")[0]);
                $.ajax({
                        type: "POST",
                        url: "RActuindica.php",
                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestacolmdr").html(data);
                    })
                    .fail(function(data) {
                        alert("error");
                    })
                    .always(function() {});
            }

            function eliminar_logro() {
                var parametros = new FormData($("#formulario-asistenciacomeliminar")[0]);
                $.ajax({
                        type: "POST",
                        url: "RAlogroeliminar.php",
                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestacolmdet").html(data);
                    })
                    .fail(function(data) {
                        alert("error");
                    })
                    .always(function() {});
            }

            function actualizar_matrizanular() {
                var parametros = new FormData($("#formulario-asistenciacoml")[0]);
                $.ajax({
                        type: "POST",
                        url: "RAmatrizanular.php",
                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestacolmdanu").html(data);
                    })
                    .fail(function(data) {
                        alert("error");
                    })
                    .always(function() {});
            }
        </script>


    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>