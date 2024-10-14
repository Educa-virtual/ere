<?php
require_once "./../../modelo/ReportesSubirArchivos.php";
$r = new ReportesSubirArchivos;
$totales = $r->getTotales();
$resumen[] = [
    'titulo' => "UGEL ILO",
    'ugel' => "ilo",
    'data' => $r->getTotalesXUgel('ilo')
];
$resumen[] = [
    'titulo' => "UGEL MCAL. NIETO",
    'ugel' => "mn",
    'data' => $r->getTotalesXUgel('mn')
];
$resumen[] = [
    'titulo' => "UGEL GRAL. S.C.",
    'ugel' => "gsc",
    'data' => $r->getTotalesXUgel('gsc')
];
$resumen[] = [
    'titulo' => "UGEL SIL",
    'ugel' => "sanig",
    'data' => $r->getTotalesXUgel('sanig')
];
$totalesIlo = $r->getTotalesXUgel('ilo');
$totalesMN = $r->getTotalesXUgel('mn');
$totalesGSC = $r->getTotalesXUgel('gsc');
$totalesSIL = $r->getTotalesXUgel('sanig');
//  var_dump($totales);
$totalPorcNoSubieron = number_format($totales['ieNoSubieron'] / $totales['total'] * 100, 2);
$totalPorcSubieron = number_format($totales['ieSubieron'] / $totales['total'] * 100, 2);
$totalPorcValidados = number_format($totales['ieValidados'] / $totales['total'] * 100, 2);
$totalPorcProcesados = number_format($totales['ieProcesados'] / $totales['total'] * 100, 2);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center">Resumen de Archivos EXCEL Subidos y Validados <br> PROCESO-ERE 2024</h3>
        </div>
    </div>
    <hr class="y4">
    <div class="row">
        <?php
        foreach ($resumen as $r) :
            $porcNoSubieron = number_format($r['data']['ieNoSubieron'] / $r['data']['total'] * 100, 2);
            $porcSubieron = number_format($r['data']['ieSubieron'] / $r['data']['total'] * 100, 2);
            $porcValidados = number_format($r['data']['ieValidados'] / $r['data']['total'] * 100, 2);
            $porcProcesados = number_format($r['data']['ieProcesados'] / $r['data']['total'] * 100, 2);
        ?>
            <div class="col-sm-3">
                <h4 class="text-center"><?= $r['titulo'] ?></h4>
                <table class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Cant.</th>
                            <th>Progreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#" class="verIES" data-php="views/informes/verIesSinArchivos"
                                    data-info="<?= $r['ugel'] ?>" data-titulo="<?= $r['titulo'] ?>">
                                    IEs. No Subieron
                                </a>
                            </td>
                            <td class="text-center"><?= $r['data']['ieNoSubieron'] ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                        role="progressbar" style="width: <?= $porcNoSubieron ?>%;" aria-valuenow="45"
                                        aria-valuemin="0" aria-valuemax="100"><?= $porcNoSubieron ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>IEs. Subieron </td>
                            <td class="text-center"><?= $r['data']['ieSubieron'] ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                        role="progressbar" style="width: <?= $porcSubieron ?>%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="<?= $r['data']['total'] ?>"><?= $porcSubieron ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Validados </td>
                            <td class="text-center"><?= $r['data']['ieValidados'] ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" style="width: <?= $porcValidados ?>%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="<?= $r['data']['total'] ?>"><?= $porcValidados ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Procesados </td>
                            <td class="text-center"><?= $r['data']['ieProcesados'] ?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" style="width: <?= $porcProcesados ?>%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="<?= $r['data']['total'] ?>"><?= $porcProcesados ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th class="text-center"><?= $r['data']['total'] ?></th>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach;    ?>
    </div>
    <!-- ESTA USANDO OTRA VEZ LO DE ARRIBA / -->
    <hr class="y4">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-center">Resumen Gral.</h4>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cant.</th>
                        <th>Progreso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IEs. No Subieron</td>
                        <td class="text-center"><?= $totales['ieNoSubieron'] ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                    role="progressbar" style="width: <?= $totalPorcNoSubieron ?>%;" aria-valuenow="45"
                                    aria-valuemin="0" aria-valuemax="<?= $totales['total'] ?>"><?= $totalPorcNoSubieron ?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>IEs. Subieron </td>
                        <td class="text-center"><?= $totales['ieSubieron'] ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                    role="progressbar" style="width: <?= $totalPorcSubieron ?>%;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="<?= $totales['total'] ?>"><?= $totalPorcSubieron ?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Validados </td>
                        <td class="text-center"><?= $totales['ieValidados'] ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width: <?= $totalPorcValidados ?>%;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="<?= $totales['total'] ?>"><?= $totalPorcValidados ?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Procesados </td>
                        <td class="text-center"><?= $totales['ieProcesados'] ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width: <?= $totalPorcProcesados ?>%;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="<?= $totales['total'] ?>"><?= $totalPorcProcesados ?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th class="text-center"><?= $totales['total'] ?></th>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Leyenda</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <b>Total:</b>
                        </div>
                        <div class="col-sm-8">
                            Total de IIEEs.
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <b>IEs. No Subieron:</b>
                        </div>
                        <div class="col-sm-8">
                            Cant. de IIEEs que NO SUBIERON ningún archivo excel
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <b>IEs. Subieron:</b>
                        </div>
                        <div class="col-sm-8">
                            Cant de IIEEs. que subieron POR LO MENOS UN archivo Excel (Considerando que
                            no toas las IIEEs abrieron todos los grados)
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <b>Validados:</b>
                        </div>
                        <div class="col-sm-8">
                            Cantidad de Archivos Excel VALIDADOS por la UGEL.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalVerIES" tabindex="-1" role="dialog" aria-labelledby="modalVerIESLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-12">
                        <span id="miTitulo"></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div id="miData"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".verIES").click(function(e) {
            e.preventDefault();
            let obj = $(this);
            let pagina = obj.data('php') + '.php?info=' + obj.data('info');
            $('#miTitulo').html(obj.data('titulo') + '- No subieron Nada');
            $.ajax({
                    url: pagina,
                    type: "POST",
                    dataType: "html",
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })

                .done(function(data) {
                    $('.loader').hide();
                    $("#miData").html(data);
                    $('#modalVerIES').modal('show');

                })
                .fail(function(data) {
                    alert("error");
                    console.log(data);
                })
                .always(function() {});
        });
    </script>