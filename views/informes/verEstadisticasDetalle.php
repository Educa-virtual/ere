<style>
table {
    table-layout: auto; /* Permite que el navegador ajuste el ancho de las columnas automáticamente */
}
.table-responsive {
    overflow-x: auto;
}
#dataTable {
    font-size: 10px;
    font-weight: normal;
    /* Ajusta el tamaño según lo necesites */
}

#dataTable tbody td {
    font-size: 12px;
    /* Ajusta el tamaño según sea necesario */
}

</style>
<?php

    require_once "./../../modelo/Estadistica.php";
    require_once "./../../modelo/Ere.php";

    //var_dump($_POST);exit;

    $ere = new Ere;
    $ugeles = $ere->getUgeles();
    
    $tabla = $_POST['evaluacion'];
    
    $elementos = explode('|', $_POST['area']);

    list($nivel,$grado,$area) = $elementos;

    $ugel = $_POST['ugel'];
    $distrito = $_POST['distrito'];
    $gestion = $_POST['gestion'];
    $zona = $_POST['zona'];
    $ie = $_POST['ie'];
    $seccion = $_POST['seccion'];
    $sexo = $_POST['sexo'];

    $estadistica = new Estadistica;
    $datos = $estadistica->getDataEvaluacion($tabla,$area, $nivel, $grado, 
            $ugel, $distrito, $gestion, $zona, $ie, $seccion, $sexo);
    
    /* var_dump($datos['matriz']);exit; */
    // Total de Registros
    $totalRegistros=0;
    if (is_array($datos))
        $totalRegistros = count($datos['datos']);
    
    if ($totalRegistros == 0){
        echo "<img src='./imagen/bloquear.png'>";
        die ("No se encontraron Datos");
    }

    // Hallamos el total de nivel peso por item
    $totalNivelPeso = 0;
    for ($i=1; $i <= 20 ; $i++) { 
        $totalNivelPeso += $datos['matriz'][$i-1]['nivelp'];
    }

    

    // Recuperemos Aciertos, DesAciertos, Blancos
    $total = [
        'aciertos'=>[0],
        'desaciertos'=>[0],
        'blancos'=>[0],
    ];
    // Inicializamos los totales
    for ($i=1; $i <=20 ; $i++) { 
        $total['aciertos'][$i] = 0;
        $total['desaciertos'][$i] = 0;
        $total['blancos'][$i] = 0;
    }
     $letras = ['a','b','c','d'];
    // Contamos por cada item de la matriz (1..20)
        foreach ($datos['datos'] as $d) {
            $nroAciertos = 0; $puntaje=0; $nroBlancos = 0; $nroDesaciertos = 0;
            for ($i=1; $i <= 20; $i++) {    // Contamos Aciertos, Desaciertos, Blancos
                $respuesta="respuestas$i";
                if($d[$respuesta]==null || $d[$respuesta]==''){
                    $total['blancos'][$i]++;
                    $nroBlancos++;
                    
                }elseif (strtolower ($d[$respuesta])==strtolower($datos['matriz'][$i-1]['clave'])){
                    $total['aciertos'][$i]++;
                    $nroAciertos++;
                    $totalNivelPeso+=$datos['matriz'][$i-1]['nivelp']; // Para el promedio
                    $puntaje+=$datos['matriz'][$i-1]['nivelp'];
                    $d[$respuesta]='<span class="correcto">'.$d[$respuesta].'</span>';
                }else{
                    $total['desaciertos'][$i]++;
                    $nroDesaciertos++;
                    $d[$respuesta]='<span class="incorrecto">'.$d[$respuesta].'</span>';
                }

            }
            $d['aciertos']=$nroAciertos;
            $d['desaciertos']=$nroDesaciertos;
            $d['blancos']=$nroBlancos;
            $d['puntaje']=$puntaje;

            // Contamos por Nivel de logro
            $indicadores =  $datos['indicadores'][0];   
            foreach ($letras as $letra) {
                $resultado = "resultado$letra";
                $indResultado = $datos['indicadores'][0][$resultado];
                if(!isset($total[$indResultado])){
                    $total[$indResultado]=0;
                    $datosIndicador[$indResultado]['data']=array();
                }

                if ($indResultado!=''){
                    $inicio = "inicial$letra";
                    $fin = "final$letra";
                    if (($puntaje >= $indicadores[$inicio]) 
                        && ($puntaje <= $indicadores[$fin])){
                        $total[$indResultado]++;
                        // Separamos los registros por indicador
                         $datosIndicador[$indResultado]['data'][]=$d;
                    }
                }
            }
            
        }
        // Calculamos el promedio
        $promedio = number_format ($totalNivelPeso/$totalRegistros, 2);

