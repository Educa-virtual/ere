<?php
// $totalTrazo = (isset($th))?count($th->getTrace()):0;
$e404 = isset($th)?false:true;
if ($e404) { CtrlError::mostrar404(); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error..</title>
    <!-- Custom CSS -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
</head>
<body class="container-fluid mt-2">
    <h1 class="text-center text-white bg-danger">Error detectado...</h1>
    <div class="row">
        <div class="col-sm-3 text-center">
            <h4 class="text-danger">Problemas en el paraiso:</h4>
            <img src="./assets/img/ouch01.jpg" alt="error" class="img-fluid rounded-circle">
            <br>
            <br>
            <p class="text-center">
                <a href="?" class="btn btn-primary">Retornar</a>
            </p>
        </div>
        <div class="col-sm-6">
            <h3>Detalles del error detectado</h3>
            <div class="row">
                <table class="table table-sm">
                    <tr>        
                        <td>
                            <b>Código:</b>
                        </td>
                        <td>
                            <?=$th->getCode()?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Archivo:</b>
                        </td>
                        <td>
                            <?=$th->getFile()?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Mensaje:</b>
                        </td>
                        <td><b class="text-danger"> 
                                <i>
                                <?=$th->getMessage()?>
                                </i>
                            </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <b>Error al ejecutar:</b>
                        </td>
                        <td>
                            <?=$th->getTraceAsString()?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Error previo:</b>
                        </td>
                        <td>
                            <?=$th->getPrevious()?>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div class="row">
                <table class="table table-sm">
                    <?php 
                    $i = 1;
                    foreach ($th->getTrace() as $t) : ?>
                    <tr>
                        <th colspan="2"><span class="text-danger"> Trazado de datos (<?=$i++?>)</span></th>
                    </tr>    
                    <tr>
                        <td width="25%">
                            <b>Linea:</b>
                        </td>
                        <td>
                            <?=isset($t['line'])?$t['line']:'-'?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Método/Funcion:</b>
                        </td>
                        <td>
                            <?=isset($t['function'])?$t['function']:'-'?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Clase:</b>
                        </td>
                        <td>
                            <?=isset($t['class'])?$t['class']:'-'?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tipo:</b>
                        </td>
                        <td>
                            <?=isset($t['type'])?$t['type']:'-'?>
                        </td>
                    </tr>
                    
                    <?php 
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
        <div class="col-sm-3 text-center">
            <img src="./assets/img/error_detectado.png" alt="error" class="img-fluid">
        </div>
    </div>
</body>
</html>