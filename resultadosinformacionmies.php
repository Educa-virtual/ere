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
        <link rel='stylesheet' href='css/stylep.css'>
        <style>
            .carga {
                display: none;
            }
        </style>
    </head>

    <body>
        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
        $nivele = $_POST['nivele'];
        $ugele = $_POST['ugele'];
        ?>
        <div class="card">
            <h6 class="card-header">.:: I.E.</h6>
            <div class="card-body respuestagp">
                <table id="course_table" class="table table-striped" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CODIGO MODULAR</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">DISTRITO</th>
                            <th scope="col">NIVEL</th>
                        </tr>
                    </thead>
                    <?php
                    $contsr = 0;
                    $matrisrr = $asistencia->matrisies($nivele, $ugele);
                    while ($masir = mysqli_fetch_array($matrisrr)) {
                        $contsr = $contsr + 1;
                        echo "<tr>";
                        echo "<td>" . $contsr . "</td>";
                        echo "<td>" . $masir['codmodular'] . "</td>";
                        echo "<td>" . $masir['descripcion'] . "</td>";
                        echo "<td>" . $masir['distrito'] . "</td>";
                        echo "<td>" . $masir['nivel'] . "</td>";
                        echo "<td>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <br>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
?>