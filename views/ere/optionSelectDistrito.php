<?php
    require_once "./../../modelo/Ere.php";

    $dato = $_GET['dato'];
    $ere = new Ere;
    $data = $ere->getDistritos4UgelSelect($dato);
    
?>

<option value="0">(Todos)</option>
<?php 
if (is_array($data['data'])):
    // $miArray = (explode('|',$data['clave'])); 
    $clave = $data['clave'];
    $valor = $data['valor'];
    foreach ($data['data'] as $d) : ?>
<option value="<?=$d[$clave]?>"><?=$d[$valor]?></option>
    <?php 
    endforeach; 
endif;
?>