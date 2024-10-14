<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once "cAdmision.php";
    $claseAulaV = new cAdmision;
    $dnies = $_POST['dniesf'];
    $perfilusu = $_POST['perfilusu'];
    $iddetalle = $_POST['iddetalle'];
    $revisarie = $_POST['revisarie'];
    $Evaluacionusu = '2024';
    $periodo = '2022';
    $listadot = $claseAulaV->verestado($dnies);
    while ($lise = mysqli_fetch_array($listadot)) {
        $estadow = $lise[0];
    }

    if ($estadow == 0) {
        if ($claseAulaV->guardarperfil($dnies, $dnies, $perfilusu, $periodo, '1', $Evaluacionusu) == true) {
            echo "<div class='alert alert-primary' role='alert'>
		<i class='fas fa-check'></i> La operación se a realizado con Éxito
	  </div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
			<i class='fas fa-times'></i> Error
	  </div>";
        }
    } else {
        $listadote = $claseAulaV->verestadorol($dnies);
        while ($lisee = mysqli_fetch_array($listadote)) {
            $idmodi = $lisee['iddetalleus'] . "<br>";
        }

        echo $idmodi;

        $listadoteq = $claseAulaV->contardetalle($iddetalle);
        while ($liseews = mysqli_fetch_array($listadoteq)) {
            $idmodit = $liseews[0];
        }

        echo $perfilusu . "<br>";
        echo $Evaluacionusu . "<br>";


        if ($idmodit == 0) {
            if ($claseAulaV->actualizarrolr($idmodi, $perfilusu, $Evaluacionusu, '1') == true) {
                echo "<div class='alert alert-primary' role='alert'>
			<i class='fas fa-check'></i> La operación se a realizado con Éxito
		  </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>
				<i class='fas fa-times'></i> Error
		  </div>";
            }
        } else {

            echo "<div class='alert alert-danger' role='alert'>
			<i class='fas fa-times'></i> Debe Eliminar los Registros Creados....
	  </div>";
        }
    }




    ?>



</body>

</html>