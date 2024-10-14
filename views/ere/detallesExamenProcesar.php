<?php
// var_dump($_GET);
require_once "../../modelo/Ere.php";

$elementos = explode('|', $_GET['info']);
list($codigo, $nivel, $nombre, $distrito) = $elementos;

$ere = new Ere;
if (strtoupper($nivel) == 'PRIMARIA') {
    $data = $ere->getDataEvaluacionPrimaria(1, $codigo);
} else {
    $data = $ere->getDataEvaluacionSecundaria(1, $codigo);
}

?>
<div class="row">
    <div class="col-sm-2">
        <p class="font-weight-bold">

            .:: Distrito ::.
        </p>
    </div>
    <div class="col-sm-10">
        <span class="text-uppercase font-weight-bold">
            <?= $distrito ?>
        </span>

    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <p class="font-weight-bold">

            .:: II.EE. ::.
        </p>
    </div>
    <div class="col-sm-10">
        <span class="font-weight-bold">
            (<?= $codigo ?>):
        </span>
        <?= $nombre ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h4 class="text-uppercase text-center">

            <?= $nivel ?>
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php
        $i = 0;
        $grado = '';

        if (is_array($data))
            foreach ($data as $d) :


                if ($d['grado'] !== $grado) {
                    if ($grado !== '')
                        echo "</tbody></table>";

                    $i = 1;
                    $grado = $d['grado'];
                    echo '<h4 class="text-bold">' . $d['grado'] . ' Grado</h4>';
        ?>
                <table class="table table-sm table-bordered  table-striped table-hover">
                    <thead>
                        <tr class="tablatitulo text-center">
                            <th scope="col" rowspan="2" class="align-middle">N°</th>
                            <th scope="col" rowspan="2" class="align-middle">ÁREA</th>
                            <th scope="col" colspan="5" class="align-middle">EXÁMENES</th>
                        </tr>
                        <tr class="tablatitulo text-center">
                            <th scope="col">Archivo</th>
                            <th scope="col">Subir</th>
                            <th scope="col">Validar</th>
                            <th scope="col">Procesar</th>
                            <th scope="col">Estadísticas</th>

                        </tr>
                    </thead>
                    <tbody class="areasarchivo">
                    <?php }

                    ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td class="nombreArea">
                            <?= $d['descripcionarea'] ?><br>
                            <span class="text-danger"><?= $d['obs'] ?></span>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($d['examen'] != '') { ?>

                                <a href="<?= ($d['examen'] != '') ? $d['examen'] : '#'; ?>">
                                    <?= ($d['examen'] != '') ? 'Descargar' : 'Pendiente'; ?>
                                </a>
                            <?php } else { ?>
                                <span class="text-danger">Pendiente</span>
                            <?php
                            } ?>

                        </td>
                        <td class="text-center">
                            <button type="button" class="btn <?= ($d['validacion'] != '1') ? 'btn-danger' : 'btn-success'; ?>"
                                data-toggle="modal" data-target="#modalSubirArchivo" data-area="<?= $d['area'] ?>"
                                data-historial="<?= $d['historial_id'] ?>" data-detalle="<?= $d['detalle_id'] ?>"
                                data-ugel="<?= $d['ugel'] ?>" data-codmodular="<?= $d['codmodular'] ?>"
                                data-grado="<?= $d['grado'] ?>" data-nivel="<?= $d['nivel'] ?>" data-tipo="General">

                                <i class="far fa-check-circle"></i>
                                <?= ($d['validacion'] != '1') ? 'Subir' : 'Actualizar'; ?>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn <?= ($d['validacion'] != '1') ? 'btn-danger' : 'btn-success'; ?>"
                                data-toggle="modal" data-target="#modalValidar" data-area="<?= $d['area'] ?>"
                                data-historial="<?= $d['historial_id'] ?>" data-detalle="<?= $d['detalle_id'] ?>"
                                data-ugel="<?= $d['ugel'] ?>" data-codmodular="<?= $d['codmodular'] ?>"
                                data-grado="<?= $d['grado'] ?>" data-nivel="<?= $d['nivel'] ?>" data-tipo="General">

                                <i class="far fa-check-circle"></i>
                                <?= ($d['validacion'] != '1') ? 'Validar' : 'Validado'; ?>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn <?= ($d['examen2'] != '1') ? 'btn-danger' : 'btn-success'; ?>"
                                data-toggle="modal" data-target="#modalProcesar" data-area="<?= $d['area'] ?>"
                                data-historial="<?= $d['historial_id'] ?>" data-detalle="<?= $d['detalle_id'] ?>"
                                data-ugel="<?= $d['ugel'] ?>" data-codmodular="<?= $d['codmodular'] ?>"
                                data-grado="<?= $d['grado'] ?>" data-nivel="<?= $d['nivel'] ?>" data-tipo="General"
                                <?= ($d['examen'] == '') ? 'disabled' : ''; ?>>

                                <i class="fas fa-tasks"></i>
                                <?= ($d['examen2'] != '1') ? 'Procesar' : 'Procesado'; ?>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn <?= ($d['examen2'] != '1') ? 'btn-danger' : 'btn-success'; ?>"
                                data-toggle="modal" data-target="#modalProcesar" data-area="<?= $d['area'] ?>"
                                data-historial="<?= $d['historial_id'] ?>" data-detalle="<?= $d['detalle_id'] ?>"
                                data-ugel="<?= $d['ugel'] ?>" data-codmodular="<?= $d['codmodular'] ?>"
                                data-grado="<?= $d['grado'] ?>" data-nivel="<?= $d['nivel'] ?>" data-tipo="General"
                                <?= ($d['examen'] == '') ? 'disabled' : ''; ?>>

                                <i class="fas fa-tasks"></i>
                                <?= ($d['examen2'] != '1') ? 'Ver Estadistica' : 'En Proceso'; ?>
                            </button>
                        </td>

                    </tr>
                <?php
            endforeach;
        echo "</tbody></table>";
                ?>
    </div>
