<?php session_start();
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
        require_once "cAdmision.php";
        $claseAulaV = new cAdmision;
        sleep(1);
        $evaluprobar = trim($_POST['evaluacion']);
        $nombre = explode("-", $evaluprobar);
        $evanuevodes = $_POST['evanuevodes'];
        error_reporting(0);
        // -----------------------------------Hora y Fecha-------------------
        setlocale(LC_ALL, 'es_PE');
        // Setea el huso horario del servidor...
        date_default_timezone_set('America/Caracas');
        // Imprime la fecha, hora y huso horario.
        date_default_timezone_set("America/Lima");
        $horaas = date("H:i:s");
        $horaenviar = date("His");
        $diapublicacion = date("Y-m-d");
        $diaenviar = date("Ymd");
        $evaluacionnew = $nombre[0] . $nombre[1] . $horaenviar . $diaenviar;
        // -----------------------------------Fin Hora y Fecha-------------------
        if ($claseAulaV->aperturaevaluacion($evaluprobar, $evanuevodes, $diapublicacion, $evaluacionnew, "0", "0") == true) {
            if ($claseAulaV->creartabla($evaluacionnew) == true) {
                echo "<i class='fas fa-check'></i> Proceso de Validación<br>";
            } else {
                echo "<i class='fas fa-times'></i> Proceso de Validación<br>";
            }
            echo "<i class='fas fa-check'></i> La evaluación ha sido creada<br>";
        } else {
            echo "Error de grabacion";
        }
        ?>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
?>