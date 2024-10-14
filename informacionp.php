<?php session_start();

if ($_SESSION["dni"] != '') {

?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#ugel').on('change', function() {
                var ugelID = document.getElementById("ugel").value;
                var ruta = "ugelID=" + ugelID;
                if (ugelID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDataR.php',
                        data: ruta,
                        success: function(html) {
                            $('#distrito').html(html);
                            $('#ie').html('<option value="">Seleccione</option>');
                        }
                    });
                } else {
                    $('#distrito').html('<option value="">Seleccione...</option>');

                }
            });

            $('#distrito').on('change', function() {
                var distritoID = document.getElementById("distrito").value;
                var nivelID = document.getElementById("nivel").value;
                var ruta = "distritoID=" + distritoID + "&nivelID=" + nivelID;
                if (distritoID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDataRa.php',
                        data: ruta,
                        success: function(html) {
                            $('#ie').html(html);
                        }
                    });
                } else {
                    $('#ie').html('<option value="">Seleccione...</option>');
                }

            });


            $('#nivel').on('change', function() {
                var evalID = document.getElementById("eval").value;
                var priviID = document.getElementById("privi").value;
                var nivelID = document.getElementById("nivel").value;
                if (evalID == "UGEL") {
                    if (priviID == "mn") {
                        $('#ugel').html('<option value="">Seleccione...</option><option value="mn">Mariscal Nieto</option>');
                    } else if (priviID == "gsc") {
                        $('#ugel').html('<option value="">Seleccione...</option><option value="gsc">General Sánchez Cerro</option>');
                    } else if (priviID == "ilo") {
                        $('#ugel').html('<option value="">Seleccione...</option><option value="ilo">Ilo</option>');

                    } else if (priviID == "sanig") {
                        $('#ugel').html('<option value="">Seleccione...</option><option value="sanig">San Ignacio de Loyola</option>');

                    } else {
                        $('#ugel').html('<option value="">No hay Asignación</option>');
                    }

                } else {
                    $('#ugel').html('<option value="">Seleccione...</option><option value="gsc">General Sánchez Cerro</option><option value="mn">Mariscal Nieto</option><option value="ilo">Ilo</option><option value="sanig">San Ignacio de Loyola</option>');
                    $('#ie').html('<option value="">Seleccione...</option>');
                    $('#distrito').html('<option value="">Seleccione...</option>');
                }

                var ruta = "nivelID=" + nivelID;
                if (nivelID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDataRagrado.php',
                        data: ruta,
                        success: function(html) {
                            $('#grado').html(html);
                        }
                    });
                } else {
                    $('#grado').html('<option value="">Seleccione...</option>');
                }
            });
        });
    </script>




