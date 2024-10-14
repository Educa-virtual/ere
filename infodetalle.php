<script type="text/javascript">
        $(document).ready(function() {
            $('#ugeluserenviar').on('change', function() {
                var ugelID = document.getElementById("ugeluserenviar").value;
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
                var ugelID = document.getElementById("ugeluserenviar").value;
                var distritoID = document.getElementById("distrito").value;
                var nivelID = document.getElementById("nivelenviar").value;
                var ruta = "distritoID=" + distritoID + "&nivelID=" + nivelID+ "&ugelID=" + ugelID;
                if (distritoID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDataRaUSU.php',
                        data: ruta,
                        success: function(html) {
                            $('#codmodularusuenvi').html(html);
                        }
                    });
                } else {
                    $('#codmodularusuenvi').html('<option value="">Seleccione...</option>');
                }

            });


           
        });
    </script>



<?php


require_once "cAdmision.php";
$claseAulaV = new cAdmision;
$dnicde = $_POST['idnuevo'];

$Lestz = $claseAulaV->verusuariosdetalle($dnicde);
while ($Lwe = mysqli_fetch_array($Lestz)) {
    $detalleusut = $Lwe['iddetalleus'];
    $tipousu = $Lwe['tipo'];
}



if ($tipousu == '1') {
    $inugel = 'disabled';
    $innivel = 'disabled';
    $incodmudular = 'disabled';
    $ingrado = 'disabled';
    $inseccion = 'disabled';
    $distritonew = 'disabled';
} elseif ($tipousu == '3') {
    $inugel = 'disabled';
    $innivel = 'disabled';
    $incodmudular = 'disabled';
    $ingrado = 'disabled';
    $inseccion = 'disabled';
    $distritonew = 'disabled';
} elseif ($tipousu == '4') {
    $innivel = 'disabled';
    $incodmudular = 'disabled';
    $ingrado = 'disabled';
    $inseccion = 'disabled';
    $distritonew = 'disabled';
} elseif ($tipousu == '5') {
    $ingrado = 'disabled';
    $inseccion = 'disabled';
} else {
}

?>


<div class="modal-header modeldi">
    <h5 class="modal-title" id="exampleModalLabel">Agregar Institución</h5>
</div>

<input type="hidden" value="<?php echo $detalleusut; ?>"  id="detalleusurn">

<div class="modal-body">

    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="ugeluserenviar" <?php echo $inugel; ?>>
                <option value="..">UGEL</option>
                <option value="gsc">General Sanchez Cerro</option>
                <option value="ilo">Ilo</option>
                <option value="mn">Mariscal Nieto</option>
                <option value="sanig">San Ignacion de Loyola</option>
            </select>

        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="nivelenviar" <?php echo $innivel; ?>>
                <option value="..">NIVEL</option>
                <option value="PRIMARIA">Primaria</option>
                <option value="SECUNDARIA">Secundaria</option>
            </select>

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="distrito" <?php echo $distritonew; ?>>
                <option value=".."></option>

            </select>

        </div>
    </div> 
    <br>
    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="codmodularusuenvi" <?php echo $incodmudular; ?>>
                <option value="..">Codigo Modular</option>
                <option value="codmo">codmo</option>
            </select>

        </div>
    </div>


    <br>
    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="gradousuenvi" <?php echo $ingrado; ?>>
                <option value="..">..</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>

        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-12">

            <select class="custom-select" id="seccionusuenvi" <?php echo $inseccion; ?>>
                <option value="..">..</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
            </select>

        </div>
    </div>

</div>
<div id="respuesorer"></div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    <button type="button" class="btn btn-danger actualizaresnuy">Agregar</button>
</div>


<script>
    $(".actualizaresnuy").click(function() {

        var detalleusur = document.getElementById('detalleusurn').value;
        var ugeluserenviar = document.getElementById('ugeluserenviar').value;
        var nivelenviar = document.getElementById('nivelenviar').value;
        var codmodularusuenvi = document.getElementById('codmodularusuenvi').value;
        var gradousuenvi = document.getElementById('gradousuenvi').value;
        var seccionusuenvi = document.getElementById('seccionusuenvi').value;


        var data = 'detalleusur=' + detalleusur + '&ugeluserenviar=' + ugeluserenviar + '&nivelenviar=' + nivelenviar + '&codmodularusuenvi=' + codmodularusuenvi + '&gradousuenvi=' + gradousuenvi + '&seccionusuenvi=' + seccionusuenvi;
        $.ajax({
            type: "POST",
            url: "Gcomplemento.php",
            data: data,
            success: function(data) {
                $('#respuesorer').html(data);
                $('#resultadocomplemento').load('consultaderegistro.php',{valor1:detalleusur});
            }
        })
    })
</script>