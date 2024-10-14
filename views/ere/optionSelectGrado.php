<?php
    require_once "./../../modelo/Ere.php";

    $nivel = $_GET['dato'];
    $ere = new Ere;
    $data = $ere->getGrados4NivelSelect($nivel);
    
?>

<option value="0">Selecciona ...</option>
<?php 
if (is_array($data['data'])):
    $miArray = (explode('|',$data['clave'])); 
    $clave = $data['clave'];
    $valor = $data['valor'];
    foreach ($data['data'] as $d) : ?>
<option value="<?=$d[$miArray[0]].'|'.$d[$miArray[1]]?>"><?=$d[$valor]?></option>
    <?php 
    endforeach; 
endif;
?>