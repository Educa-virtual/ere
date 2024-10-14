<?php
require_once "./../../modelo/Ere.php";

$ugel = $_GET['info'];


$ere = new Ere;

$iesPrimaria = $ere->getIesXUgelNivel($ugel,'PRIMARIA');
$iesSecundaria = $ere->getIesXUgelNivel($ugel,'SECUNDARIA');

?>
<div class="row">
    <div class="col-sm-4">
        <aside class="d-flex flex-column scrollable-div p-3">
<div class="row">
<div class="col-sm-12">
    
    <h5>Nivel: PRIMARIA</h5>
</div>
</div>

            <div id="accordion">
                <?php 
            $distrito=''; $i=0;
            foreach ($iesPrimaria as $ie): 
                if (strtoupper($distrito)!=strtoupper($ie['distrito'])):
                    if($distrito!=""){
                        echo "</ol></div></div></div>";
                    } 
                    $i++;
                    
                    $distrito = strtoupper($ie['distrito']); ?>
                <div class="card">
                    <div class="card-header" id="heading<?=$i?>">
                        <h5 class="mb-0">
                            <button class="btn btn-outline-info btn-block" data-toggle="collapse"
                                data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                                <?=$ie['distrito'];?>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>"
                        data-parent="#accordion">
                        <div class="card-body">

                            <ol>
                                <?php endif; ?>

                                <li>
                                    <a href="#" class="btn btn-block text-left xLinkInfo"
                                        data-php="views/ere/detallesExamenProcesar"
                                        data-info="<?=$ie['codmodular']?>|Primaria|<?=$ie['descripcion']?>|<?=$ie['distrito']?>"
                                        data-destino="detalles">
                                        <?=$ie['descripcion'];?>
                                    </a>
                                </li>
                                <?php endforeach;?>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <h5>Nivel: SECUNDARIA</h5>

            <div id="accordion1">
                <?php 
            $distrito=''; 
            foreach ($iesSecundaria as $ie): 
                if (strtoupper($distrito)!=strtoupper($ie['distrito'])):
                    if($distrito!=""){
                        echo "</ol></div></div></div>";
                    } 
                    $i++;
                    
                    $distrito = strtoupper($ie['distrito']); ?>
                <div class="card">
                    <div class="card-header" id="heading<?=$i?>">
                        <h5 class="mb-0">
                            <button class="btn btn-outline-info btn-block" data-toggle="collapse"
                                data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                                <?=$ie['distrito'];?>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>"
                        data-parent="#accordion1">
                        <div class="card-body">

                            <ol>
                                <?php endif; ?>

                                <li>
                                    <a href="#" class="btn btn-block text-left xLinkInfo"
                                        data-php="views/ere/detallesExamenProcesar"
                                        data-info="<?=$ie['codmodular']?>|Secundaria|<?=$ie['descripcion']?>|<?=$ie['distrito']?>"
                                        data-destino="detalles">
                                        <?=$ie['descripcion'];?>
                                    </a>
                                </li>
                                <?php 

                        endforeach;
                        ?>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </aside>
    </div>


    <div class="col-sm-8">
        <div id="detalles">


        </div>

    </div>
</div>