<?php
    require_once "./../../modelo/Ere.php";

    $dato = $_GET['dato'];
    $miArray = (explode('|',$dato)); 
    $ere = new Ere;
    $data = $ere->getArea4GradoSelect($miArray[0],$miArray[1]);
    
?>

<option value="0">Selecciona ...</option>
<?php 
if (is_array($data['data'])):
    // $miArray = (explode('|',$data['clave'])); 
    $clave = $data['clave'];
    $valor = $data['valor'];
    foreach ($data['data'] as $d) : ?>
<option value="<?=$dato.'|'.$d[$clave]?>"><?=$d[$valor]?></option>
    <?php 
    endforeach; 
endif;
?>