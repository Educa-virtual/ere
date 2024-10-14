    <nav class="navbar navbar-dark navbar-expand-lg "
        style="background-color: #126dc7; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%)">
        <a class="navbar-brand" href="#">
            <img src="imagen/ies.png" width="30" height="30" class="d-inline-block align-top" alt="">
            .:: DREMO ::.
        </a>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active letramenu">
                    <a class="nav-link" href="principal.php"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <?php
                if ($tipo == 'Administrador') { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Evaluación
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="crearevaluacion"><i
                                    class="fab fa-creative-commons-share"></i>
                                Crear Evaluación</a>
                            <a class="dropdown-item xLink" href="#" data-php="vistaevaluacion"><i
                                    class="fas fa-binoculars"></i> Vista
                                Evaluaciones</a>
                            <a class="dropdown-item xLink" href="#" data-php="importardatos"><i
                                    class="fas fa-cloud-upload-alt"></i>
                                Importar Datos</a>
                            <a class="dropdown-item xLink" href="#" data-php="listadopersonalingreso"><i
                                    class="fas fa-users"></i> Vista
                                Usuarios</a>
                            <a class="dropdown-item xLink" href="#" data-php="asistencia"><i class="fas fa-database"></i>
                                Datos</a>
                            <a class="dropdown-item xLink" href="#" data-php="procesarevaluacion"><i
                                    class="fas fa-cogs"></i>
                                Consolidado de Registros</a>
                            <a class="dropdown-item xLink" href="#" data-php="procesarconsolidado"><i
                                    class="fas fa-cogs"></i>
                                Consolidados por Areas</a>
                            <a class="dropdown-item xLink" href="#" data-php="procesartotales"><i class="fas fa-cogs"></i> %
                                de Areas</a>
                            <a class="dropdown-item xLink" href="#" data-php="calculoarea"><i class="fas fa-cogs"></i> Total
                                Estudiantes</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-book"></i> Cuadernillo
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" id="crearcuadernillo"><i
                                    class="fab fa-creative-commons-share"></i> Crear Cuadernillo</a>
                            <a class="dropdown-item" href="#" id="listadocuadernillo"><i
                                    class="fas fa-cloud-upload-alt"></i> Consulta Cuadernillo</a>
                            <a class="dropdown-item xLink" href="#" data-php="views/informes/listaCuadernillo">
                                <i class="fas fa-binoculars"></i>
                                Historial Cuadernillos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Usuarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="informacionpersonal"><i
                                    class="fas fa-user-alt"></i>
                                Registro</a>
                            <a class="dropdown-item xLink" href="#" data-php="listadopersonal"><i
                                    class="fas fa-clipboard-list"></i>
                                Información</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bezier-curve"></i> Matriz
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="crearmatriz"><i
                                    class="fas fa-bezier-curve"></i> Crear
                                Matriz</a>
                            <a class="dropdown-item xLink" href="#" data-php="informacionm"><i
                                    class="fas fa-binoculars"></i> Ver</a>
                            <a class="dropdown-item xLink" href="#" data-php="listadomatriz"><i class="fas fa-list-ol"></i>
                                Listado</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i> Logro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="informacionmindicalogro"><i
                                    class="fas fa-clipboard-list"></i>
                                Crear Indicador</a>
                            <a class="dropdown-item xLink" href="#" data-php="listadologro"><i class="fas fa-list-ol"></i>
                                Listado</a>

                        </div>
                    </li>
                <?php } // FIN if ($tipo == 'Administrador') {
                ?>
                <?php if ($tipo == 'Administrador' or $tipo == 'DREMO' or $tipo == 'UGEL') { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-address-book"></i> Informes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="informacionp">
                                <i class="far fa-file-alt"></i>
                                Respuestas</a>
                            <a class="dropdown-item xLink" href="#" data-php="informacionies">
                                <i class="fas fa-clipboard-check"></i>
                                I.E.</a>
                            <a class="dropdown-item xLink" href="#" data-php="informacionidis">
                                <i class="fas fa-map-marked-alt"></i>
                                Distritos</a>
                            <a class="dropdown-item xLink" href="#" data-php="views/informes/frmRespuestas">
                                <i class="fas fa-map-marked-alt"></i>
                                Respuestas 2024</a>

                            <a class="dropdown-item xLink" href="#" data-php="views/informes/estadisticasSubirArchivos">
                                <i class="fas fa-map-marked-alt"></i>
                                Estad. Suba Archivos</a>
                            <a class="dropdown-item xLinkInfo" href="#" data-php="views/ere/frmProcesarExamen">
                                <i class="fas fa-map-marked-alt"></i>
                                Procesar Exámenes</a>
                            <!-- Nuevo Item -->
                            <a class="dropdown-item xLink" href="#" data-php="views/informes/verParticipacionIE">
                                <i class="fas fa-map-marked-alt"></i>
                                PParticipacion IE</a>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-not-equal"></i> Comparar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="comparar"><i class="far fa-calendar-alt"></i>
                                Por Año</a>
                            <a class="dropdown-item xLink" href="#" data-php="compararperiodo"><i class="fas fa-cogs"></i>
                                Por
                                Evaluación</a>
                        </div>
                    </li>
                <?php } //  FIN if ($tipo == 'Administrador' or $tipo == 'DREMO' or $tipo == 'UGEL') {
                ?>
                <?php if (strtolower($tipo) == 'visitante') { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letramenu" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-address-book"></i> Estadísticas Generales
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item xLink" href="#" data-php="views/informes/frmRespuestasVisitante">
                                <i class="far fa-file-alt"></i>
                                Estadísticas</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="dropdown form-inline my-2 my-lg-0">
                <button class="btn btn-outline-light dropdown-toggle letramenub" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> <?php echo $nombre . " " . $apellidopat . " " . $apellidomat; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php if (strtolower($tipo) != 'visitante') { ?>
                        <a class="dropdown-item cambiarclave" href="#" data-target='#exampleModal'>Contraseña</a>
                    <?php } ?>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Salir</a>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CERRAR SESION </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <a href="Sesioncerrar.php"><i class="fas fa-door-open fa-7x"></i></a>
                            <center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    </div>
                </div>
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