<?php
session_start();
if ($_SESSION["dni"] == '' || !isset($_SESSION["dni"]))
    header("location:index.php");
require_once "./../../modelo/Estadistica.php";
require_once "./../../modelo/Ere.php";
$ere = new Ere;
$ugeles = $ere->getUgeles();
$tabla = $_POST['evaluacion'];
$elementos = explode('|', $_POST['area']);
list($nivel, $grado, $area) = $elementos;
$ugel = $_POST['ugel'];
$distrito = $_POST['distrito'];
$gestion = $_POST['gestion'];
$zona = $_POST['zona'];
$ie = $_POST['ie'];
$seccion = $_POST['seccion'];
$sexo = $_POST['sexo'];
$estadistica = new Estadistica;
$datos = $estadistica->getDataEvaluacion(
    $tabla,
    $area,
    $nivel,
    $grado,
    $ugel,
    $distrito,
    $gestion,
    $zona,
    $ie,
    $seccion,
    $sexo
);

/* var_dump($datos['matriz']);exit; */
// Total de Registros
$totalRegistros = count($datos['datos']);

if ($totalRegistros == 0) {
    echo "<img src='./imagen/bloquear.png'>";
    die("No se encontraron Datos");
}

// Hallamos el total de nivel peso por item
$totalNivelPeso = 0;
for ($i = 1; $i <= 20; $i++) {
    $totalNivelPeso += $datos['matriz'][$i - 1]['nivelp'];
}


// Recuperemos Aciertos, DesAciertos, Blancos
$total = [
    'aciertos' => [0],
    'desaciertos' => [0],
    'blancos' => [0],
];
// Inicializamos los totales
for ($i = 1; $i <= 20; $i++) {
    $total['aciertos'][$i] = 0;
    $total['desaciertos'][$i] = 0;
    $total['blancos'][$i] = 0;
}
$letras = ['a', 'b', 'c', 'd'];
// Contamos por cada item de la matriz (1..20)
foreach ($datos['datos'] as $d) {
    $nroAciertos = 0;
    for ($i = 1; $i <= 20; $i++) {    // Contamos Aciertos, Desaciertos, Blancos
        $respuesta = "respuestas$i";
        if ($d[$respuesta] == null || $d[$respuesta] == '') {
            $total['blancos'][$i]++;
        } elseif (strtolower($d[$respuesta]) == strtolower($datos['matriz'][$i - 1]['clave'])) {
            $total['aciertos'][$i]++;
            $totalNivelPeso += $datos['matriz'][$i - 1]['nivelp']; // Para el promedio
            $nroAciertos += $datos['matriz'][$i - 1]['nivelp'];
            $d[$respuesta] = '<span class="correcto">' . $d[$respuesta] . '</span>';
        } else {
            $total['desaciertos'][$i]++;
            $d[$respuesta] = '<span class="incorrecto">' . $d[$respuesta] . '</span>';
        }
    }
    // Contamos por Nivel de logro

    $indicadores =  $datos['indicadores'][0];
    foreach ($letras as $letra) {
        $resultado = "resultado$letra";
        $indResultado = $datos['indicadores'][0][$resultado];
        if (!isset($total[$indResultado])) {
            $total[$indResultado] = 0;
            $datosIndicador[$indResultado]['data'] = [];
        }

        if ($indResultado != '') {
            $inicio = "inicial$letra";
            $fin = "final$letra";
            if (($nroAciertos >= $indicadores[$inicio])
                && ($nroAciertos <= $indicadores[$fin])
            ) {
                $total[$indResultado]++;
                $datosIndicador[$indResultado]['data'][] = $d;
            }
        }
    }
}
// Calculamos el promedio
$promedio = number_format($totalNivelPeso / $totalRegistros, 2);