</div>

<!-- modales -->
<div class="modal fade" id="modalValidar" tabindex="-1" role="dialog" aria-labelledby="modalValidarLabel"
    aria-hidden="true">


    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-12">
                    Confirmación
                </h5>
            </div>
            <div id="respuestaerrgclave">
                <form id="frmValidar" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Estas seguro de validar este Archivo?</h4>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                Nivel:

                            </div>
                            <div class="col-sm-8">
                                <span id="nombreNivel1"></span>
                                <input hidden type="text" id="idNivel1" name="nivel" value="">
                                <input hidden type="text" id="idCodModular1" name="codmodular" value="">
                                <input hidden type="text" id="idHistorial1" name="historial" value="">
                                <input hidden type="text" id="idDetalle1" name="detalle" value="">
                                <input hidden type="text" id="idTipo1" name="tipo" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Grado:
                            </div>
                            <div class="col-sm-8">
                                <span id="nombreGrado1"></span> Grado
                                <input hidden type="text" id="idGrado1" name="grado" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Área:
                            </div>
                            <div class="col-sm-8">
                                <span id="nombreArea1"></span>
                                <input hidden type="text" id="idArea1" name="area" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                Observacion:
                            </div>
                            <div class="col-sm-12">
                                <span id="nombreObs"></span>
                                <textarea class="form-control" maxlength="200" rows="2" name="obs" id="obs"></textarea>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger validarArchivo"
                            data-accion="rechazar">
                            <span class="spinner-border spinner-border-sm cargando" role="status" aria-hidden="true"></span>
                            Rechazar Archivo
                        </button>
                        <button type="button" class="btn btn-primary validarArchivo"
                            data-accion="validar">
                            <span class="spinner-border spinner-border-sm cargando" role="status" aria-hidden="true"></span>
                            Validar Archivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalProcesar" tabindex="-1" role="dialog" aria-labelledby="modalProcesarLabel"
    aria-hidden="true">


    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-12">
                    Procesar Examen
                </h5>
            </div>
            <div id="respuestaerrgclave">
                <form id="frmProcesar" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Estas seguro de procesar este examen?</h4>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                Nivel:

                            </div>
                            <div class="col-sm-8">
                                <span id="nombreNivel2"></span>
                                <input hidden type="text" id="idNivel2" name="nivel" value="">
                                <input hidden type="text" id="idCodModular2" name="codmodular" value="">
                                <input hidden type="text" id="idHistorial2" name="historial" value="">
                                <input hidden type="text" id="idDetalle2" name="detalle" value="">
                                <input hidden type="text" id="idTipo2" name="tipo" value="">
                                <input hidden type="text" id="idUgel2" name="ugel" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Grado:
                            </div>
                            <div class="col-sm-8">
                                <span id="nombreGrado2"></span> Grado
                                <input hidden type="text" id="idGrado2" name="grado" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                Área:
                            </div>
                            <div class="col-sm-8">
                                <span id="nombreArea2"></span>
                                <input hidden type="text" id="idArea2" name="area" value="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger procesarExamen" data-accion="procesarA">
                            <span class="spinner-border spinner-border-sm cargando" role="status" aria-hidden="true"></span>
                            Procesar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalValidar').on('show.bs.modal', function(event) {
        // Reset the form
        $('#frmValidar')[0].reset();

        var button = $(event.relatedTarget); // Botón que activó el modal
        var row = button.closest('tr'); // Fila que contiene el botón
        let area = button.data('area')
        let nivel = button.data('nivel')
        let grado = button.data('grado')
        let tipo = button.data('tipo')
        let codmodular = button.data('codmodular')
        let historial = button.data('historial')
        let detalle = button.data('detalle')
        // Obtener información de las celdas
        var nombre = row.find('.nombreArea').text();

        // Clear file details
        fileDetails.innerHTML = '';

        // Store the button in modal data
        $('#modalValidar').data('button', button);

        // Recuperar y mostrar información
        $('#idArea1').val(area);
        $('#idNivel1').val(nivel);
        $('#idGrado1').val(grado);
        $('#idCodModular1').val(codmodular);
        $('#idHistorial1').val(historial);
        $('#idTipo1').val(tipo);
        $('#idDetalle1').val(detalle);
        $('#nombreArea1').html(nombre);
        $('#nombreGrado1').html(grado);
        $('#nombreNivel1').html(nivel);
        $('#tipoEvaluacion1').html(tipo);
    });

    $('.validarArchivo').on('click', function() {
        let obj = $(this);
        let accion = obj.data('accion');
        var formData = new FormData($('#frmValidar')[0]);
        $.ajax({
            url: 'views/ugel/validarExamen.php?accion=' + accion,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show();
                $('.cargando').removeClass("cargar");
            },
            success: function(response) {
                if (response === 'Archivo validado y procesado con éxito.') {
                    var button = $('#modalValidar').data('button');
                    button.removeClass('btn-danger').addClass('btn-success').prop('disabled', true);
                }
                $('.loader').hide();
                $('.cargando').addClass("cargar");
                alert(response);
                $('#modalValidar').modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
                alert('Error al subir el archivo: ' + errorThrown);
            }
        });
    });

    $('#modalProcesar').on('show.bs.modal', function(event) {
        // Reset the form
        $('#frmValidar')[0].reset();

        var button = $(event.relatedTarget); // Botón que activó el modal
        var row = button.closest('tr'); // Fila que contiene el botón
        let area = button.data('area')
        let nivel = button.data('nivel')
        let grado = button.data('grado')
        let tipo = button.data('tipo')
        let codmodular = button.data('codmodular')
        let historial = button.data('historial')
        let detalle = button.data('detalle')
        let ugel = button.data('ugel')
        // Obtener información de las celdas
        var nombre = row.find('.nombreArea').text();

        // Clear file details
        fileDetails.innerHTML = '';

        // Store the button in modal data
        $('#modalProcesar').data('button', button);

        // Recuperar y mostrar información
        $('#idArea2').val(area);
        $('#idNivel2').val(nivel);
        $('#idGrado2').val(grado);
        $('#idCodModular2').val(codmodular);
        $('#idHistorial2').val(historial);
        $('#idTipo2').val(tipo);
        $('#idUgel2').val(ugel);
        $('#idDetalle2').val(detalle);
        $('#nombreArea2').html(nombre);
        $('#nombreGrado2').html(grado);
        $('#nombreNivel2').html(nivel);
        $('#tipoEvaluacion2').html(tipo);
    });
    $('.procesarExamen').on('click', function() {
        let obj = $(this);
        let accion = obj.data('accion');
        var formData = new FormData($('#frmProcesar')[0]);
        console.log('Ejecutando...')
        $.ajax({
                url: 'views/ere/procesarExamen.php?accion=' + accion,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader').show();
                    $('.cargando').removeClass("cargar");
                }
            })
            .done(function(response) {
                if (response === 'Examen procesado con éxito.') {
                    var button = $('#modalProcesar').data('button');
                    button.removeClass('btn-danger').addClass('btn-success').prop('disabled', true);
                }
                $('.loader').hide();
                $('.cargando').addClass("cargar");
                alert(response);
                $('#modalProcesar').modal('hide');
            })
            .fail(function(data) {
                alert("error");
                $('.loader').hide();
                $('.cargando').addClass("cargar");
                console.log(data);
            })
            .always(function() {
                console.log('Solicitud finalizada.');
            });

    });
</script>