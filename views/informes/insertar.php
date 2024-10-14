<?php
require_once './../../modelo/Ie.php';

$ie = new Ie();

// Verificar que los datos se han enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : null;
    $cod_modular = isset($_POST['cod_modular']) ? $_POST['cod_modular'] : null;
    $evaluacion = isset($_POST['evaluacion']) ? $_POST['evaluacion'] : null;

    // Verificar que todos los datos están presentes
    if ($nivel && $cod_modular && $evaluacion) {
        // Insertar los datos en la tabla ie_examen
        if ($ie->insertarExamen($nivel, $cod_modular, $evaluacion)) {
            echo "Datos almacenados correctamentes.";
        } else {
            echo "Error al almacenar los datos.";
        }
    } else {
        echo "Faltan datos requeridos.";
    }
} else {
    echo "Método de solicitud incorrecto.";
}
