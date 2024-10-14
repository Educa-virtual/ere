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



        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;

        sleep(1);
        $seleeva = $_POST['seleeva'];


        $nomh = $asistencia->desevaluacion($seleeva);
        while ($masih = mysqli_fetch_array($nomh)) {
        $descrinombreeva=$masih['descripcion'];
        }


        ?>



        <div class="card respuestagpr">
            <h6 class="card-header">.:: LISTADO CUADERNILLO | <?php echo $descrinombreeva;?></h6>
            <div class="card-body ">
                <table class="table table-sm table-bordered  table-striped table-hover ">
                    <thead class="tablatitulo ">
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Area</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Opciones</th>
                            <th scope="col">Ver Cuadernillo</th>
                        </tr>
                    </thead>
                    <?php
                    $cons = 0;
                    $matrisr = $asistencia->listadocuadernillo($seleeva);
                    while ($masi = mysqli_fetch_array($matrisr)) {

                        $cons = $cons + 1;
                        echo "<tr class='tablacontenido'>";

                        echo "<td>" . $cons . "</td>";


                        $matrisrare = $asistencia->matrisnuevoarea($masi['area']);
                        while ($masiare = mysqli_fetch_array($matrisrare)) {
                            echo "<td>" . $masiare['descripcionarea'] . "</td>";
                        }
                        echo "<td>" . $masi['nivel'] . "</td>";
                        echo "<td>" . $masi['grado'] . "</td>";

                        $contp = $asistencia->contarprerguntascuadr($masi['idnuevaevaluacion']);
                        while ($contpp = mysqli_fetch_array($contp)) {
                            echo "<td>" . $contpp[0] . "</td>";
                        }

                        echo "<td><button type='button' class='btn btn-secondary btn-sm enviarpreguntas' idevaluacionn='" . $masi['idnuevaevaluacion'] . "'>Crear Preguntas</button></td>";
                        echo "<td><button type='button' class='btn btn-secondary btn-sm verpreguntas' idevaluacionnv='" . $masi['idnuevaevaluacion'] . "'>Ver Cuadernillo</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <script>
            $(".enviarpreguntas").click(function() {
                var dnicf = $(this).attr('idevaluacionn');
                var data = 'dnicf=' + dnicf;
                $.ajax({
                    type: "POST",
                    url: "crearpreguntas.php",
                    data: data,
                    success: function(data) {

                        $('.respuestagpr').html(data);

                    }
                })

            })


            $(".verpreguntas").click(function() {
                var dnicf = $(this).attr('idevaluacionnv');
                var data = 'dnicf=' + dnicf;
                $.ajax({
                    type: "POST",
                    url: "vercuadernillose.php",
                    data: data,
                    success: function(data) {

                        $('.respuestagpr').html(data);

                    }
                })

            })


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