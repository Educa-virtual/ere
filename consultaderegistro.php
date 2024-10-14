<?php
require_once "cAdmision.php";
$claseAulaV = new cAdmision;



$iddetalleusmo = $_POST['valor1'];


?>


<table class="table table-striped">
    <thead>
        <tr class="tablatitulo">
            <th scope="col">#</th>
            <th scope="col">UGEL</th>
            <th scope="col">CODIGO MODULAR</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">NIVEL</th>
            <th scope="col">GRADO</th>
            <th scope="col">SECCION</th>
            <th scope="col">OPCIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cond = 0;
        $Lstz = $claseAulaV->mostracomplemente($iddetalleusmo);
        while ($Lw = mysqli_fetch_array($Lstz)) {
            $cond = $cond + 1;
            echo "<tr id='row" . $Lw['id'] . "' class='tablacontenido'>";
            echo "<td>" . $cond . "</td>";

            $Lstwz = $claseAulaV->verugel($Lw['ugel']);
            while ($Lwe = mysqli_fetch_array($Lstwz)) {
                echo "<td>" . $Lwe['ugeldescripcion']  . "</td>";
            }


            echo "<td>" . $Lw['codmodular']. "</td>";
			$Lstwzw = $claseAulaV->veries($Lw['codmodular']);
            while ($Lwet = mysqli_fetch_array($Lstwzw)) {
                echo "<td>" . $Lwet['descripcion']  . "</td>";
            }

             echo "<td>" . $Lw['nivel'] . "</td>";
            echo "<td>" . $Lw['grado'] . "</td>";
            echo "<td>" . $Lw['seccion'] . "</td>";

            echo "<td><button type='button' title='Eliminar' class='btn btn-light-primary btn-sm eliminaruserinfo'   ednice='" . $Lw['id'] . "' ><i class='fas fa-user-times'></i></button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="eliminarminfon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content respuestaeli">
					<div class="modal-header modeldi">
						<h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
					</div>
					<form name="formulario-asistenciaeli" id="formulario-asistenciaeli" enctype="multipart/form-data" method="POST">
						<div class="modal-body">
							<input type="hidden" class="form-control" id="ednielisr" name="ednielisr" readonly>
							<div class="form-group">

								<center><i class="fas fa-trash-alt fa-7x"></i></center>
							</div>
						</div>
						<div id="respuestaeliminarnuevo"></div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							<button type="button" class="btn btn-danger eliminarnewslistanuevo">Eliminar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

<script>
    
			$(".eliminaruserinfo").click(function() {
				$('#eliminarminfon').modal('show');

				var ednice = $(this).attr('ednice');

				$('#ednielisr').val(ednice);

			});

            $(".eliminarnewslistanuevo").click(function() {
				var id = $('#ednielisr').val();
				var data = 'id=' + id;

				$.ajax({
					type: "POST",
					url: "eliminarlistausuario.php",
					data: data,
					success: function(data) {
						$("#row" + id).hide();
						$('#respuestaeliminarnuevo').html(data);
						setTimeout(function() {
							$('#eliminarminfon').modal('hide');
						}, 500);
					}
				})
			})
</script>