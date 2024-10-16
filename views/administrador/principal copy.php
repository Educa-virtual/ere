<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Descargas importantes</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="2024i/ManualAplicativodeEscritorio.pdf">
                                <div class="alert alert-info" role="alert">
                                    Manual Aplicativo <i class="fas fa-file-pdf"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="2024i/aplicacion2024i/PlantillaPreERE2024.xlsx">
                                <div class="alert alert-info" role="alert">
                                    Plantilla para Pre-Registro de Datos <i class="fas fa-file-excel"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">

            <h3 class="text-center">NIVEL PRIMARIA</h3>

            <div class="accordion" id="accordionPanelsStayOpenExample">
                <?php $i=0;
                    foreach ($primaria as $valor) : 
                        $i++;
                    ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button text-center text-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panel-collapse<?=$i?>" aria-expanded="true"
                            aria-controls="panel-collapse<?=$i?>">
                            <?=Helper::getOrdinal($valor['grado'])?> Grado
                        </button>


                    </h2>
                    <div id="panel-collapse<?=$i?>" class="accordion-collapse collapse <?=($i==1)?'show':''?>">
                        <div class="accordion-body">
                            <table class="table table-responsive table-striped table-hover">
                                <thead>
                                    <tr class="tablatitulo">
                                        <th scope="col">N°</th>
                                        <th scope="col">ÁREA</th>
                                        <th scope="col">DESCARGAR</th>
                                    </tr>
                                </thead>
                                <tbody class="areasarchivo">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Matemática</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-pdf"></i> Matriz</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-pdf"></i> Cuadernillo</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-excel"></i> Aplicacion</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-signature"></i> Respuestas</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>
                                            Desarrollo Personal, Ciudadanía y Cívica

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Matriz</a></li>
                                                    <li><a class="dropdown-item" href="#">Cuadernillo</a></li>
                                                    <li><a class="dropdown-item" href="#">Aplicacion</a></li>
                                                    <li><a class="dropdown-item" href="#">Respuestas</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>
                                            Comunicación

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Matriz</a></li>
                                                    <li><a class="dropdown-item" href="#">Cuadernillo</a></li>
                                                    <li><a class="dropdown-item" href="#">Aplicacion</a></li>
                                                    <li><a class="dropdown-item" href="#">Respuestas</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

        </div>
        <div class="col-sm-6">



            <h3 class="text-center">NIVEL SECUNDARIA</h3>

            <div class="accordion" id="accordionPanelsStayOpenSecundaria">
                <?php $i=0;
                    foreach ($secundaria as $valor) : 
                        $i++;
                    ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panel-collapse-s<?=$i?>" aria-expanded="true"
                            aria-controls="panel-collapse-s<?=$i?>">
                            <?=Helper::getOrdinal($valor['grado'])?> Grado
                        </button>


                    </h2>
                    <div id="panel-collapse-s<?=$i?>" class="accordion-collapse collapse <?=($i==1)?'show':''?>">
                        <div class="accordion-body">
                            <table class="table table-responsive table-striped table-hover">
                                <thead>
                                    <tr class="tablatitulo">
                                        <th scope="col">N°</th>
                                        <th scope="col">ÁREA</th>
                                        <th scope="col">DESCARGAR</th>
                                    </tr>
                                </thead>
                                <tbody class="areasarchivo">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Matemática</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-pdf"></i> Matriz</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-pdf"></i> Cuadernillo</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-excel"></i> Aplicacion</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-file-signature"></i> Respuestas</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>
                                            Desarrollo Personal, Ciudadanía y Cívica

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Matriz</a></li>
                                                    <li><a class="dropdown-item" href="#">Cuadernillo</a></li>
                                                    <li><a class="dropdown-item" href="#">Aplicacion</a></li>
                                                    <li><a class="dropdown-item" href="#">Respuestas</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>
                                            Comunicación

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Matriz</a></li>
                                                    <li><a class="dropdown-item" href="#">Cuadernillo</a></li>
                                                    <li><a class="dropdown-item" href="#">Aplicacion</a></li>
                                                    <li><a class="dropdown-item" href="#">Respuestas</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

        </div>
    </div>
</div>