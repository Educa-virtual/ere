<?php
require_once './../../modelo/Ie.php';

$ie = new Ie();

// Verificar que los datos se han enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    $cod_modular = isset($_POST['cod_modular']) ? $_POST['cod_modular'] : null;

    // Verificar que el cod_modular está presente
    if ($cod_modular) {
        // Llamar al método para eliminar el registro
        if ($ie->eliminarExamen($cod_modular)) {
            echo "Datos eliminados correctamente.";
        } else {
            echo "Error al eliminar los datos.";
        }
    } else {
        echo "Falta el cod_modular requerido.";
    }
} else {
    echo "Método de solicitud incorrecto.";
}
