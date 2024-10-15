<?php session_start();
if ($_SESSION["dni"] != '') {
?>
<?php
    require_once "./../../modelo/Ie.php";
    $ie = new Ie;

    $nivel = $_POST['nivele'];
    $ugel = $_POST['ugele'];
    $evaluacion = $_POST['evaluacion'];

    $data = $ie->getIesParticipan($nivel, $ugel, $evaluacion);

    ?>
<div class="alert alert-warning alert-dismissible fade show" id="warningAlertfila"
    style="position: fixed; top: 20px; right: 20px; z-index: 1050; display: none;" role="alert">
    <strong>¡Advertencia!</strong> Por favor, selecciona al menos una fila.
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="card me-4">
                <h6 class="card-header d-flex justify-content-between align-items-center">
                    <span>IES PARTICIPAN (<span class="text-primary font-weight-bold"
                            id="iesParticipanCount"><?= $data['totalParticipan'] ?></span>)</span>
                    <!-- buscador -->
                    <div class="mb-3" style="width: 220px;">
                        <label for="searchCodModular" class="form-label">Buscar por Código Modular:</label>
                        <input type="text" class="form-control" id="searchCodModular"
                            placeholder="Ingrese el Código Modular">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button" onclick="almacenarDatos()">
                            <span class="spinner-border spinner-border-sm cargar" role="status"
                                aria-hidden="true"></span>
                            Almacenar
                        </button>
                    </div>
                </h6>
                <div class="card-body">
                    <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered" style="font-size: 13px;" id="iesParticipanTable">
                                <thead>
                                    <tr>
                                        <th><input type='checkbox' id='select-all-participan'
                                                onchange="toggleCheckboxes(this, 'iesParticipanTable')"></th>
                                        <th>#</th>
                                        <th>CODIGO MODULAR</th>
                                        <th>DESCRIPCION</th>
                                        <th>DISTRITO</th>
                                        <th>NIVEL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                if (is_array($data['iesParticipan'])) {
                                    $i = 1;
                                    foreach ($data['iesParticipan'] as $ie) : ?>
                                    <tr>
                                        <td class="col-xs-2">
                                            <input type='checkbox' class='select-row'
                                                data-codmodular="<?= htmlspecialchars($ie['codmodular']) ?>">
                                        </td>
                                        <td class="row-number"><?= $i++ ?></td>
                                        <td><?= $ie['codmodular'] ?> </td>
                                        <td><?= $ie['descripcion'] ?></td>
                                        <td><?= $ie['distrito'] ?></td>
                                        <td><?= $ie['nivel'] ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center" style="margin-top:100px">
            <div class="row">
                <div class="col-md">
                    <button class="btn btn-success btn-lg" type="button" style="width: 100%;"
                        onclick="copiarDatosR()">
                        <span class="fw-bold">
                            << Agregar</span>
                    </button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">

                    <button class="btn btn-danger btn-lg" style="width: 100%;" type="button"
                        onclick="copiarDatos()">
                        <span class="fw-bold">Retirar >></span>
                    </button>
                </div>
            </div>
            
            
        </div>
        <div class="col-md-5">
            <div class="card me-4">
                <h6 class="card-header d-flex justify-content-between align-items-center">
                    <!-- Texto del encabezado -->
                    <span>IES que no participan (<span class="text-danger font-weight-bold"
                            id="iesNoParticipanCount"><?= $data['totalNoParticipan'] ?></span>)</span>
                    <!-- Formulario de búsqueda -->
                    <div class="mb-3 ms-auto">
                        <label for="searchCodModularNoParticipan" class="form-label" style="margin-right: 10px;">Buscar
                            por Código Modular:</label>
                        <input type="text" class="form-control" id="searchCodModularNoParticipan"
                            placeholder="Ingrese el Código Modular">
                    </div>
                </h6>
                <div class="card-body">
                    <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered" id="iesNoParticipanTable" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all-no-participan"
                                                onchange="toggleCheckboxesdos(this, 'iesNoParticipanTable')"></th>
                                        <th>#</th>
                                        <th>CODIGO MODULAR</th>
                                        <th>DESCRIPCION</th>
                                        <th>DISTRITO</th>
                                        <th>NIVEL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                if (is_array($data['iesNoParticipan'])) {
                                    $i = 1;
                                    foreach ($data['iesNoParticipan'] as $ie) : ?>
                                    <tr>
                                        <td><input type='checkbox' class='select-row'
                                                data-codmodular="<?= htmlspecialchars($ie['codmodular']) ?>"></td>
                                        <td class="row-number"><?= $i++ ?></td>
                                        <td><?= $ie['codmodular'] ?> </td>
                                        <td><?= $ie['descripcion'] ?></td>
                                        <td><?= $ie['distrito'] ?></td>
                                        <td><?= $ie['nivel'] ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>"; // Mensaje si no hay datos
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<br>
<script>
function almacenarDatos() {
    const selectedRows = [];
    const evaluacion = $("#evaluacion").val();
    if (!evaluacion) {
        alert("Por favor, selecciona una evaluación.");
        return;
    }
    $('.select-row:checked').each(function() {
        const row = $(this).closest('tr');
        const cod_modular = $(this).data('codmodular');
        const nivel = row.find('td:eq(5)').text().trim();
        selectedRows.push({
            cod_modular: cod_modular,
            nivel: nivel,
            evaluacion: evaluacion
        });
    });
    if (selectedRows.length === 0) {
        // alert("Por favor, selecciona al menos una fila.");
        // return;
        $('#warningAlertfila').fadeIn().delay(3000).fadeOut();
        return;
    }
    $.each(selectedRows, function(index, item) {    // Por cada Codigo Modular
        const formData = new FormData();
        formData.append('nivel', item.nivel);
        formData.append('cod_modular', item.cod_modular);
        formData.append('evaluacion', item.evaluacion);
        $.ajax({
                type: "POST",
                url: "views/informes/insertar.php",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner-border').removeClass("cargar");
                }
            })
            .fail(function(xhr, status, error) {
                alert("Error al almacenar los datos: " + error);
            })
            .always(function() {
                $('.spinner-border').addClass("cargar");
            });
    });
}

function toggleCheckboxes(source, tableId) {
    const checkboxes = document.querySelectorAll(`#${tableId} .select-row`);
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

function toggleCheckboxesdos(source, tableId) {
    const checkboxes = document.querySelectorAll(`#${tableId} .select-row`);
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

function copiarDatos() {
    const tableParticipan = document.getElementById('iesParticipanTable');
    const tableNoParticipan = document.getElementById('iesNoParticipanTable');
    const checkboxesParticipan = tableParticipan.querySelectorAll('.select-row:checked');
    checkboxesParticipan.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        const newRow = row.cloneNode(true);
        tableNoParticipan.querySelector('tbody').appendChild(newRow);
        const newRowCheckbox = newRow.querySelector('.select-row');
        if (newRowCheckbox) {
            newRowCheckbox.checked = false;
        }
        const cod_modular = checkbox.dataset.codmodular;
        $.ajax({
            type: "POST",
            url: "views/informes/eliminar.php",
            data: {
                cod_modular: cod_modular
            },
            success: function(response) {},
            error: function(xhr, status, error) {
                alert("Error al eliminar el dato: " + error);
            }
        });
        row.remove();
    });
    const selectAllParticipan = document.getElementById('select-all-participan');
    if (selectAllParticipan.checked) {
        selectAllParticipan.checked = false;
    }
    actualizarNumeracion(tableNoParticipan);
    actualizarConteos();
}

function copiarDatosR() {
    const tableParticipan = document.getElementById('iesParticipanTable');
    const tableNoParticipan = document.getElementById('iesNoParticipanTable');
    const checkboxesNoParticipan = tableNoParticipan.querySelectorAll('.select-row:checked');
    checkboxesNoParticipan.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        const newRow = row.cloneNode(true);
        tableParticipan.querySelector('tbody').appendChild(newRow);
        const newRowCheckbox = newRow.querySelector('.select-row');
        if (newRowCheckbox) {
            newRowCheckbox.checked = false;
        }
        checkbox.checked = false;
    });
    checkboxesNoParticipan.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        row.remove();
    });
    const selectAllNoParticipan = document.getElementById('select-all-no-participan');
    if (selectAllNoParticipan.checked) {
        selectAllNoParticipan.checked = false;
    }
    actualizarNumeracion(tableParticipan);
    actualizarConteos();
}