<?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;


        $dni = $_SESSION['dni'];
        $nombre = $_SESSION['nombres'];
        $apellidomat =  $_SESSION['apellidopat'];
        $apellidopat = $_SESSION['apellidomat'];
        
        $tipo = $_SESSION['destipo'];
        $idtipo = $_SESSION['idtipo'];
        $iddetalle = $_SESSION['iddetalleus'];

        error_reporting(0);

        $Listapew = $asistencia->datacomplementodetalle($iddetalle);
        while ($Lp = mysqli_fetch_array($Listapew)) {
            $privilegios = $Lp['ugel'];
        }

        ?>

        <input type="hidden" value="<?php echo $tipo; ?>" id="eval">
        <input type="hidden" value="<?php echo $privilegios; ?>" id="privi">
        

        <br>
        <div class="container-fluid">

        
            <div class="card">
                <h6 class="card-header">
                <div class="row">
                        <div class="col-2">
                        <B>.:: <i class="far fa-file-alt"></i> EVALUACIÓN</B> 
                        </div>
                        <div class="col-10">
                        <select class="form-control form-control-sm" id="evaluaci">
						<?php
									$Listape = $asistencia->datacompletaevaluacion();
									while ($Lp = mysqli_fetch_array($Listape)) {
									?>
										<option value="<?php echo $Lp['tabla']; ?>" selected="selected">
                                            <?php echo $Lp['descripcion'];  ?>
                                        </option>
									<?php }; ?>
								</select>
                        </div>
                </div>
                </h6>
                <div class="card-body respuestag">
                    <div class="row">
                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Area</small>
                            <select id="curso" class="form-control form-control-sm">
                                <option value="">Area...</option>
                                <option value="comlec">Comunicación</option>
                                <option value="ciensoc">Ciencias Sociales</option>
                                <option value="cientec">Ciencia y Tecnología</option>
                                <option value="dpcc">DPCC</option>
                                <option value="mat">Matematica</option>
                                <option value="persoc">Personal Social</option>
                            </select>
                        </div>

                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Nivel</small>
                            <select id="nivel" class="form-control form-control-sm">
                                <option value="">Nivel...</option>
                                <option value="PRIMARIA">Primaria</option>
                                <option value="SECUNDARIA">Secundaria</option>
                            </select>
                        </div>


                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Grado</small>
                            <select id="grado" class="form-control form-control-sm">
                                <option value="">Seleccione...</option>

                            </select>
                        </div>

                        <div class="col-2 ">
                            <small id="emailHelp" class="form-text text-muted">Unidad de Gestion Educativa</small>
                            <select id="ugel" class="form-control form-control-sm">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>

                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Distrito</small>
                            <select id="distrito" class="form-control form-control-sm">
                                <option value="">Distrito...</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <br>
                            <?php
                            $disabled = '';
                            if (!($privilegios  != '' or $idtipo ='Administrador' or $idtipo ='DREMO')) {
                            ?>
                                $disabled = 'disabled';
                            <?php } ?>

                            <button class="btn btn-primary enviar" type="button" id="btn" <?=$disabled?>>
                                    <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true">
                                    </span>
                                    Procesar
                                </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">I.E.</small>
                            <select id="ie" class="form-control form-control-sm">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Gestión</small>
                            <select id="gestion" class="form-control form-control-sm">
                                <option value="">Gestión...</option>
                                <option value="Privada">Privada</option>
                                <option value="Pública">Pública</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Zona</small>
                            <select id="zona" class="form-control form-control-sm">
                                <option value="">Zona...</option>
                                <option value="Urbano">Urbano</option>
                                <option value="Rural">Rural</option>
                            </select>
                        </div>


                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Sección</small>
                            <select id="seccion" class="form-control form-control-sm">
                                <option value="">Seccion...</option>
                                <?php
                                $letras = range('A', 'N');
                                // Recorrer el array usando un bucle foreach
                                foreach ($letras as $letra) {
                                    echo "<option value='$letra'>$letra</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Sexo</small>
                            <select id="sexo" class="form-control form-control-sm">
                                <option value="">Sexo...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-12">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"><i class="fas fa-binoculars"></i> Ver : </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" checked>
                                <label class="form-check-label" for="inlineCheckbox1">Detalle</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="2" checked>
                                <label class="form-check-label" for="inlineCheckbox2">Consolidado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="3" checked>
                                <label class="form-check-label" for="inlineCheckbox2">Consolidado por Indicadores</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="resultainf">

            </div>

        </div>
        <script>
            $('.enviar').click(function() {
                var ugel = document.getElementById('ugel').value;
                var gestion = document.getElementById('gestion').value;
                var zona = document.getElementById('zona').value;
                var distrito = document.getElementById('distrito').value;
                var sexo = document.getElementById('sexo').value;
                var nivel = document.getElementById('nivel').value;
                var curso = document.getElementById('curso').value;
                var grado = document.getElementById('grado').value;
                var seccion = document.getElementById('seccion').value;
                var ie = document.getElementById('ie').value;
                var evaluaci = document.getElementById('evaluaci').value;
                var estaSeleccionadoa = $('#inlineCheckbox1').is(":checked");
                var estaSeleccionadob = $('#inlineCheckbox2').is(":checked");
                var estaSeleccionadoc = $('#inlineCheckbox3').is(":checked");
                if (nivel == '' || curso == '' || grado == '') {
                    if (curso == '') {
                        $("#curso").focus();
                        $('#curso').addClass("color");
                    } else if (nivel == '') {
                        $("#nivel").focus();
                        $('#nivel').addClass("color");
                    } else {
                        $("#grado").focus();
                        $('#grado').addClass("color");
                    }
                } else {

                    if (estaSeleccionadoa == true) {
                        var seleca = 'a';
                    } else {
                        var seleca = '';
                    }
                    if (estaSeleccionadob == true) {
                        var selecb = 'b';
                    } else {
                        var selecb = '';
                    }

                    if (estaSeleccionadoc == true) {
                        var selecc = 'c';
                    } else {
                        var selecc = '';
                    }

                    var ruta = "gestion=" + gestion + "&nivel=" + nivel + "&grado=" + grado + "&curso=" + curso + "&ugel=" + ugel + "&gestion=" + gestion + "&zona=" + zona + "&distrito=" + distrito + "&sexo=" + sexo + "&seccion=" + seccion + "&ie=" + ie + "&evaluaci=" + evaluaci + "&seleca=" + seleca + "&selecb=" + selecb + "&selecc=" + selecc;
                    $.ajax({
                            url: 'resultadosinformacionactual.php',
                            type: 'POST',
                            data: ruta,
                            dataType: 'html',
                            beforeSend: function() {
                                $('.loadert').removeClass("animacion");
                                $('.spinner-border').removeClass("cargar");
                            }
                        })
                        .done(function(res) {
                            $('.resultainf').html(res);
                            $('.spinner-border').addClass("cargar");
                        })
                }
            });
        </script>

<?php

} else {

    header("location:index.php");
}

?>