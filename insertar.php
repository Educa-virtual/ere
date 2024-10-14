<?php

/**
 * Created by PhpStorm.
 * User: HILARI
 * Date: 02/01/2020
 * Time: 10:40
 */

require_once "cAdmision.php";
$asistencia = new cAdmision;









define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'erefianlizado16112022');



$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;
try {
	$pdo = new PDO(
		$servidor,
		USUARIO,
		PASSWORD,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
	//echo "<script>alert('Conexión con exito a la base de datos');</script>";
} catch (PDOException $e) {
	echo "<script>alert('error al conectar con la base de datos');</script>";
}

$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$d3 = $_POST['d3'];
$d4 = $_POST['d4'];
$d5 = $_POST['d5'];
$d6 = $_POST['d6'];
$d7 = $_POST['d7'];
$d8 = $_POST['d8'];
$d9 = $_POST['d9'];
$d10 = $_POST['d10'];
$d11 = $_POST['d11'];
$d12 = $_POST['d12'];
$d13 = $_POST['d13'];
$d14 = $_POST['d14'];
$d15 = $_POST['d15'];
$d16 = $_POST['d16'];
$d17 = $_POST['d17'];
$d18 = $_POST['d18'];
$d19 = $_POST['d19'];
$d20 = $_POST['d20'];
$d21 = $_POST['d21'];
$d22 = $_POST['d22'];
$d23 = $_POST['d23'];
$d24 = $_POST['d24'];
$d25 = $_POST['d25'];
$d26 = $_POST['d26'];
$d27 = $_POST['d27'];
$d28 = $_POST['d28'];
$d29 = $_POST['d29'];
$d30 = $_POST['d30'];
$d31 = $_POST['d31'];
$d32 = $_POST['d32'];
$d33 = $_POST['d33'];
$d34 = $_POST['d34'];
$d35 = $_POST['d35'];
$d36 = $_POST['d36'];
$d37 = $_POST['d37'];
$d38 = $_POST['d38'];
$d39 = $_POST['d39'];

//tipo de evaluacion
$d40 = $_POST['d40'];
$d41 = $_POST['d41'];




//tipo de evaluacion

// -----------------------------------Hora y Fecha-------------------
setlocale(LC_ALL, 'es_PE');
// Setea el huso horario del servidor...
date_default_timezone_set('America/Caracas');
// Imprime la fecha, hora y huso horario.
date_default_timezone_set("America/Lima");
$horaas = date('G:i:s');
$diapublicacion = date("Y-m-d");
$dia = date("d-m-Y");

$blanco = '';

// -----------------------------------Fin Hora y Fecha-------------------
$estado = "1";





	$sentencia = $pdo->prepare("INSERT INTO $d40
		  (id,fecha,dni,apellidopaterno,apellidomaterno,primernombre,segundonombre,tercernombre,sexo,ie,codigomodular,nivel,distrito,zona,gestion,seccion,respuestas1,respuestas2,respuestas3,respuestas4,respuestas5,respuestas6,respuestas7,respuestas8,respuestas9,respuestas10,respuestas11,respuestas12,respuestas13,respuestas14,respuestas15,respuestas16,respuestas17,respuestas18,respuestas19,respuestas20,grado,area,ugel) 
	VALUES(:id,:fecha,:dni,:apellidopaterno,:apellidomaterno,:primernombre,:segundonombre,:tercernombre,:sexo,:ie,:codigomodular,:nivel,:distrito,:zona,:gestion,:seccion,:respuestas1,:respuestas2,:respuestas3,:respuestas4,:respuestas5,:respuestas6,:respuestas7,:respuestas8,:respuestas9,:respuestas10,:respuestas11,:respuestas12,:respuestas13,:respuestas14,:respuestas15,:respuestas16,:respuestas17,:respuestas18,:respuestas19,:respuestas20,:grado,:area,:ugel)");
$dato=$d1 +$d41;
$sentencia->bindParam(':id', $dato);
$sentencia->bindParam(':fecha', $diapublicacion);
$sentencia->bindParam(':dni', $d3);
$sentencia->bindParam(':apellidopaterno', $d4);
$sentencia->bindParam(':apellidomaterno', $d5);
$sentencia->bindParam(':primernombre', $d6);

if ($d7 == 'undefined') {

	$sentencia->bindParam(':segundonombre', $blanco);
} else {
	$sentencia->bindParam(':segundonombre', $d7);
}

if ($d8 == 'undefined') {
	$sentencia->bindParam(':tercernombre', $blanco);
} else {
	$sentencia->bindParam(':tercernombre', $d8);
}


$sentencia->bindParam(':sexo', $d9);
$sentencia->bindParam(':ie', $d10);
$sentencia->bindParam(':codigomodular', $d11);
$sentencia->bindParam(':nivel', $d12);
$sentencia->bindParam(':distrito', $d13);
$sentencia->bindParam(':zona', $d14);
$sentencia->bindParam(':gestion', $d15);
$sentencia->bindParam(':seccion', $d16);
$sentencia->bindParam(':respuestas1', $d17);
$sentencia->bindParam(':respuestas2', $d18);
$sentencia->bindParam(':respuestas3', $d19);
$sentencia->bindParam(':respuestas4', $d20);
$sentencia->bindParam(':respuestas5', $d21);
$sentencia->bindParam(':respuestas6', $d22);
$sentencia->bindParam(':respuestas7', $d23);
$sentencia->bindParam(':respuestas8', $d24);
$sentencia->bindParam(':respuestas9', $d25);
$sentencia->bindParam(':respuestas10', $d26);
$sentencia->bindParam(':respuestas11', $d27);
$sentencia->bindParam(':respuestas12', $d28);
$sentencia->bindParam(':respuestas13', $d29);
$sentencia->bindParam(':respuestas14', $d30);
$sentencia->bindParam(':respuestas15', $d31);
$sentencia->bindParam(':respuestas16', $d32);
$sentencia->bindParam(':respuestas17', $d33);
$sentencia->bindParam(':respuestas18', $d34);
$sentencia->bindParam(':respuestas19', $d35);
$sentencia->bindParam(':respuestas20', $d36);
$sentencia->bindParam(':grado', $d37);
$sentencia->bindParam(':area', $d38);
$sentencia->bindParam(':ugel', $d39);
$sentencia->execute();