function actualizarConteos() {
    const countParticipan = document.getElementById('iesParticipanCount');
    const rowCountParticipan = document.querySelectorAll('#iesParticipanTable tbody tr').length;
    countParticipan.textContent = rowCountParticipan;
    const countNoParticipan = document.getElementById('iesNoParticipanCount');
    const rowCountNoParticipan = document.querySelectorAll('#iesNoParticipanTable tbody tr').length;
    countNoParticipan.textContent = rowCountNoParticipan;
}

function actualizarNumeracion(table) {
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        const numberCell = row.querySelector('.row-number');
        if (numberCell) {
            numberCell.textContent = index + 1;
        }
    });
}
document.getElementById('searchCodModular').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#iesParticipanTable tbody tr');
    rows.forEach(row => {
        const codModularCell = row.cells[2];
        if (codModularCell) {
            const codModular = codModularCell.textContent || codModularCell.innerText;
            if (codModular.toLowerCase().includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
document.getElementById('searchCodModularNoParticipan').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#iesNoParticipanTable tbody tr');
    rows.forEach(row => {
        const codModularCell = row.cells[2];
        if (codModularCell) {
            const codModular = codModularCell.textContent || codModularCell.innerText;
            if (codModular.toLowerCase().includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    actualizarConteos();
});
</script>
<?php
} else {
    header("location:index.php");
}
?>