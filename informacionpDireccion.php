<?php session_start();

if ($_SESSION["dni"] != '') {

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/disenooptimizado.css">



    </head>
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

                    } else {
                        $('#ugel').html('<option value="">Seleccione...</option><option value="sanig">San Ignacio de Loyola</option>');
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




    <body>
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



        $datosies = $_POST['idenvi'];
        $datodesc = $_POST['iesdes'];

        


        error_reporting(0);

        $Listapew = $asistencia->datacomplementodetalle($iddetalle);
        while ($Lp = mysqli_fetch_array($Listapew)) {
            $privilegios = $Lp['ugel'];
        }
        ?>

        <input type="hidden" value="<?php echo $tipo; ?>" id="eval">
        <input type="hidden" value="<?php echo $privilegios; ?>" id="privi">


        <input type="hidden" value="<?php echo $datosies; ?>" id="ie">

        <input type="hidden" value="" id="ugel">
        <input type="hidden" value="" id="distrito">
        <input type="hidden" value="" id="gestion">
        <input type="hidden" value="" id="zona">




        <br>
        <div class="container-fluid">
            <div class="card">
                <h6 class="card-header">
            
                <div class="row">
                        <div class="col-5">
                        <B>.:: <i class="fas fa-chalkboard-teacher"></i><?php echo " I.E. ".$datosies ." | ".$datodesc;?></B> 
                        </div>
                        <div class="col-7">
                        <select class="form-control form-control-sm" id="evaluaci">
									<option value="134" selected>...</option>
									<?php
									$Listape = $asistencia->datacompletaevaluacion();
									while ($Lp = mysqli_fetch_array($Listape)) {
									?>
										<option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
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
                        <div class="col-2">
                            <small id="emailHelp" class="form-text text-muted">Seccion</small>
                            <select id="seccion" class="form-control form-control-sm">
                                <option value="">Seccion...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                                <option value="K">K</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
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
                        <div class="col-2">
                            <br>
                            <button class="btn btn-primary enviar" type="button" id="btn">
                                <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                Procesar
                            </button>
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
                                $('.spinner-border').removeClass("carga");
                            }
                        })
                        .done(function(res) {
                            $('.resultainf').html(res);
                            $('.spinner-border').addClass("carga");
                        })
                }
            });
        </script>

    </body>

    </html>
<?php

} else {

    header("location:index.php");
}

?>