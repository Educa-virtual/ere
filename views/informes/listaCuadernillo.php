<?php session_start();
if (!isset($_SESSION["dni"]))

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>.::DREMO::.</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
    <link rel="stylesheet" href="css/disenooptimizado.css">
    <!-- es la parte de las tablas. -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="loader"></div>
    <?php
require_once "./../../cAdmision.php";
$asistencia = new cAdmision;
$dni = $_SESSION['dni'];
$nombre = $_SESSION['nombres'];
$apellidomat = $_SESSION['apellidomat'];
$apellidopat =  $_SESSION['apellidopat'];
$idtipo = $_SESSION['idtipo'];
$tipo = $_SESSION['destipo'];
$iddetalle = $_SESSION['iddetalleus'];
$dataUgel = $asistencia->mostrarugel($iddetalle);
$nombreUgel = '';
$idUgel = '';
while ($ugel = mysqli_fetch_array($dataUgel)) {
    $idUgel = $ugel['ugel'];
    switch ($idUgel) {
        case 'gsc':
            $nombreUgel = 'General Sanchez Cerro';
            break;
        case 'ilo':
            $nombreUgel = 'Ilo';
            break;
        case 'mn':
            $nombreUgel = 'Mariscal Nieto';
            break;
        case 'sanig':
            $nombreUgel = 'San Ignacion de Loyola';
            break;
    }
    break;
}
    ?>
    <div class="container-fluid resultado">
        <br>
        <?php
        if (strtolower($nombre) == 'visitante') {
            echo "<h2> Bienvenido Visitante.</h2>";
        } else {
            /* if ($idtipo == '5' or $idtipo == '6') { */
            $Lisefq = $asistencia->moestraries($iddetalle);
            while ($Lpedq = mysqli_fetch_array($Lisefq)) {
        ?>
                <div class="container-fluid">
                    <div class="row">

                    </div>
                    <hr class="my-4">
                    <hr class="my-4">
                <?php
                break;
            }
                ?>
                <div class="container-fluid resultado">
                    <div class="container d-flex justify-content-center align-items-center min-vh-100">
                        <div class="row justify-content-center w-100">
                            <div class="col-8">

                                <?php ?>
                                <hr class="my-4">
                                <?php
                                require_once './../primariaCuadernillo.php';
                                ?>
                                <hr class="my-4">
                                <?php
                                require_once './../secundariaCuadernillo.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
    </div>
<?php } // Fin de Else inicial
?>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="js/jscript.js"></script>
</body>

</html>