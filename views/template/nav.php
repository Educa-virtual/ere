<nav class="navbar navbar-dark navbar-expand-lg px-2"
    style="background-color: #126dc7; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%)">
    <a class="navbar-brand" href="?">
        <img src="./assets/img/logos/logoDRE_blanco.png" height="30" class="d-inline-block align-top" alt="">
        .:: DREMO ::.
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-menu" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if ($_SESSION['descripcionTipo'] == 'Administrador') : ?>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-cog"></i> Evaluación
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="crearEvaluacion">
                            <i class="fab fa-creative-commons-share"></i>
                            Crear Evaluación</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="vistaEvaluacion">
                            <i class="fas fa-binoculars"></i> Vista
                            Evaluaciones</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="importarEvaluacion">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Importar Datos</a>

                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="datosEvaluacion">
                            <i class="fas fa-database"></i> Datos</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="consolidadoEvaluacion">
                            <i class="fas fa-cogs"></i>
                            Consolidado de Registros</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="consolidadoXAreasEvaluacion">
                            <i class="fas fa-cogs"></i>
                            Consolidados por Areas</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="porcXAreasEvaluacion">
                            <i class="fas fa-cogs"></i> % de Areas</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlEvaluacion"
                            data-accion="totalEstudiantesEvaluacion">
                            <i class="fas fa-cogs"></i> Total
                            Estudiantes</a>
                    </ul>
                </div>
            </li>

            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-cog"></i> Cuadernillo
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlCuadernillo"
                            data-accion="crearCuadernillo"><i class="fab fa-creative-commons-share"></i> Crear
                            Cuadernillo</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlCuadernillo"
                            data-accion="consultaCuadernillo"><i class="fas fa-cloud-upload-alt"></i> Consulta
                            Cuadernillo</a>
                    </ul>
                </div>

            </li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-user"></i> Usuarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlUsuario" data-accion="registroUsuario">
                            <i class="fas fa-user-alt"></i>
                            Registro</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlUsuario"
                            data-accion="informacionUsuario">
                            <i class="fas fa-clipboard-list"></i>
                            Información</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlUsuario" data-accion="vistaUsuarios">
                            <i class="fas fa-users"></i> Vista Usuarios</a>

                    </div>
            </li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-bezier-curve"></i> Matriz
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlMatriz" data-accion="crearMatriz">
                            <i class="fas fa-bezier-curve"></i>
                            Crear Matriz</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlMatriz" data-accion="verMatriz">
                            <i class="fas fa-binoculars"></i> Ver</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlMatriz" data-accion="listadoMatriz">><i
                                class="fas fa-list-ol"></i> Listado</a>
                    </div>
            </li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i> Logro
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlLogro" data-accion="crearIndicador">
                            <i class="fas fa-clipboard-list"></i>
                            Crear Indicador</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlLogro" data-accion="listadoLogro">
                            <i class="fas fa-list-ol"></i> Listado</a>

                    </div>
            </li>
            <?php endif; ?>
            <?php if ($_SESSION['descripcionTipo'] == 'Administrador' or $_SESSION['descripcionTipo'] == 'DREMO' or $_SESSION['descripcionTipo'] == 'UGEL') : ?>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="far fa-address-book"></i> Informes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlInforme" data-accion="respuestasInforme">
                            <i class="far fa-file-alt"></i>
                            Respuestas</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlInforme" data-accion="ieInforme">
                            <i class="fas fa-clipboard-check"></i> I.E.</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlInforme" data-accion="distritosInforme">
                            <i class="fas fa-map-marked-alt"></i>
                            Distritos</a>
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlInforme" data-accion="iieeFaltantes">
                            <i class="fas fa-map-marked-alt"></i>
                            IIEE Faltantes</a>
                    </div>
            </li>

            <li class="nav-item dropdown">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle letramenu" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-not-equal"></i> Comparar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlComparar" data-accion="compararXAnio">
                            <i class="far fa-calendar-alt"></i> Por Año</a>
                            <hr class="dropdown-divider">
                        <a class="dropdown-item xLink" href="#" data-ctrl="CtrlComparar" data-accion="compararXEvaluacion">
                            <i class="fas fa-cogs"></i> Por Evaluación</a>
                    </div>
            </li>
            <?php endif ; ?>
            
        </ul>
        <div class="dropdown d-flex justify-content-end text-usuario">
            <button class="btn btn-outline-light dropdown-toggle letramenub" 
             type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user"></i> <?=$_SESSION['fullName']; ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item cambiarclave" href="#" data-target='#exampleModal'>Contraseña</a>
                    <a class="dropdown-item" href="?ctrl=CtrlUsuario&accion=cerrarSesion">Salir</a>
                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Salir</a> -->
                </li>
            </ul>
        </div>
    </div>

    <div class="modal fade" id="cambiarclave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modeldi">
                    <h5 class="modal-title col-12">
                        Cambiar Contraseña
                    </h5>
                </div>
                <div id="respuestaerrgclave">
                    <form name="formulario-clavenueva" id="formulario-clavenueva" enctype="multipart/form-data"
                        method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="claveanterior">Contraseña Anterior:</label>
                                <input type="password" class="form-control" id="claveanterior" name="claveanterior">
                            </div>
                            <div class="form-group">
                                <label for="nuactuclave">Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="nuactuclave" name="nuactuclave">
                            </div>
                            <div class="form-group">
                                <label for="renuactuclave">Repita Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="renuactuclave" name="renuactuclave">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="enviar"
                                onclick="actualizar_clave()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</nav>