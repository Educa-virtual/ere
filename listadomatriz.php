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
        <link rel='stylesheet' href='css/disenooptimizado.css'>

       
    </head>

    <body>

        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;
  

        error_reporting(0);
        ?>

        <br>




        <div class="row">
            <div class="col-sm-12 col-md-12">

                <div class="card col-md-6 mx-auto">
                    <h6 class="card-header">.:: MATRIZ DE CALIFICACIÓN</h6>
                    <div class="card-body respuestag">

                        <div class="row">


                            <div class="col-8">
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

                            <div class="col-4">
                                <button class="btn btn-primary enviard" type="button">
                                    <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                                    Procesar
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><BR>

        <div id="resultainte">

        </div>



        <script>
            $('.enviard').click(function() {    
                var seleeva = document.getElementById('seleeva').value;
                if (seleeva == '') {
                        $("#seleeva").focus();
                        $('#seleeva').addClass("color");
                } else {
                    var ruta = "seleeva=" + seleeva;
                    $.ajax({
                            url: 'resultadosinformacionmlistado.php',
                            type: 'POST',
                            data: ruta,
                            dataType: 'html',
                            beforeSend: function() {
                                $('.spinner-border').removeClass("cargar");
                            }
                        })
                        .done(function(res) {
                            $('#resultainte').html(res);
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