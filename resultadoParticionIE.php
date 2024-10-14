<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el valor de ugele
    $ugele = $_POST['ugele'];

    // Recuperar los checkboxes seleccionados
    $selectedCheckboxes = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];

    // Ejemplo de uso: mostrar los valores
    echo "UGELE: " . htmlspecialchars($ugele) . "<br>";
    echo "Checkboxes seleccionados: <br>";
    foreach ($selectedCheckboxes as $checkbox) {
        echo htmlspecialchars($checkbox) . "<br>";
    }
}
