<?php
// Dirección o IP del servidor MySQL
$host = "localhost";

// Puerto del servidor MySQL
$puerto = "3306";

// Nombre de usuario del servidor MySQL
// $usuario = "dremoque_ere_user";
$usuario = "root";

// Contraseña del usuario
//$contrasena = "Leono19721221";
$contrasena = "";

// Nombre de la base de datos
// $baseDeDatos = "dremoque_ere5";
$baseDeDatos = "ere";

class DBManager
{

    public function Conectarse()
    {
        global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;

        if (!($link = mysqli_connect($host, $usuario, $contrasena))) {
            echo "Error conectando a la base de datos.<br>";
            exit();
        }

        if (!mysqli_select_db($link, $baseDeDatos)) {
            echo "Error seleccionando la base de datos.<br>";
            exit();
        }
        mysqli_set_charset($link, "utf8");
        return $link;
    }
}
