<?php
// var_dump($_POST);

$estado = (strtoupper($_GET['accion'])=="VALIDAR")?'1':'0';

// Leemos los datos POST
    $historial=$_POST['historial'];
    $detalle=$_POST['detalle'];
    
    $codmodular=$_POST['codmodular'];
    
    $tipo=$_POST['tipo'];
    $obs=($_POST['obs']!=''?$_POST['obs']:'-');

    require_once "../../modelo/Ere.php";

        $ere = new Ere;

        $data = $ere->validarExamen($historial, $detalle,$codmodular,$estado,$obs,$tipo);
    
        if ($data['success'] && $estado==1)
            echo "Archivo validado y procesado con éxito.";
        elseif ($data['success'] && $estado==0)
            echo "Archivo devuelto y observado con éxito.";
        else
            echo "Error al registrar el Examen.";