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
        <link rel='stylesheet' href='css/disenooptimizado.css'>
  
    </head>
    <body>
        <script src="code/highcharts.js"></script>
        <script src="code/modules/data.js"></script>
        <script src="code/modules/exporting.js"></script>
        <script src="code/modules/export-data.js"></script>
        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        sleep(1);
        $seleeva = $_POST['seleeva'];
        $nivele = $_POST['nivele'];
        $cursoe = $_POST['cursoe'];
        $gradoe = $_POST['gradoe'];
        ?>
        <div class="card">
            <h6 class="card-header">.:: MATRIZ DE EVALUACIÓN</h6>
            <div class="card-body respuestagp">
                <table  class="table table-sm table-bordered  table-striped table-hover " >
                    <thead class="tablatitulo">
                        <tr>
                            <th scope="col">ITEM</th>
                            <th scope="col">COMPETENCIA</th>
                            <th scope="col">CAPACIDAD</th>
                            <th scope="col">DESEMPEÑO</th>
                            <th scope="col">CONOCIMIENTO</th>
                            <th scope="col">NIVEL</th>
                            <th scope="col">CLAVE</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <?php
                    $matrisr = $asistencia->matrisnuevo($seleeva, $cursoe, $gradoe, $nivele);
                    while ($masi = mysqli_fetch_array($matrisr)) {
                        echo "<tr class='tablacontenido'>";
                        if($masi['estado'] == '1')
                        {
                            echo "<td style='background-color: red;  color: #ffffff;'>" . $masi['item'] . "</td>";
                        }else{
                            echo "<td>" . $masi['item'] . "</td>";
                        }
                        echo "<td>" . $masi['competencia'] . "</td>";
                        echo "<td>" . $masi['capacidad'] . "</td>";
                        echo "<td>" . $masi['desempeno'] . "</td>";
                        echo "<td>" . $masi['conocimiento'] . "</td>";
                        echo "<td>" . $masi['nivelp'] . "</td>";
                        echo "<td>" . $masi['clave'] . "</td>";
                        echo "<td><button type='button' title='Editar' class='btn btn-outline-primary btn-sm editarmatri'  data-target='#editarmatri' id='" . $masi['idmatriz']  . "' competencia='" . $masi['competencia'] . "'  capacidad='" . $masi['capacidad']  . "' desempeno='" . $masi['desempeno']  . "' conocimiento='" . $masi['conocimiento']  . "' nivelp='" . $masi['nivelp']  . "' clave='" . $masi['clave']  . "' >
                            <i class='fas fa-edit'></i></button>
                <button type='button' title='Anular' class='btn btn-outline-primary btn-sm editaranular'  data-target='#editaranular' idanu='" . $masi['idmatriz'] . "' ><i class='fas fa-ban'></i></button>
                <button type='button' title='Eliminar' class='btn btn-outline-primary btn-sm editarmatrie'  data-target='#editarmatrie' idelimin='" . $masi['idmatriz'] . "' ><i class='fas fa-eraser'></i></button>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editarmatri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestacolmd">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Matriz</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciacom" id="formulario-asistenciacom" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">COMPETENCIA:</label>
                                <input type="hidden" class="form-control" id="idm" name="idm">
                                <input type="text" class="form-control" id="competen" name="competen">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">CAPACIDAD:</label>
                                <input type="text" class="form-control" id="capacoidad" name="capacoidad">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">DESEMPEÑO:</label>
                                <input type="text" class="form-control" id="desempa" name="desempa">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">CONOCIMIENTO:</label>
                                <input type="text" class="form-control" id="conocime" name="conocime">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NIVEL:</label>
                                        <input type="text" class="form-control" id="nvele" name="nvele">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">CLAVE:</label>
                                        <input type="text" class="form-control" id="claves" name="claves">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" onclick="actualizar_matriz()">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   
        <!-- Modal -->
        <div class="modal fade" id="editarmatrie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestacolmde">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciacomeli" id="formulario-asistenciacomeli" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Se eliminara el regtistro...</label>
                                <input type="text" class="form-control" id="idelimine" name="idelimine">
                               
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" onclick="eliminar_matriz()">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editaranular" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestacolmdanu">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Anular Pregunta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciacomanu" id="formulario-asistenciacomanu" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ANULAR PREGUNTA:</label>
                                <input type="hidden" class="form-control" id="idelimineanu" name="idelimineanu">
                               
                            <SELEct class="form-control"  name="anular">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </SELEct>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-primary" onclick="actualizar_matrizanular()">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(".editarmatri").click(function() {
                $('#editarmatri').modal('show');
                var id = $(this).attr('id');
                var competencia = $(this).attr('competencia');
                var capacidad = $(this).attr('capacidad');
                var desempeno = $(this).attr('desempeno');
                var conocimiento = $(this).attr('conocimiento');
                var nivelp = $(this).attr('nivelp');
                var clave = $(this).attr('clave');
                $('#idm').val(id);
                $('#competen').val(competencia);
                $('#capacoidad').val(capacidad);
                $('#desempa').val(desempeno);
                $('#conocime').val(conocimiento);
                $('#nvele').val(nivelp);
                $('#claves').val(clave);
            });
            $(".editarmatrie").click(function() {
                $('#editarmatrie').modal('show');
                var idelimin = $(this).attr('idelimin');
                $('#idelimine').val(idelimin);
            });
            $(".editaranular").click(function() {
                $('#editaranular').modal('show');
                var idanu = $(this).attr('idanu');
                $('#idelimineanu').val(idanu);
            });
            function actualizar_matriz() {
                var parametros = new FormData($("#formulario-asistenciacom")[0]);
                $.ajax({
                        type: "POST",
                        url: "RAmatriz.php",
                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestacolmd").html(data);
                    })
                    .fail(function(data) {
                        alert("error");
                    })
                    .always(function() {});
            }
            function eliminar_matriz() {
                var parametros = new FormData($("#formulario-asistenciacomeli")[0]);
                $.ajax({
                        type: "POST",
                        url: "RAmatrizeliminar.php",
                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestacolmde").html(data);
                    })
                    .fail(function(data) {
                        alert("error");
                    })
                    .always(function() {});
            }
            function actualizar_matrizanular() {
                var parametros = new FormData($("#formulario-asistenciacomanu")[0]);
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