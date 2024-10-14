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
 

        $ugele = $_POST['ugele'];



        ?>


        <div class="card">
            <h6 class="card-header">.:: DISTRITOS</h6>
            <div class="card-body respuestagp">
                <table id="course_table" class="table table-striped" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DISTRITO</th>
                            <th scope="col">OPCIONES</th>

                        </tr>
                    </thead>
                    <?php

                    $contsr = 0;

                    $mar = $asistencia->infodistrito($ugele);

                    while ($masirzd = mysqli_fetch_array($mar)) {
                        $contsr = $contsr + 1;
                        echo "<tr>";
                        echo "<td>" . $contsr . "</td>";
                        echo "<td>" . $masirzd['distrito'] . "</td>";
                        echo "<td><button type='button' title='Eliminar' class='btn btn-outline-danger btn-sm eliminar'  data-target='#eliminarm' dnieli='" . $masirzd['id'] . "'>
                        <i class='far fa-trash-alt'></i></button></td>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    ?>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="eliminarm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content respuestaeli">
                    <div class="modal-header modeldi">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                
                                <input type="hidden" class="form-control" id="dnieli" name="dnieli" readonly>
                            </div>
                            <center>
                            <h5>Esta seguro que desea eliminar</h5><br>
                            <i class="fas fa-trash-alt fa-5x "></i>
                            </center>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-danger" onclick="actualizar_asistenciaeliminar()">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            $(".eliminar").click(function() {
                $('#eliminarm').modal('show');
                var dnieli = $(this).attr('dnieli');
                var nombreseli = $(this).attr('nombreseli');
                var apellidoseli = $(this).attr('apellidoseli');
                $('#dnieli').val(dnieli);
                $('#nombreseli').val(nombreseli);
                $('#apellidoseli').val(apellidoseli);
            });

            function actualizar_asistenciaeliminar() {
                var parametros = new FormData($("#formulario-asistenciaeli")[0]);
                $.ajax({
                        type: "POST",
                        url: "RAasistenciaeliminardistrito.php",

                        data: parametros,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(data) {
                        $(".respuestaeli").html(data);
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