?>
<div class="row">
    <div class="col-sm-12">

        <div class="detalles">

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
                    <div id="piechart_div1" style="border: 1px solid #ccc"></div>
                </div>
                <div class="col-sm-5">

                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nivel de Logro</th>
                                <th>Rango</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-center">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($datos['indicadores'])){
                            $letras = ['a','b','c','d'];
                            $i=1;
                            $indicadores =  $datos['indicadores'][0]; 
                            foreach ($letras as $letra) :
                                $resultado = "resultado$letra";
                                if ($datos['indicadores'][0][$resultado]!=''){
                                    $inicio = "inicial$letra";
                                    $fin = "final$letra";
                            ?>
                            <tr>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modalDatosEstudiantes"
                                        data-midata="d<?=$i?>" data-titulo="<?=$datos['indicadores'][0][$resultado]?>">

                                        <?=$datos['indicadores'][0][$resultado]?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?=$indicadores[$inicio].' - ' . $indicadores[$fin]?>
                                </td>
                                <td class="text-center">
                                    <?=number_format($total[$datos['indicadores'][0][$resultado]],0,'.',',')?></td>
                                <td class="text-center">
                                    <?=number_format($total[$datos['indicadores'][0][$resultado]]/$totalRegistros*100, 2)?>
                                    %</td>
                            </tr>
                            <?php
                            $i++;
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
                                <?=number_format($totalRegistros,0,'.',',');?>
                            </h4>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">

                            <h5 class="text-center">Promedio</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">
                                <?=$promedio;?>
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
                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                <th class="text-center"><?=$i?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tablacontenidor">
                                <td>Nivel / Peso</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center"><?=$datos['matriz'][$i-1]['nivelp']?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Aciertos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center"><?=$total['aciertos'][$i]?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Desaciertos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center"><?=$total['desaciertos'][$i]?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>Nro. Blancos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center"><?=$total['blancos'][$i]?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Aciertos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center">
                                    <?=number_format(($total['aciertos'][$i])/$totalRegistros*100,2)?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Desaciertos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center">
                                    <?=number_format(($total['desaciertos'][$i])/$totalRegistros*100,2)?></td>
                                <?php endfor; ?>
                            </tr>
                            <tr class="tablacontenidor">
                                <td>% Blancos</td>
                                <?php 
                    for ($i=1; $i <= 20; $i++) : ?>
                                <td class="text-center">
                                    <?=number_format(($total['blancos'][$i])/$totalRegistros*100,2)?></td>
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
                    <div id="columnchart1" style="border: 1px solid #ccc"></div>
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
                                <td><?=$m['competencia']?></td>
                                <td class="text-center"><?=$m['item']?></td>
                                <td><?=$m['desempeno']?></td>
                                <td class="text-center">
                                    <?=$total['aciertos'][$m['item']]?>
                                </td>
                                <td class="text-center">
                                    <?=number_format(($total['aciertos'][$m['item']])/$totalRegistros*100,2)?> %
                                </td>
                                <td class="text-center"><?=$total['desaciertos'][$m['item']]?></td>
                                <td class="text-center">
                                    <?=number_format(($total['desaciertos'][$m['item']])/$totalRegistros*100,2)?>%</td>
                                <td class="text-center"><?=$total['blancos'][$m['item']]?></td>
                                <td class="text-center">
                                    <?=number_format(($total['blancos'][$m['item']])/$totalRegistros*100,2)?>%</td>
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

<!-- Modal Tabla de datos -->
<div class="modal fade" id="modalDatosEstudiantes" tabindex="-1" role="dialog"
    aria-labelledby="modalDatosEstudiantesLabel" aria-hidden="true">


    <div class="modal-dialog" role="document" style="max-width: 95%; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-12">
                    Detalles de Estudiantes - <span id="miTitulo"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped" style="width: 100%;">
                        <thead style="width: 100%;">
                            <tr>
                                <td>Apellidos y Nombres</td>
                                <td>Sec.</td>
                                <td>UGEL</td>
                                <td>IIEE</td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>Aci.</td>
                                <td>Des.</td>
                                <td>Bln.</td>
                                <td>Ptos.</td>
                                <td>Tutor</td>
                            </tr>
                        </thead>
                        <tbody style="width: 100%;">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Fin Modal Tabla de datos -->


<script type="text/javascript">
$('#dataTable').DataTable({
    scrollX: true,
    paging: false,
    searching: false,
    language: {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "infoPostFix": "",
        "search": "Buscar:",
        "url": "",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});

var datos1, datos2, dato3, datos4;
<?php
// Cargar Data por Indicador
$i=1;
foreach ($letras as $letra) :
    $resultado = "resultado$letra";
    $titulo=$datos['indicadores'][0][$resultado];
    if ($titulo !=''){ 
        if ($i==1) { ?>
datos1 = <?php echo json_encode($datosIndicador[$titulo]['data'])?>;
<?php }
        if ($i==2) { ?>
datos2 = <?php echo json_encode($datosIndicador[$titulo]['data'])?>;
<?php }
        if ($i==3) { ?>
datos3 = <?php echo json_encode($datosIndicador[$titulo]['data'])?>;
<?php }
        if ($i==4) { ?>
datos4 = <?php echo json_encode($datosIndicador[$titulo]['data'])?>;
<?php }
    }
    $i++;
 endforeach;
            
?>
var datos = {
    d1: datos1,
    d2: datos2,
    d3: datos3,
    d4: datos4
};

$('#modalDatosEstudiantes').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    let titulo = button.data('titulo');
    let miData = button.data('midata');
    $('#miTitulo').html(titulo);
    dataArray = datos[miData];
    console.log(dataArray)
    var table = $('#dataTable').DataTable();
    table.clear().draw();
    $.each(dataArray, function(index, value) {
        table.row.add([
            value.apellidopaterno + ',' + value.apellidomaterno + ',' + value.primernombre,
            value.seccion,
            value.ugel,
            value.codigomodular + ' | '+value.ie,
            value.respuestas1,
            value.respuestas2,
            value.respuestas3,
            value.respuestas4,
            value.respuestas5,
            value.respuestas6,
            value.respuestas7,
            value.respuestas8,
            value.respuestas9,
            value.respuestas10,
            value.respuestas11,
            value.respuestas12,
            value.respuestas13,
            value.respuestas14,
            value.respuestas15,
            value.respuestas16,
            value.respuestas17,
            value.respuestas18,
            value.respuestas19,
            value.respuestas20,
            value.aciertos,
            value.desaciertos,
            value.blancos,
            value.puntaje,
            value.apepaternodo + ' ' + value.apematernodo + ', ' + value.nombredo
        ]).draw(false);

    });

});
</script>
<script type="text/javascript">
// Load Charts and the corechart and barchart packages.
google.charts.load('current', {
    'packages': ['corechart']
});

// Draw the pie chart and bar chart when Charts is loaded.
google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
        <?php 
            foreach ($letras as $letra) :
                $resultado = "resultado$letra";
                $titulo=$datos['indicadores'][0][$resultado];
                if ($titulo!=''){
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
    var piechart = new google.visualization.PieChart(document.getElementById('piechart_div1'));
    piechart.draw(data, piechart_options);

    // Gráfico en columnas
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['Items', '% Aciertos', '% Desaciertos', '% Blancos'],
            <?php 
            for ($i=1; $i <=20 ; $i++) { 
                
                echo "['$i', " . number_format(($total['aciertos'][$i])/$totalRegistros*100,2) . ","
                . number_format(($total['desaciertos'][$i])/$totalRegistros*100,2) . ","
                . number_format(($total['blancos'][$i])/$totalRegistros*100,2)."],";
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

        var chart = new google.charts.Bar(document.getElementById('columnchart1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
}
</script>
<script>



</script>