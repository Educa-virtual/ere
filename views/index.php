
<div id="homePrincipal" style="background-image: url('imagen/fondo.jpg'); background-repeat: repeat-x;">
    <!-- Main Container -->
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
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
    
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
-->

    </div>
