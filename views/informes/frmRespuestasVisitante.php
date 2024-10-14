<?php
    require_once "./../../modelo/Ere.php";

    $ere = new Ere;
    // $ugeles = $ere->getUgeles();
    $evaluaciones = $ere->getAllData('evaluacion','descripcion desc');
    /* $ugel = null;

    if (is_array($ugel))
        $ugeles = [$ugel]; */
    
?>
<div class="card">
    <h6 class="card-header">
        <div class="row">

            <div class="col-sm-2 text-bold">
                .:: <i class="far fa-file-alt"></i> ESTADÍSTICAS PARA...
            </div>

            <div class="col-sm-2">
                <small class="form-text text-muted">EVALUACION</small>
                <select class="form-control form-control-sm" name="" id="evaluacion">
                    <option value="0">Selecciona...</option>
                    <?php 
                        foreach ($evaluaciones as $u) 
                            echo "<option value='".$u['tabla']."'>".$u['descripcion']."</option>";
                            ?>
                </select>
            </div>

            <div class="col-sm-2">
                <small class="form-text text-muted">NIVEL</small>
                <select class="form-control form-control-sm xCombo" data-php="views/ere/optionSelectGrado" data-info=""
                    data-destino="grado" id="nivel">
                    <option value="0">Selecciona...</option>
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                </select>
            </div>
            <div class="col-sm-1">
                <small class="form-text text-muted">GRADO</small>
                <select class="form-control form-control-sm xCombo" data-php="views/ere/optionSelectArea" data-info=""
                    data-destino="area" id="grado">
                    <option value="0">Selecciona...</option>

                </select>
            </div>
            <div class="col-sm-3">
                <small class="form-text text-muted">AREA</small>
                <select class="form-control form-control-sm" id="area">
                    <option value="0">Selecciona...</option>

                </select>

            </div>
            <div class="col-sm-2">

                <button id="getEstadisticasVisitante" data-php="views/informes/verEstadisticasVisitante" data-destino="resultados"
                    data-info="" class="btn btn-primary btn-lg">
                    <span class="spinner-border spinner-border-sm cargando" role="status" aria-hidden="true"></span>
                    PROCESAR
                </button>
                <form id="frmEstadistica" method="post">
                    <input type="text" value="0" id="frmEvaluacion" name="evaluacion" hidden>
                    
                    <input type="text" value="0" id="frmGrado" name="grado" hidden>
                    <input type="text" value="0" id="frmNivel" name="nivel" hidden>
                    <input type="text" value="0" id="frmArea" name="area" hidden>

                    <input type="text" value="0" id="frmUgel" name="ugel" hidden>
                    <input type="text" value="0" id="frmDistrito" name="distrito" hidden>
                    <input type="text" value="0" id="frmZona" name="zona" hidden>
                    <input type="text" value="0" id="frmGestion" name="gestion" hidden>
                    <input type="text" value="0" id="frmIe" name="ie" hidden>
                    <input type="text" value="0" id="frmSeccion" name="seccion" hidden>
                    <input type="text" value="0" id="frmSexo" name="sexo" hidden>
                </form>

            </div>

        </div>

    </h6>
    <div class="card-body">
        <div id="resultados">
            Resultados
        </div>

    </div>
</div>
<script>
    $(document).on('click', '#getEstadisticasVisitante', function() {
        let obj = $(this);
        let pagina = obj.data('php') + '.php';
        let info = obj.data('info');
        let evaluacion = $('#evaluacion').val();
        let nivel = $('#nivel').val();
        let grado = $('#grado').val();
        let area = $('#area').val();
        let ugel = $('#ugel').val();
        if (validarSeleccion('evaluacion',evaluacion)==false){ 
            $('#evaluacion').focus()
            return false; 
        }
        if (validarSeleccion('nivel',nivel)==false){ 
            $('#nivel').focus()
            return false; 
        }
        if (validarSeleccion('grado',grado)==false){ 
            $('#grado').focus()
            return false; 
        }
        if (validarSeleccion('area',area)==false){ 
            $('#area').focus()
            return false; 
        }
        // Cargamos datos al Formulario
        $('#frmEvaluacion').val(evaluacion);
        $('#frmGrado').val(grado);
        $('#frmNivel').val(nivel);
        $('#frmArea').val(area);

        $('#frmUgel').val('0');
        $('#frmDistrito').val('0');
        $('#frmZona').val('0');
        $('#frmGestion').val('0');
        $('#frmIe').val('0');
        $('#frmSeccion').val('0');
        $('#frmSexo').val('0');

        // Recuperamos el formulario
        var formData = new FormData($('#frmEstadistica')[0]);

        let destino = '#'+obj.data('destino');
        
        $.ajax({
                url: pagina + '?info=' + info,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.cargando').removeClass("cargar");
                    $('.loader').show();
                }
            })

            .done(function(data) {
                /* const myArray = area.split("|"); */
                $(destino).html(data);
                
                $('#miEvaluacion').html($('#evaluacion').find('option:selected').text())
                $('#miNivel').html($('#nivel').find('option:selected').text())
                $('#miGrado').html($('#grado').find('option:selected').text())
                $('#miArea').html($('#area').find('option:selected').text())
                $('#miUgel').html($('#ugel').find('option:selected').text())
                $('#miDistrito').html($('#distrito').find('option:selected').text())
                $('#miZona').html($('#zona').find('option:selected').text())
                $('#miGestion').html($('#gestion').find('option:selected').text())
                $('#miIE').html($('#iiee').find('option:selected').text())
                $('#miSeccion').html($('#seccion').find('option:selected').text())
                $('#miSexo').html($('#sexo').find('option:selected').text())

                
            
            })
            .fail(function(xhr, status, error) {
                // alert("error");
                // Manejo del error
                console.error("Ocurrió un error durante la solicitud AJAX:");
                console.error("Estado:", status);           // Estado de la solicitud (error, timeout, etc.)
                console.error("Error:", error);             // Mensaje de error (puede ser null)
                console.error("Código de estado HTTP:", xhr.status);    // Código de estado HTTP (404, 500, etc.)
                console.error("Texto del estado HTTP:", xhr.statusText); // Texto del estado HTTP
                alert("Ocurrió un error en la solicitud: " + status + " - " + error);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });

</script>