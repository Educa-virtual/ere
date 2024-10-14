<?php
require_once "./../../modelo/Ere.php";
$ie = explode('|', $_GET['info']);
$ere = new Ere;
$evaluaciones = $ere->getAllData('evaluacion', 'descripcion desc');
?>
<div class="card">
    <h6 class="card-header">
        <div class="row">
            <div class="col-sm-4 text-bold">
                .:: <i class="far fa-file-alt"></i> SUBIR ARCHIVOS EXCEL DE EVALUACIÓN
            </div>
            <div class="col-sm-4">
                II.EE: <?= $ie[0] ?> - <?= $ie[1] ?> (<?= $ie[2] ?>)
            </div>
            <div class="col-sm-2 text-right text-bold py-1">
                Evaluación:
            </div>
            <div class="col-sm-2">
                <select class="form-control xCombo"
                    data-php="views/ies/subirExamenes"
                    data-info="<?= $ie[0] ?>|<?= $ie[2] ?>"
                    id="evaluacion">
                    <option value="">Selecciona ..</option>
                    <?php foreach ($evaluaciones as $e) : ?>
                        <option value="<?= $e['tabla']; ?>"><?= $e['descripcion']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </h6>
    <div class="card-body" id="mostrar">

    </div>
</div>