<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/csspdf.css">
    <title>Document</title>
    <style>


.normal { width: 100%;
font-size: 12px;
align-content: center;
  border: 1px solid #000;
  border-collapse: collapse;
}
.normal th, .normal td {
    border: 1px solid #000;
}

.encabezado{ background-color: #c7c7c7;}
.contenidoc{ text-align:center;}

.letra {font-size: 14px; font-weight: 900;}


    </style>

</head>

<body>
    <?php
  


    $cursodes = $asistencia->iesareasdes($curso);
    while ($mascu = mysqli_fetch_array($cursodes)) {
        $descurso = $mascu['descripcionarea'];
    }

    $cursodesf = $asistencia->descripcionealuacion($evaluacion);
    while ($mascuf = mysqli_fetch_array($cursodesf)) {
        $descursof = $mascuf['descripcion'];
    }





    ?>


<table class="normal contenidoc">
<tr>
<td class="encabezado letra">EVALUACIÓN:</td><td class="letra"><?php echo strtoupper($descursof);?></td>
<td class="encabezado letra">ÁREA:</td><td class="letra"><?php echo strtoupper($descurso);?></td>
<td class="encabezado letra">NIVEL</td><td class="letra"><?php echo strtoupper($nivel);?></td>
<td class="encabezado letra">GRADO:</td><td class="letra"><?php echo strtoupper($grado);?></td>
</tr>
</table>
<BR>
    <table class="normal">
        <thead class="encabezado">
            <tr>
                <th>ITEM</th>
                <th>COMPETENCIA</th>
                <th>CAPACIDAD</th>
                <th>DESEMPEÑO</th>
                <th>CONOCIMIENTO</th>
                <th>NIVEL</th>
                <th>CLAVE</th>
            </tr>
        </thead>
        <?php
        $matrisr = $asistencia->matrisnuevo($evaluacion, $curso, $grado, $nivel);
        while ($masi = mysqli_fetch_array($matrisr)) {
            echo "<tr class='contenidoc'>";
            if ($masi['estado'] == '1') {
                echo "<td style='background-color: red;  color: #ffffff;'>" . $masi['item'] . "</td>";
            } else {
                echo "<td>" . $masi['item'] . "</td>";
            }
            echo "<td>" . $masi['competencia'] . "</td>";
            echo "<td>" . $masi['capacidad'] . "</td>";
            echo "<td>" . $masi['desempeno'] . "</td>";
            echo "<td>" . $masi['conocimiento'] . "</td>";
            echo "<td>" . $masi['nivelp'] . "</td>";
            echo "<td>" . $masi['clave'] . "</td>";
            echo "</tr>";
        }

$datoss=array_sum($masi['nivelp']);
        ?>
    </table>
<?php

echo $datoss;

?>

</body>

</html>