<?php session_start();

if ($_SESSION["dni"] != '') {

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
        <script type="text/javascript" src="DataTables/datatables.min.js"></script>
        <link rel="stylesheet" href="css/disenooptimizado.css">

    </head>
    <body>


        <?php

        ini_set('memory_limit', '9024M');

        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        $dni = $_SESSION["dni"];
        $evaluacion = $_POST['evaluacion'];



        ?>




        <div class="card">
            <h6 class="card-header">
                <div class="dropdown">

                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight:bolder ;">
                        .::DATOS
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        

                    </div>
                </div>


            </h6>
            <div class="card-body">
                <table class="table table-sm table-bordered  table-striped table-hover">
                    <thead>
                        <tr class="tablatitulo">
                            <th scope="col">#</th>
                            <th scope="col">Apellidos y Nombre</th>
                            <th scope="col">sexo</th>
                            <th scope="col">I.E.</th>
                            <th scope="col">Cod.</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Distrito</th>
                            <th scope="col">Zona</th>
                            <th scope="col">Gestion</th>
                            <th scope="col">Seccion</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Area</th>
                            <th scope="col">ugel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nro = 0;
                        $asistencia = $asistencia->datacompletanew($evaluacion);
                        while ($asi = mysqli_fetch_array($asistencia)) {
                            $nro = $nro + 1;
                            echo "<tr class='tablacontenido'>";
                            echo "<td>" . $nro . "</td>";
                            echo "<td>" . $asi['apellidopaterno']." ".$asi['apellidomaterno']." ".$asi['primernombre']." ".$asi['segundonombre']  ." ".$asi['tercernombre'] . "</td>";
                            echo "<td>" . $asi['sexo'] . "</td>";
                            echo "<td>" . $asi['ie'] . "</td>";
                            echo "<td>" . $asi['codigomodular'] . "</td>";
                            echo "<td>" . $asi['nivel'] . "</td>";
                            echo "<td>" . $asi['distrito'] . "</td>";
                            echo "<td>" . $asi['zona'] . "</td>";
                            echo "<td>" . $asi['gestion'] . "</td>";
                            echo "<td>" . $asi['seccion'] . "</td>";
                            echo "<td>" . $asi['grado'] . "</td>";
                            echo "<td>" . $asi['area'] . "</td>";
                            echo "<td>" . $asi['ugel'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </body>

    </html>
<?php

} else {
    header("location:index.php");
}
?>