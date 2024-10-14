<?php
    require_once "./../../modelo/Ere.php";

    /* $dato = $_GET['dato']; */
    $ugel = $_POST['ugel'];
    $distrito = $_POST['distrito'];
    $nivel = $_POST['nivel'];
    $zona = $_POST['zona'];
    $gestion = $_POST['gestion'];

    if ($gestion=='PÚBLICA')
        $gestion = 'PUBLICA';
    if ($zona=='URBANO')
        $zona = 'URBANA';

   /*  var_dump($_POST);exit; */
    $ere = new Ere;
    $data = $ere->getIe4DistritoSelect($ugel, $nivel, $distrito, $zona, $gestion);
    
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