?>
<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-filter"></i>
                    Filtros:
                </h5>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <small class="form-text text-muted">UGEL</small>
                        <select class="form-control form-control-sm xCombo" name="" id="ugel"
                            data-php="views/ere/optionSelectDistrito"
                            data-destino="distrito" data-info="">
                            <option value="0">(Todos)</option>
                            <?php
                            foreach ($ugeles as $u) {
                                echo "<option value='" . $u['ugel'] . "'>" . $u['ugeldescripcion'] . "</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-sm-6">
                        <small class="form-text text-muted">DISTRITO</small>
                        <select class="form-control form-control-sm xIIEE" id="distrito"
                            data-info="">
                            <option value="0">(Todos)</option>
                        </select>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-sm-6">
                        <small class="form-text text-muted">ZONA</small>
                        <select class="form-control form-control-sm xIIEE" name="" id="zona">
                            <option value="0">(Todos)</option>
                            <option value="URBANO">URBANO</option>
                            <option value="RURAL">RURAL</option>

                        </select>

                    </div>
                    <div class="col-sm-6">
                        <small class="form-text text-muted">GESTIÓN</small>
                        <select class="form-control form-control-sm xIIEE" name="" id="gestion">
                            <option value="0">(Todos)</option>
                            <option value="PÚBLICA">PÚBLICA</option>
                            <option value="PRIVADA">PRIVADA</option>

                        </select>

                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <small class="form-text text-muted">IIEE.</small>
                        <select class="form-control form-control-sm" name="" id="iiee">
                            <option value="0">(Todas)</option>

                        </select>

                    </div>
                    <div class="col-sm-6">
                        <small class="form-text text-muted">SECCIÓN</small>
                        <select class="form-control form-control-sm" name="" id="seccion">
                            <option value="0">(Todas)</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                        </select>

                    </div>
                    <div class="col-sm-6">
                        <small class="form-text text-muted">SEXO</small>
                        <select class="form-control form-control-sm" name="" id="sexo">
                            <option value="0">(Todos)</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>

                        </select>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary xFiltro"
                    data-php="views/informes/verEstadisticasDetalle"
                    data-destino="#detalles">
                    <span class="spinner-border spinner-border-sm cargando" role="status" aria-hidden="true"></span>
                    Aplicar
                </button>
            </div>
        </div>
    </div>

    <div class="col-sm-9">

        <div class="row">
            <div class="col-sm-12">
                <h5>Reporte para:</h5>
                <table class="table table-sm table-bordered  table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center"><small>Evaluación</small></th>
                            <th class="text-center"><small>Nivel</small></th>
                            <th class="text-center"><small>Grado</small></th>
                            <th class="text-center"><small>Área</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><small id="miEvaluacion"></small></td>
                            <td class="text-center"><small id="miNivel"></small></td>
                            <td class="text-center"><small id="miGrado"></small></td>
                            <td class="text-center"><small id="miArea"></small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5>Filtros:</h5>
                <table class="table table-sm table-bordered  table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><small>UGEL</small></th>
                            <th class="text-center"><small>Distrito</small></th>
                            <th class="text-center"><small>Zona</small></th>
                            <th class="text-center"><small>Gestión</small></th>
                            <th class="text-center"><small>IIEE</small></th>
                            <th class="text-center"><small>Secc.</small></th>
                            <th class="text-center"><small>Sexo</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><small id="miUgel"></small></td>
                            <td class="text-center"><small id="miDistrito"></small></td>
                            <td class="text-center"><small id="miZona"></small></td>
                            <td class="text-center"><small id="miGestion"></small></td>
                            <td class="text-center"><small id="miIE"></small></td>
                            <td class="text-center"><small id="miSeccion"></small></td>
                            <td class="text-center"><small id="miSexo"></small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="detalles">

            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-center">
                        <i class="fas fa-chart-pie"></i>
                        Estadísticas de nivel de logro
                    </h5>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div id="piechart_div" style="border: 1px solid #ccc"></div>
                </div>
                <div class="col-sm-5">

                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nivel de Logro</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-center">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($datos['indicadores'])) {
                                $letras = ['a', 'b', 'c', 'd'];

                                foreach ($letras as $letra) :
                                    $resultado = "resultado$letra";
                                    if ($indicadores[$resultado] != '') {
                            ?>
                                        <tr>
                                            <td>
                                                <a href="#">

                                                    <?= $indicadores[$resultado] ?>
                                                </a>
                                            </td>
                                            <td class="text-center"><?= number_format($total[$indicadores[$resultado]], 0, '.', ',') ?>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($total[$indicadores[$resultado]] / $totalRegistros * 100, 2) ?> %</td>
                                        </tr>
                            <?php
                                    }
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="text-center">Total</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">
                                <?= number_format($totalRegistros, 0, '.', ','); ?>
                            </h4>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">

                            <h5 class="text-center">Promedio</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">
                                <?= $promedio; ?>
                            </h4>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-center">
                        <i class="fas fa-table"></i>
                        Aciertos y Desaciertos por Item
                    </h5>
                    <table class="table table-sm table-bordered  table-striped table-hover ">
                        <thead>
                            <tr class="tablatitulor">
                                <th scope="col" width="120">Items</th>
                                <?php for ($i = 1; $i <= 20; $i++) : ?>
                                    <th class="text-center"><?= $i ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tablacontenidor">
                                <td>Nivel / Peso</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center"><?= $datos['matriz'][$i - 1]['nivelp'] ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Aciertos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center"><?= $total['aciertos'][$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Desaciertos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center"><?= $total['desaciertos'][$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Blancos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center"><?= $total['blancos'][$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Aciertos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center">
                                        <?= number_format(($total['aciertos'][$i]) / $totalRegistros * 100, 2) ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Desaciertos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center">
                                        <?= number_format(($total['desaciertos'][$i]) / $totalRegistros * 100, 2) ?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Blancos</td>
                                <?php
                                for ($i = 1; $i <= 20; $i++) : ?>
                                    <td class="text-center">
                                        <?= number_format(($total['blancos'][$i]) / $totalRegistros * 100, 2) ?></td>
                                <?php endfor; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h5>
                        <i class="far fa-chart-bar"></i>
                        Porcentajes de Aciertos y Desaciertos
                    </h5>
                    <div id="columnchart" style="border: 1px solid #ccc"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-center">
                        <i class="fas fa-table"></i>
                        Item, Aciertos, Desaciertos, En Blanco
                    </h5>

                    <table width="100%" class="table-sm table-bordered  table-striped table-hover">
                        <thead>
                            <tr class="tablatitulor">
                                <th scope="col" rowspan="2" class="text-center">Compentencia</th>
                                <th scope="col" rowspan="2" class="text-center">ITEM</th>
                                <th scope="col" rowspan="2" class="text-center">DESEMPEÑOS</th>
                                <th scope="col" colspan="2" class="text-center">ACIERTOS</th>
                                <th scope="col" colspan="2" class="text-center">DESACIERTOS</th>
                                <th scope="col" colspan="2" class="text-center">BLANCO</th>
                            </tr>
                            <tr class="tablatitulor">
                                <th scope="col" class="text-center">Cant.</th>
                                <th scope="col" class="text-center">%</th>
                                <th scope="col" class="text-center">Cant.</th>
                                <th scope="col" class="text-center">%</th>
                                <th scope="col" class="text-center">Cant.</th>
                                <th scope="col" class="text-center">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($datos['matriz']))
                                foreach ($datos['matriz'] as $m) :
                            ?>
                                <tr class="tablacontenidor">
                                    <td><?= $m['competencia'] ?></td>
                                    <td class="text-center"><?= $m['item'] ?></td>
                                    <td><?= $m['desempeno'] ?></td>
                                    <td class="text-center">
                                        <?= $total['aciertos'][$m['item']] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= number_format(($total['aciertos'][$m['item']]) / $totalRegistros * 100, 2) ?> %
                                    </td>
                                    <td class="text-center"><?= $total['desaciertos'][$m['item']] ?></td>
                                    <td class="text-center">
                                        <?= number_format(($total['desaciertos'][$m['item']]) / $totalRegistros * 100, 2) ?>%</td>
                                    <td class="text-center"><?= $total['blancos'][$m['item']] ?></td>
                                    <td class="text-center">
                                        <?= number_format(($total['blancos'][$m['item']]) / $totalRegistros * 100, 2) ?>%</td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div> <!-- Fin de detalles -->
    </div>
</div>

<script type="text/javascript">
    // Load Charts and the corechart and barchart packages.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Draw the pie chart and bar chart when Charts is loaded.
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?php
            foreach ($letras as $letra) :
                $resultado = "resultado$letra";
                $titulo = $indicadores[$resultado];
                if ($titulo != '') {
                    $valor = $total[$titulo];
                    echo "['$titulo', $valor],";
                }
            endforeach;
            ?>

        ]);

        var piechart_options = {
            title: 'Nivel de logro',
            titleTextStyle: {
                fontSize: 18,
                color: '#00f'
            },
            /* is3D: true, */
            pieHole: 0.4,
            width: 400,
            height: 300
        };
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);

        // Gráfico en columnas
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Items', '% Aciertos', '% Desaciertos', '% Blancos'],
                <?php
                for ($i = 1; $i <= 20; $i++) {

                    echo "['$i', " . number_format(($total['aciertos'][$i]) / $totalRegistros * 100, 2) . ","
                        . number_format(($total['desaciertos'][$i]) / $totalRegistros * 100, 2) . ","
                        . number_format(($total['blancos'][$i]) / $totalRegistros * 100, 2) . "],";
                }
                ?>

            ]);

            var options = {
                height: 400,
                vAxis: {
                    title: 'Porcentajes',
                    titleTextStyle: {
                        color: '#00f'
                    },
                    format: {
                        format: 'percent'
                    },

                    ticks: [20, 40, 60, 80]
                },
                legend: {
                    position: 'top',
                    alignment: 'start',
                    orientation: 'horizontal',
                    textStyle: {
                        fontSize: 10
                    }
                },

                chart: {
                    title: 'Preguntas y Porcentajes de respuestas',
                    subtitle: 'Porcentajes de: aciertos, desaciertos y en Blanco',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    }
</script>
<script>
    $(document).on('change', '.xIIEE', function() {
        let obj = $(this);
        let pagina = 'views/ere/optionSelectIe.php';
        let destino = '#iiee';

        let ugel = $('#ugel').val();
        $('#frmUgel').val(ugel);

        let distrito = $('#distrito').val();
        $('#frmDistrito').val(distrito);

        let zona = $('#zona').val();
        $('#frmZona').val(zona);

        let gestion = $('#gestion').val();
        $('#frmGestion').val(gestion);

        var formData = new FormData($('#frmEstadistica')[0]);
        console.log(distrito);
        $.ajax({
                url: pagina,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader').show();
                    $('.cargando').removeClass("cargar");
                }
            })
            .done(function(data) {
                console.log(data)
                $(destino).html(data);
            })
            .fail(function(data) {
                alert("error");
                console.log(data);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });
    $(document).on('click', '.xFiltro', function() {
        let obj = $(this);
        let pagina = obj.data('php') + '.php';
        let destino = obj.data('destino');

        let ugel = $('#ugel').val();
        $('#frmUgel').val(ugel);

        let distrito = $('#distrito').val();
        $('#frmDistrito').val(distrito);

        let zona = $('#zona').val();
        $('#frmZona').val(zona);

        let gestion = $('#gestion').val();
        $('#frmGestion').val(gestion);

        let ie = $('#iiee').val();
        $('#frmIe').val(ie);

        let seccion = $('#seccion').val();
        $('#frmSeccion').val(seccion);

        let sexo = $('#sexo').val();
        $('#frmSexo').val(sexo);

        var formData = new FormData($('#frmEstadistica')[0]);

        $.ajax({
                url: pagina,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader').show();
                    $('.cargando').removeClass("cargar");
                }
            })
            .done(function(data) {
                $('#miUgel').html($('#ugel').find('option:selected').text())
                $('#miDistrito').html($('#distrito').find('option:selected').text())
                $('#miZona').html($('#zona').find('option:selected').text())
                $('#miGestion').html($('#gestion').find('option:selected').text())
                $('#miIE').html($('#iiee').find('option:selected').text())
                $('#miSeccion').html($('#seccion').find('option:selected').text())
                $('#miSexo').html($('#sexo').find('option:selected').text())

                $(destino).html(data);
            })
            .fail(function(data) {
                alert("error");
                console.log(data);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });
</script>