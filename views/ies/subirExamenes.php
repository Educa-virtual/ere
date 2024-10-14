<?php
require_once "../../modelo/Ere.php";

$evaluacion = $_GET['dato'];    

$elementos = explode('|', $_GET['info']);

list($codigo,$nivel) = $elementos;

$ere = new Ere;
if (strtoupper($nivel)=='PRIMARIA'){
    $data = $ere->getDataEvaluacionPrimaria1(1,$codigo,$evaluacion);
} else {
    $data = $ere->getDataEvaluacionSecundaria1(1,$codigo,$evaluacion);
}

/* var_dump($data);exit; */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">

            <div class="row">
                <div class="col-sm-12 m-4">
                    <img src="imagen/BANER2024.png" width="100%">
                </div>
            </div>
        </div>
        <div class="col-8">

            <?php
            $nivel=''; $i=0; $grado='';

            if (is_array($data))
            foreach ($data as $d) :

                if ($d['nivel']!==$nivel){
                    if ($nivel !== ''){
                        echo "</tbody></table>";
                    }
                    
                    $nivel=$d['nivel']; $i = 1;
                    echo '<h3 class="text-center text-uppercase">'.$nivel.'</h3>';
                } 
                if ($d['grado']!==$grado) {
                    if ($grado !== '')
                     echo "</tbody></table>";

                        $i = 1;
                        $grado=$d['grado'];
                        echo '<h4>'.$d['grado'].' Grado</h4>'; 
                 ?>

            <table class="table table-sm table-bordered  table-striped table-hover">
                <thead>
                    <tr class="tablatitulo text-center">
                        <th scope="col" rowspan="2" class="align-middle">N°</th>
                        <th scope="col" rowspan="2" class="align-middle">ÁREA</th>
                        <th scope="col" colspan="2" class="align-middle">EXÁMENES</th>
                    </tr>
                    <tr class="tablatitulo text-center">
                        <th scope="col">Gral.</th>
                        <th scope="col">Especial</th>
                    </tr>
                </thead>
                <tbody class="areasarchivo">
                    <?php }
                
                ?>
                    <tr>
                        <th scope="row"><?=$i++?></th>
                        <td class="nombreArea">
                            <?=$d['descripcionarea']?><br>
                            <span class="text-danger"><?=$d['obs']?></span>
                        </td>
                        <td class="text-center">

                            <button type="button" class="btn <?=($d['examen']!='')?'btn-success':'btn-danger';?>"
                                data-toggle="modal" data-target="#modalSubirArchivo" data-area="<?=$d['area']?>"
                                data-historial="<?=$d['historial_id']?>" data-detalle="<?=$d['detalle_id']?>"
                                data-ugel="<?=$d['ugel']?>" data-codmodular="<?=$d['codmodular']?>"
                                data-grado="<?=$d['grado']?>" data-nivel="<?=$d['nivel']?>" data-tipo="General"
                                <?=($d['validacion']==1)?'disabled':'';?>>

                                <i class="fas fa-upload"></i>
                                <?=($d['validacion']==1)?'Validado':(($d['examen']!='')?'Actualizar Archivo':'Subir Archivo');?>
                            </button>
                        </td>
                        <td class="text-center">

                            <button type="button" class="btn <?=($d['examen1']!='')?'btn-success':'btn-danger';?>"
                                data-toggle="modal" data-target="#modalSubirArchivo" data-area="<?=$d['area']?>"
                                data-historial="<?=$d['historial_id']?>" data-detalle="<?=$d['detalle_id']?>"
                                data-ugel="<?=$d['ugel']?>" data-codmodular="<?=$d['codmodular']?>"
                                data-grado="<?=$d['grado']?>" data-nivel="<?=$d['nivel']?>" data-tipo="Especial"
                                <?=($d['validacion1']==1)?'disabled':'';?>>
                                <i class="fas fa-upload"></i>
                                <?=($d['validacion']==1)?'Validado':(($d['examen']!='')?'Actualizar Archivo':'Subir Archivo');?>
                            </button>
                        </td>
                    </tr>
                    <?php  
        endforeach; 
        echo "</tbody></table>";
        ?>

        </div>
    </div>
</div>