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
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css'>
        <link rel='stylesheet' href='css/stylep.css'>
        <link rel="stylesheet" href="css/disenooptimizado.css">

    </head>

    <body>
        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;

        ?>
        <br>
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <h6 class="card-header">.:: <i class="fas fa-binoculars"></i> VISTA DE EVALUACIONES</h6>
                <div class="card-body respuestagp">
                    <div class="form-row">
                        <div class="form-group col-md-12">

                            <table class="table table-sm table-bordered  table-striped table-hover ">
                                <thead class="tablatitulo">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">DESCRIPCION</th>
                                        <th scope="col">FECHA DE CREACIÓN</th>
                                        <th scope="col">DATOS</th>
                                        <th scope="col">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="tablacontenido">
                                    <?PHP
                                    $evcon = 0;
                                    $evacomple = $asistencia->datacompleta('evaluacion');
                                    while ($asiv = mysqli_fetch_array($evacomple)) {
                                        $evcon = $evcon + 1;
                                        echo "<tr id='row" . $asiv['id'] . "'>";
                                        echo "<th>" . $evcon . "</th>";
                                        echo "<td data-target='nomnbre'>" . $asiv['descripcion'] . "</td>";
                                        echo "<td data-target='comentario'>" . $asiv['comentario'] . "</td>";
                               
                                        
                                        echo "<td>" . $asiv['fecha'] . "</td>";

                                  
                                        
                                        $evacomplec = $asistencia->datacompletatotal($asiv['tabla']);
                                        while ($asivc = mysqli_fetch_array($evacomplec)) {
                                            $totaluser = $asivc[0];
                                        }
                                        echo "<td>" . $totaluser . "</td>";

                                        if ($asiv['estado'] == 1) {
                                            $iconoev = "<i class='fas fa-lock-open blue'></i>";
                                        } else {
                                            $iconoev = "<i class='fas fa-lock rojo'></i>";
                                        }
                                        if ($asiv['visible'] == 1) {
                                            $iconoe = "<i class='far fa-eye blue'></i>";
                                        } else {
                                            $iconoe = "<i class='far fa-eye-slash rojo'></i>";
                                        }

                                        echo "<td>
                                        <button type='button' title='Visible' class='btn btn-light-danger btn-sm visible'  dnieliv='" . $asiv['id'] . "' nombreseliv='" . $asiv['descripcion']  . "'>
                                        " . $iconoe . "</button>
                                        <button type='button' title='Cerrar' class='btn btn-light-danger btn-sm estadoc'   dnielie='" . $asiv['id'] . "' nombreselie='" . $asiv['descripcion']  . "'>
                                        " . $iconoev . "</button>

                                        <button type='button' title='Editar' class='btn btn-light-danger btn-sm editar'   idedit='" . $asiv['id'] . "' nomedi='" . $asiv['descripcion']  . "' comenedit='" . $asiv['comentario']  . "'>
                                        <i class='fas fa-edit'></i></button>

                                        <button type='button' title='Eliminar' class='btn btn-light-danger btn-sm eliminarnew'   dnieli='" . $asiv['id'] . "' nombreseli='" . $asiv['descripcion']  . "'>
                                        <i class='fas fa-trash-alt'>Eliminar</i></button>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal visible -->
        <div class="modal fade" id="visiblem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestaelivi">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Visible</h5>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="dnieliv" name="dnieliv" readonly>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre Evaluación:</label>
                            <input type="text" class="form-control" id="nombreseliv" readonly>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vis" id="inlineRadio1" value="1">
                            <label class="form-check-label font-weight-bold" for="inlineRadio1">Visible</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vis" id="inlineRadio2" value="0" checked>
                            <label class="form-check-label font-weight-bold" for="inlineRadio2">No Visible</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-danger " id="visible">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Estado -->
        <div class="modal fade" id="estadocv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestaelivih">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Estado</h5>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" class="form-control" id="dnielie" name="dnielie" readonly>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre Evaluación:</label>
                            <input type="text" class="form-control" id="nombreselie" readonly><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vise" id="inlineRadio1" value="1">
                            <label class="form-check-label font-weight-bold" for="inlineRadio1">Abierto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vise" id="inlineRadio2" value="0" checked>
                            <label class="form-check-label font-weight-bold" for="inlineRadio2">Cerrado</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-danger " id="cerrare">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Actualizar-->
        <div class="modal fade" id="editanombre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestaelivihest">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" class="form-control" id="dnielieditar" name="dnielieditar">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nuevo Nombre Evaluación:</label>
                            <input type="text" class="form-control" id="nuevonombree"><br>
                            <label for="exampleInputEmail1">Comentario:</label>
                            <input type="text" class="form-control" id="nuevocomentario"><br>
                        </div>
                        <div id="respuesta"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button class="btn btn-danger" type="button" id="actuctualizarcampos">
                            <span class="spinner-grow spinner-grow-sm carga" role="status" aria-hidden="true"></span>
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="eliminarm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestaeli">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    </div>
                    <form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                                <input type="hidden" class="form-control" id="dnielis" name="dnielis" readonly>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre Evaluación:</label>
                                <input type="text" class="form-control" id="nombreseli" readonly><br>
                                <center><i class="fas fa-trash-alt fa-7x"></i></center>
                            </div>
                        </div>
<div id="respuestaeliminar"></div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-danger eliminarnews" >Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(".visible").click(function() {
                $('#visiblem').modal('show');
                var dnieliv = $(this).attr('dnieliv');
                var nombreseliv = $(this).attr('nombreseliv');
                $('#dnieliv').val(dnieliv);
                $('#nombreseliv').val(nombreseliv);
            });


            $('#visible').click(function() {
                var dnieliv = document.getElementById('dnieliv').value;
                var vis = $('input:radio[name=vis]:checked').val();
                var ruta = "dnieliv=" + dnieliv + "&vis=" + vis;
                $.ajax({
                        url: 'Rvisible.php',
                        type: 'POST',
                        data: ruta,
                        dataType: 'html',
                        beforeSend: function() {
                            $('.spinner-border').removeClass("carga");
                        }
                    })
                    .done(function(res) {
                        $('.respuestaelivi').html(res);
                        $('.spinner-border').addClass("carga");
                    })
            });



            $(".estadoc").click(function() {
                $('#estadocv').modal('show');
                var dnielie = $(this).attr('dnielie');
                var nombreselie = $(this).attr('nombreselie');
                $('#dnielie').val(dnielie);
                $('#nombreselie').val(nombreselie);
            });


            $('#cerrare').click(function() {

                var dnielie = document.getElementById('dnielie').value;
                var vise = $('input:radio[name=vise]:checked').val();
                var ruta = "dnielie=" + dnielie + "&vise=" + vise;
                $.ajax({
                        url: 'Restado.php',
                        type: 'POST',
                        data: ruta,
                        dataType: 'html',
                        beforeSend: function() {
                            $('.spinner-border').removeClass("carga");
                        }
                    })
                    .done(function(res) {
                        $('.respuestaelivih').html(res);
                        $('.spinner-border').addClass("carga");
                    })
            });


            $(".eliminarnew").click(function() {
                $('#eliminarm').modal('show');
                var dnieli = $(this).attr('dnieli');
                var nombreseli = $(this).attr('nombreseli');
                $('#dnielis').val(dnieli);
                $('#nombreseli').val(nombreseli);
            });


          
                $(".eliminarnews").click(function() {
                    var id = $('#dnielis').val();
                    var data = 'id=' + id;

                    $.ajax({
                        type: "POST",
                        url: "eliminareva.php",
                        data: data,
                        success: function(data) {
                            $("#row" + id).hide();
                            $('#respuestaeliminar').html(data);
                            setTimeout(function() {
                            $('#eliminarm').modal('hide');
                        }, 2000);
                        }
                    })
                })

            $(".eliminar").click(function() {
                $('#eliminarm').modal('show');
                var dnieli = $(this).attr('dnieli');
                var nombreseli = $(this).attr('nombreseli');
                $('#dnieli').val(dnieli);
                $('#nombreseli').val(nombreseli);
            });


            $(".editar").click(function() {
                $('#editanombre').modal('show');
                var ideditar = $(this).attr('idedit');
                var nombreselieditar = $(this).attr('nomedi');
                var comentarioelieditar = $(this).attr('comenedit');
                $('#dnielieditar').val(ideditar);
                $('#nuevonombree').val(nombreselieditar);
                $('#nuevocomentario').val(comentarioelieditar);
                $('.spinner-grow').addClass("carga");

            });

            $("#actuctualizarcampos").click(function() {
                var id = $('#dnielieditar').val();
                var nuevonombre = $('#nuevonombree').val();
                var nueocomentario = $('#nuevocomentario').val();
                $('.spinner-grow').removeClass("carga");
                var ruta = "ideditar=" + id + "&nuevonombre=" + nuevonombre + "&nuevocomentario=" + nueocomentario;
                $.ajax({
                    url: 'Restadoeditar.php',
                    type: 'POST',
                    data: ruta,
                    success: function(respuesta) {

                        $('#row' + id).children('td[data-target=nomnbre]').text(nuevonombre);
                        $('#row' + id).children('td[data-target=comentario]').text(nueocomentario);

                        $('#respuesta').html(respuesta);
                        setTimeout(function() {
                            $('#editanombre').modal('hide');
                        }, 2000);
                    }
                })
            })
        </script>
    </body>
    </html>
<?php
} else {

    header("location:index.php");
}

?>