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
        <link rel='stylesheet' href='css/stylep.css'>
    </head>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nivele').on('change', function() {
                var seleeva = document.getElementById("seleeva").value;
                var niveles = document.getElementById("nivele").value;
                var ruta = "seleeva=" + seleeva + "&niveles=" + niveles;
                if (seleeva) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDatanuvo.php',
                        data: ruta,
                        success: function(html) {
                            $('#cursoe').html(html);
                            $('#gradoe').html('<option value="">Seleccione</option>');;
                        }
                    });
                }
            });


            $('#cursoe').on('change', function() {
                var seleeva = document.getElementById("seleeva").value;
                var niveles = document.getElementById("nivele").value;
                var cursos = document.getElementById("cursoe").value;
                var ruta = "seleeva=" + seleeva + "&niveles=" + niveles+"&cursos=" + cursos;
                if (cursos) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxdatanuevob.php',
                        data: ruta,
                        success: function(html) {
                            $('#gradoe').html(html);
                        }
                    });
                }
            });







        });
        </script>
    

    <body>
        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
     
        
        error_reporting(0);
        ?>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <h6 class="card-header">.:: MATRIZ DE CALIFICACIÓN</h6>
                    <div class="card-body respuestag">
                        <div class="row">
                        <div class="col-3">
                                <select class="form-control" name="seleeva" id="seleeva"><br><br>
                                    <option value="">Seleccione Evaluación</option>
                                    <?php
                                    $Listape = $asistencia->datacompletaevaluacionestado();
                                    while ($Lp = mysqli_fetch_array($Listape)) {
                                    ?>
                                        <option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
                                    <?php }; ?>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Evaluación</small>
                            </div>
                            <div class="col-2">
                                <select id="nivele" class="form-control">
                                    <option value="">Nivel...</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Nivel</small>
                            </div>
                            <div class="col-3">
                                   
                                    <select id="cursoe" class="form-control">
                                        <option value="">Seleccione Area</option>
                                       
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">Area</small>
                                </div>
                       
                            <div class="col-2">
                                <select id="gradoe" class="form-control">
                                    <option value="">Grado...</option>
                                    
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Grado</small>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary enviar" type="button">
                                    <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                    Procesar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><BR>
        <div id="resultaint">
        </div>
        <script>
            $('.enviar').click(function() {
                var nivele = document.getElementById('nivele').value;
                var cursoe = document.getElementById('cursoe').value;
                var gradoe = document.getElementById('gradoe').value;
                var seleeva = document.getElementById('seleeva').value;
                
                if (seleeva == '' || nivele == '' || cursoe == '' || gradoe == '') {
                    if (seleeva == '') {
                        $("#seleeva").focus();
                        $('#seleeva').addClass("color");
                    } else if (nivele == '') {
                        $("#nivele").focus();
                        $('#nivele').addClass("color");
                    }else if (cursoe == '') {
                        $("#cursoe").focus();
                        $('#cursoe').addClass("color");
                    } else {
                        $("#gradoe").focus();
                        $('#gradoe').addClass("color");
                    }
                } else {
                    var ruta = "seleeva=" + seleeva + "&nivele=" + nivele + "&gradoe=" + gradoe + "&cursoe=" + cursoe;
                    $.ajax({
                            url: 'resultadosinformacionm.php',
                            type: 'POST',
                            data: ruta,
                            dataType: 'html',
                            beforeSend: function() {
                                $('.spinner-border').removeClass("cargar");
                            }
                        })
                        .done(function(res) {
                            $('#resultaint').html(res);
                            $('.spinner-border').addClass("cargar");
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