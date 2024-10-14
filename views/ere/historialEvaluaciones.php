<?php
require_once "./../../modelo/Ere.php";

$ere = new Ere;

$evaluaciones = $ere->getAllData('evaluacion','descripcion desc');

?>

<div class="card">
    <h6 class="card-header">
        <div class="row">
            <div class="col-sm-4 text-bold">
                .:: <i class="far fa-file-alt"></i> HISTORIAL DE EVALUACIONES
            </div>
            <div class="col-sm-4 text-right text-bold py-1">
                Seleccione una Evaluación:
            </div>
            <div class="col-sm-4">
                <select class="form-control" name="seleare" id="evaluacion"><br><br>
                    <option value="">Selecciona ..</option>
                    <?php foreach ($evaluaciones as $e) : ?>
                    <option value="<?=$e['tabla']; ?>"><?=$e['descripcion'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </h6>
    <div class="card-body mostrar">

        


    </div>
</div>