<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    
    return;
}

if (!isset($_FILES['excelFile']) || $_FILES['excelFile']['error'] !== UPLOAD_ERR_OK) {
    echo "Error al subir el archivo.";
    return;
}
    $fileTmpPath = $_FILES['excelFile']['tmp_name'];
    $fileName = $_FILES['excelFile']['name'];
    $fileSize = $_FILES['excelFile']['size'];
    $fileType = $_FILES['excelFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedfileExtensions = ['xlsm'];
    if (!in_array($fileExtension, $allowedfileExtensions)) {
        echo "Formato de archivo no permitido. Solo se permiten archivos .xlsm.";
        exit;
    }
    // Leemos los datos POST
        $historial=$_POST['historial'];
        $detalle=$_POST['detalle'];
        $nivel=$_POST['nivel'];
        $codmodular=$_POST['codmodular'];
        $grado=$_POST['grado'];
        $area=$_POST['area'];
        $tipo=$_POST['tipo'];

    // Carpeta donde se guardará el archivo
    $uploadFileDir = './../../archivos/'.$historial.'/'.$codmodular.'/'.$nivel.'/'.$grado.'/'.$area.'/';
    $uploadFileDirSave = 'archivos/'.$historial.'/'.$codmodular.'/'.$nivel.'/'.$grado.'/'.$area.'/';
    
    if (!is_dir($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true); // Crea la carpeta si no existe
    }
    $dest_path = $uploadFileDir . $fileName;
    $dest_pathSave = $uploadFileDirSave . $fileName;

    // Mover el archivo subido a la carpeta especificada
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
        require_once "../../modelo/Ere.php";

        $ere = new Ere;

        $data = $ere->guardarExamen($historial, $detalle,$codmodular,$dest_pathSave,$tipo);
        if ($data['success'])
            echo "Archivo subido y procesado con éxito.";
        else
            echo "Error al registrar el Examen.";
    } else {
        echo "Error al mover el archivo a la carpeta de destino.";
    }
    
    