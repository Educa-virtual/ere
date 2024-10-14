<?php
    require_once "./../../modelo/Ere.php";


    $ere = new Ere;
    $ugeles = $ere->getUgeles();

    
?>
<div class="card">
    <h6 class="card-header">
        <div class="row">
            <div class="col-sm-3 text-bold">
                .:: <i class="far fa-file-alt"></i> PROCESAR EXAMENES

            </div>

            <div class="col-sm-4 text-right text-bold py-1">
                Seleccione la UGEL:
            </div>
            <div class="col-sm-5">
                <?php 
                foreach ($ugeles as $u) : ?>
                <button class="xLinkInfo btn btn-outline-primary" data-info="<?=$u['ugel'];?>"
                    data-php="views/ere/mostrarDistritosIEEs" data-destino="mostrar">
                    <?=$u['ugeldescripcion'];?>
                </button>&nbsp;
                <?php endforeach;?>
            </div>
        </div>
    </h6>
    <div class="card-body" id="mostrar">

    </div>
</div>