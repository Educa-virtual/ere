<?php
require_once "./../../modelo/ReportesSubirArchivos.php";
$r = new ReportesSubirArchivos;
$ies = $r->getIIEEnoSubieronXUGEL($_GET['info']);
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>item</th>
                    <th>Cod. Modular</th>
                    <th>Distrito</th>
                    <th>Nombre IIEE.</th>
                    <th>Nivel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($ies as $ie) :
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $ie['codmodular'] ?></td>
                        <td><?= $ie['distrito'] ?></td>
                        <td><?= $ie['descripcion'] ?></td>
                        <td><?= $ie['nivel'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>