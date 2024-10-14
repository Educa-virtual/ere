<?php session_start();
if ($_SESSION["dni"] != '') {
?>

    <!-- NO SE USARA
    TAREA 1 -> AL MOMENTO DE EVALUACION -> CREAR EVALUACION, LO QUE QUIERO ES QUE ESO AL MOMENTO DE CRERARSE SE VAYA A LA BASE DE DATOS LLAMADA HISTORIAL_ERE
    TAREA 2 -> AL MOMENTO DE IR A LA INTERFAZ DE PPARTICION_IE, SE ME DEBE AGREGAR UN BOTON Y UN SELECTOR PARA PODER SELECCIONAR LO QUE SE ENCUENTRA EN LA TABLA HISTORIAL_ERE, LA PARTE DE EVALUACION
    TAREA 3 -> AL MOMENTO DE SELECCIONAR LOS CHECKBOX SE MANDE A LA BASE DE DATOS DE IE_EXAMEN
    DE ACUERDO AL HISTORIAL_ERE, HAY DOS TAREAS, UNA DE ELLAS ES QUE SE DEBE CREAR OTRO HISTORIAL_ERE Y SE TENGA UN ID=2, AHORA ESO SE DEBE ESCOGER DESDE LA INTERFAZ PPARTICION_E 
    AHORA EN EVALUACION HAY UNA TABLA LLAMADA "TABLA" ESO MANDARLO A LA TABLA HISTORIAL_ERE Y A EVALUACION
    30092024

    EN LA PARTE DE EVALUACION MANDAR LAS COLUMNAS DE DESCRIPCION AL HISTORIAL_ERE EN LA CUAL UNA SOLUCION ES CREAR UNA NUEVA COLUMNA DONDE SE ALMACENE LA DESCRIPCION DE EVALUACION
    EN LA INTERFAZ DE PARTICIPACION TENER UN BOTON QUE PUEDA ESCOGER CUAL HISTORIAL_ERE, SERIA
    
    1102024
    EN LA PARTE DE LAS DOS COLUMNAS LO QUE SE NECESITA ES QUE AL MOMENTO DE DARLE AL BOTON BORRE DE LA TABLA 1 Y LO PASE A LA 2 Y QUE AL MOMENTO DE DARLE A GUARDAR SOLO SE QUEDE SELECCIONADO SOLO LA TABLA 1 Y LA TABLA 2 SERIA LO QUE NO SRIVE
    
    SQL
    ahora tengo 2 tablas una llamada evaluacion que contiene id, descripcion, comentario, fecha, tabla, estado, visible, y la otra tabla llamada historial_ere que contiene, id, evaluacion, drive, plantilla, manual, respuestas, desceva, lo que quiero ahora es que la tabla evaluacion me mande la informacion de la descripcion a la tabla historial_ere a desceva y que cada que yo almacene un dato nuevo en evaluacion que la parte de descripcion mande el dato nuevo a historial_ere a la parte de desceva, lo harias en sql
    
    DELIMITER //
CREATE TRIGGER eval_hist_ere
AFTER INSERT ON evaluacion
FOR EACH ROW
BEGIN
    INSERT INTO historial_ere (evaluacion, desceva)
    VALUES (NEW.id, NEW.descripcion);
END;
//

DELIMITER ;
    -->


    <?php
    // require_once "cAdmision.php";
    // $asistencia = new cAdmision;
    require_once "./../../modelo/Ie.php";
    $ie = new Ie;

    $nivel = $_POST['nivele'];
    $ugel = $_POST['ugele'];
    $evaluacion = $_POST['evaluacion'];
    $data = $ie->getIesParticipan($nivel, $ugel, $evaluacion);
    var_dump($data);
    exit;
    ?>

    <div class="container d-flex justify-content-start align-items-start" style="height: 165vh; margin-top:20px;">
        <div class="card me-4" style="width: 1500px; max-width: 1800px; margin-left:-70px; margin-right:20px;">
            <h6 class="card-header">.:: I.E.</h6>
            <div class="card-body">
                <table class="table table-striped" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>#</th>
                            <th>CODIGO MODULAR</th>
                            <th>DESCRIPCION</th>
                            <th>DISTRITO</th>
                            <th>NIVEL</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <?php
                        // Código para obtener datos basados en $nivele y $ugele
                        $contsr = 0;
                        $matrisrr = $asistencia->matrisiesp($nivele, $ugele);
                        while ($masir = mysqli_fetch_array($matrisrr)) {
                            $contsr++;
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='select-row' data-codmodular='" . htmlspecialchars($masir['codmodular']) . "'></td>";
                            echo "<td>" . $contsr . "</td>"; //1
                            echo "<td>" . $masir['codmodular'] . "</td>"; //2
                            echo "<td>" . $masir['descripcion'] . "</td>"; //3
                            echo "<td>" . $masir['distrito'] . "</td>"; //4
                            echo "<td>" . $masir['nivel'] . "</td>"; //5

                            echo "<td>" . $masir['historial_id'] . "</td>"; //6
                            //echo "<td>" . $masir['cod_modular'] . "</td>"; //7
                            // echo "<td>" . $masir['examen'] . "</td>";
                            // echo "<td>" . $masir['examen1'] . "</td>";
                            // echo "<td>" . $masir['examen2'] . "</td>";
                            //echo "<td>" . $masir['detalle_id'] . "</td>"; //8
                            // echo "<td>" . $masir['validacion'] . "</td>";
                            // echo "<td>" . $masir['validacion1'] . "</td>";
                            // echo "<td>" . $masir['obs'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
                <center>
                    <button class="btn btn-primary" type="button" onclick="almacenarDatos()">
                        <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                        Almacenar
                    </button>

                </center>
            </div>
        </div>
        <button class="btn btn-primary btn-sm" style="height: 40px; margin-top: 50%;" type="button" onclick="copiarDatos()">
            <span class="fw-bold">>></span>
        </button>
        <div class="card" style="width: 1200px; max-width: 600px; margin-left:20px;">
            <h6 class="card-header">Datos Copiados</h6>
            <div class="card-body">
                <table class="table table-striped" id="tablaCopiados" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODIGO MODULAR</th>
                            <th>DESCRIPCION</th>
                            <th>DISTRITO</th>
                            <th>NIVEL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se agregarán los datos copiados -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- <div id="resultaintP"></div> -->
    <br>
    <script>
        function almacenarDatos() {
            const selectedRows = [];
            $('.select-row:checked').each(function() {


                const row = $(this).closest('tr');
                const historial_id = row.find('td:eq(6)').text(); // Historial ID
                const cod_modular = $(this).data('codmodular');
                const examen = row.find('td:eq(8)').text(); // Examen
                const examen1 = row.find('td:eq(9)').text(); // Examen 1
                const examen2 = row.find('td:eq(10)').text(); // Examen 2
                const detalle_id = row.find('td:eq(11)').text(); // Detalle ID
                const validacion = row.find('td:eq(12)').text(); // Validación
                const validacion1 = row.find('td:eq(13)').text(); // Validación 1
                const obs = row.find('td:eq(14)').text(); // Observaciones
                const nivel = row.find('td:eq(5)').text();


                selectedRows.push({
                    historial_id: historial_id,
                    cod_modular: cod_modular,
                    examen: examen,
                    examen1: examen1,
                    examen2: examen2,
                    detalle_id: detalle_id,
                    validacion: validacion,
                    validacion1: validacion1,
                    obs: obs,
                    nivel: nivel
                    //nivel:nivel     // Primaria- Secundaria
                });
            });

            if (selectedRows.length === 0) {
                alert("Por favor, selecciona al menos una fila.");
                return;
            }

            const formData = new FormData();
            formData.append('data', JSON.stringify(selectedRows)); // Convertimos el array a JSON

            $.ajax({
                    type: "POST",
                    url: "views/informes/rParticipacionie.php", // Cambia esto según tu estructura
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.spinner-border').removeClass("cargar"); // Oculta el spinner antes de enviar
                    }
                })
                // .done(function(response) {
                //     alert("Datos almacenados: " + response);
                // })
                .done(function(response) {
                    console.log("Respuesta del servidor:", response); // Agregado para depuración
                    alert("Datos almacenados: " + response);
                })
                .fail(function(xhr, status, error) {
                    alert("Error al almacenar los datos PRoblema en resutladosinformaiconP: " + error);
                })
                .always(function() {
                    $('.spinner-border').addClass("cargar"); // Muestra el spinner después de la operación
                });
        }

        function copiarDatos() {
            const selectedRows = [];
            $('.select-row:checked').each(function() {
                const row = $(this).closest('tr');
                const cod_modular = $(this).data('codmodular');
                const descripcion = row.find('td:eq(3)').text();
                const distrito = row.find('td:eq(4)').text();
                const nivel = row.find('td:eq(5)').text();

                selectedRows.push({
                    cod_modular: cod_modular,
                    descripcion: descripcion,
                    distrito: distrito,
                    nivel: nivel
                });
            });

            const tbody = $('#tablaCopiados tbody');
            tbody.empty(); // Limpiar tabla anterior

            selectedRows.forEach((data, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${data.cod_modular}</td>
                        <td>${data.descripcion}</td>
                        <td>${data.distrito}</td>
                        <td>${data.nivel}</td>
                    </tr>
                `);
            });

            if (selectedRows.length === 0) {
                alert("No hay filas seleccionadas para copiar.");
            }
        }
    </script>

<?php
} else {
    header("location:index.php");
}
?>