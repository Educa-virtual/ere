<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.::GREMO::.</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/styleprueba.css">
    <link rel="stylesheet" href="css/disenooptimizado.css">
</head>
<!-- Nota: informes ver en que mejorar
 tabla de examen de institucion
 que institucion van a particiar desde el examne ie examen ies
 fecha de vencimiento conectarlo con la base de datos: 
 -->

<body style="background-image: url('imagen/fondo.jpg'); background-repeat: repeat-x;">
    <!-- partial:index.partial.html -->
<div id="homePrincipal" style="background-image: url('imagen/fondo.jpg'); background-repeat: repeat-x;>
    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!-- Login Container -->
        <div class="row border rounded-5 bg-white shadow box-area">
            <!-- Left Box -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box ">
                <div class="featured-image mb-3 d-none d-md-block d-print-block">
                    <img src="imagen/ies.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-black fs-5 text-center d-none d-md-block d-print-block " style="font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; font-weight: 500; font-size: 20px; height:59px; width:249px; margin: 0 0 16px 0; line-height:24px">Dirección Regional de Educación Moquegua</p>
                <h6 class="company_title text-center d-none d-md-block d-print-block" style="font-size: 18px;">
                    <p>Versión 6.0.0</p>
                    <p>
                        <a href="./ere5">
                            ERE-Inicio (Ver 5.0)
                        </a>
                    </p>
                </h6>
            </div>
            <!-- Right Box -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <img src="imagen/logo.png" class="img-fluid img-responsive logo" width="120px" height="116px" alt="Logo">
                        <img src="imagen/ies.png" class="img-fluid img-responsive d-none ies" width="120px" height="116px" alt="IES">
                        <h5>EVALUACIÓN REGIONAL DE ESTUDIANTES<BR> 2024</h5>
                    </div>
                    <!-- formulario login -->
                    <form control="" class="form-group">
                        <div class="row">
                            <input type="text" name="usuario" id="username" class="form__input" placeholder="Usuario">
                        </div>
                        <div class="row"> <!-- <span class="fa fa-lock"></span> -->
                            <input type="password" name="clave" id="password" class="form__input mid" placeholder="Contraseña">
                        </div>
                        <div class="row"> <!-- <span class="fa fa-lock"></span> -->
                            <select class="form__input mid" name="evaluacion" id="">
                                <option value="0">Selecciona una Evaluación</option>
                                <?php 
                                foreach ($evaluaciones as $e): ?>
                                    <option value="<?=$e['tabla']; ?>"><?=$e['descripcion'];?></option>
                                <?php
                                endforeach; ?>
                               
                            </select>
                        </div>

                        <button class="btn btn-primary" type="button" id="btn">
                            <span class="spinner-border spinner-border-sm cargar" role="status" aria-hidden="true"></span>
                            Ingresar...
                        </button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <h6>Ingresa como visitante:</h6>
                        <small>
                            <b class="text-bold"> Usuario:</b> visitante<br>
                            <b>Contraseña:</b> 1234
                        </small>
                    </div>
                    <div class="col-sm-4">
                        <div>
                            <span class="stat-count text-center"><?php echo $cont; ?></span>
                            <p class="stat-detail">Visitantes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="respuesta">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        $('#btn').click(function() {
            var dnis = $('#username').val();
            var claves = $('#password').val();
            var ruta = "dni=" + dnis + "&clav=" + claves;
            // console.log(claves)
            if (dnis == '') {
                $('#username').focus();
                $('#username').css("background-color", "#ffe7e7");
            } else if (claves == '') {
                $('#password').focus();
                $('#password').css("background-color", "#ffe7e7");
            } else {
                // console.log(claves)
                $.ajax({
                        url: '?ctrl=CtrlUsuario&accion=validar',
                        type: 'POST',
                        
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('.spinner-border').removeClass("cargar");
                        }
                    })
                    .done(function(res) {
                       console.log(res)
                        $('#homePrincipal').html(res);
                        $('.spinner-border').addClass("cargar");
                    })
            }
        });
        
    </script>
    </div>
</body>

</html>