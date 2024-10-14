<?php
session_start();

if ($_SESSION["dni"] != '') {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php
        require_once "../../cAdmision.php";
        $claseAulaV = new cAdmision;
        sleep(0.5);
        // Recibimos el JSON de datos
        $data = json_decode($_POST['data'], true);
        //PRUEBA 1 INSERTAR DATOS POR PRIMARIA O SECUNDARIA
        if (isset($_POST['data'])) {
            $data = json_decode($_POST['data'], true); // Convertir el JSON a un array asociativo

            if (is_array($data) && !empty($data)) {
                $errores = [];
                foreach ($data as $d) {
                    $nivel = strtoupper($d['nivel']);
                    $evaluacion = $d['historial_id']; // Asegúrate de que esto esté presente en $d
                    $detalle_id = ($nivel == 'PRIMARIA') ? '1' : '2'; // Establecer detalle_id basado en el nivel
                    // Establecer los rangos según el nivel
                    if ($nivel == 'PRIMARIA') {
                        $inicio = 1;
                        $fin = 7;
                    } else {
                        $inicio = 8;
                        $fin = 15;
                    }

                    for ($i = $inicio; $i <= $fin; $i++) {
                        // Insertar los registros en ie_examenes
                        if (!$claseAulaV->participacionie($historial_id, $d['cod_modular'], $detalle_id, $i)) {
                            $errores[] = "Error al almacenar los datos de codmodular: {$d['cod_modular']}";
                        }
                    }
                }

                if (!empty($errores)) {
                    echo "<div class='alert alert-danger' role='alert'>" . implode("<br>", $errores) . "</div>";
                } else {
                    echo "<div class='alert alert-primary' role='alert'>Datos almacenados correctamente...</div>";
                }
            } else {
                echo "<div class='alert alert-warning' role='alert'>No se recibieron datos válidos.</div>";
            }
        }
        ?>
        // if (is_array($data) && !empty($data)) {
        // $errores = [];
        // foreach ($data as $d) {
        // $nivel = strtoupper($d['nivel']);
        // if ($nivel == 'PRIMARIA') {
        // $inicio = 1;
        // $fin = 7;
        // } else {
        // $inicio = 8;
        // $fin = 15;
        // }

        // // for ($i = $inicio; $i <= $fin; $i++) {
            // // // Insertar los registros en ie_examenes
            // // if (!$claseAulaV->participacionie($d['historial_id'], $d['cod_modular'], $d['examen'], $d['examen1'], $d['examen2'], $i, $d['validacion'], $d['validacion1'], $d['obs'])) {
            // // $errores[] = "Error al almacenar los datos de codmodular: {$d['cod_modular']}";
            // // }
            // // }
            // for ($i = $inicio; $i <= $fin; $i++) {
                // // Insertar los registros en ie_examenes
                // if (!$claseAulaV->participacionie($d['cod_modular'], $i)) {
                // $errores[] = "Error al almacenar los datos de codmodular: {$d['cod_modular']}";
                // }
                // }
                // }

                // if (!empty($errores)) {
                // echo "<div class='alert alert-danger' role='alert'>" . implode("<br>", $errores) . "</div>";
                // } else {
                // echo "<div class='alert alert-primary' role='alert'>Datos almacenados correctamente...</div>";
                // }
                // } else {
                // echo "<div class='alert alert-warning' role='alert'>No se recibieron datos válidos.</div>";
                // }
                // ?>
                <script>
                    $("#salir").click(function() {
                        // Actualizamos la página
                        location.reload();
                    });
                </script>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
?>