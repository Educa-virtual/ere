    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->

        <title>Document</title>

        <style>
            .carga {
                display: none;
            }

            .sut {
                font-weight: bolder;
            }
        </style>
    </head>

    <body>

        <?php
        require_once "cAdmision.php";
        $asistencia = new cAdmision;


        ?>

        <BR>
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <h6 class="card-header">.:: <i class="fas fa-user-alt"></i> IMPORTAR DATOS</h6>
                <div class="card-body respuestagp">

                <script type="text/javascript">
        $(document).ready(function() {
            $('#evaluacioninporta').on('change', function() {
                var seleeva = document.getElementById("evaluacioninporta").value;
             
                var ruta = "seleeva="  + seleeva;
                
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxDatato.php',
                        data: ruta,
                        success: function(html) {
                            $('#d').val(html);;
                        }
                    });
              
            });
        });
            </script>



                    <script src="xlsx.js"></script>
                    <script language="JavaScript">
                        var oFileIn;
                        //Código JQuery
                        $(function() {
                            oFileIn = document.getElementById('my_file_input');
                            if (oFileIn.addEventListener) {
                                oFileIn.addEventListener('change', filePicked, false);
                            }
                        });

                        //Método que hace el proceso de importar excel a html
                        function filePicked(oEvent) {
                            // Obtener el archivo del input
                            var oFile = oEvent.target.files[0];
                            var sFilename = oFile.name;
                            // Crear un Archivo de Lectura HTML5
                            var reader = new FileReader();

                            // Leyendo los eventos cuando el archivo ha sido seleccionado
                            reader.onload = function(e) {
                                var data = e.target.result;
                                var cfb = XLS.CFB.read(data, {
                                    type: 'binary'
                                });
                                var wb = XLS.parse_xlscfb(cfb);
                                // Iterando sobre cada sheet
                                wb.SheetNames.forEach(function(sheetName) {
                                    // Obtener la fila actual como CSV
                                    var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
                                    var data = XLS.utils.sheet_to_json(wb.Sheets[sheetName], {
                                        header: 1
                                    });
                                    $.each(data, function(indexR, valueR) {
                                        var sRow = "<tr>";
                                        $.each(data[indexR], function(indexC, valueC) {
                                            sRow = sRow + "<td>" + valueC + "</td>";
                                        });
                                        sRow = sRow + "</tr>";
                                        $("#my_file_output").append(sRow);
                                    });
                                });
                                $("#imgImport").css("display", "none");
                            };
                            // Llamar al JS Para empezar a leer el archivo .. Se podría retrasar esto si se desea
                            reader.readAsBinaryString(oFile);
                        }
                    </script>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="form-group">
<input type="hidden" id="d">
                                            <select class="form-control" id="evaluacioninporta">

                                                <option value="">Seleccione Evaluación</option>
                                                <?php
                                                $Listape = $asistencia->datacompletaevaluacionestado();
                                                while ($Lp = mysqli_fetch_array($Listape)) {
                                                ?>
                                                    <option value="<?php echo $Lp['tabla']; ?>"><?php echo $Lp['descripcion'];  ?></option>
                                                <?php }; ?>
                                            </select><BR>


                                            <input type="file" id="my_file_input" class="form-control-file" />
                                            <div id="imgImport">

                                                <a href="PLANTILLA.xls">
                                                    <h6><i class="far fa-file-excel"></i> Descargar Plantilla en Excel</h6>
                                                </a>

                                            </div>

                                            <div class="table table-responsive">
                                                <table id='my_file_output' border="" class="table table-bordered table-condensed table-striped"></table>
                                            </div>
                                            <button id="btn_lectura" class="btn btn-primary">Registrar Datos</button>

                                            <p id="respuesta">

                                            </p>
                                            <p id="contador">

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <script>
            $('#btn_lectura').click(function() {

                var evaluacion = document.getElementById('evaluacioninporta').value;
                var conta = document.getElementById('d').value;

                if(conta == ''){
$num=0;
                }else{
                    $num=conta;
                }
      
                valores = new Array();
                var contador = 0;
                $('#my_file_output tr').each(function() {

                    var d1 = $(this).find('td').eq(0).html();
                    var d2 = $(this).find('td').eq(1).html();
                    var d3 = $(this).find('td').eq(2).html();
                    var d4 = $(this).find('td').eq(3).html();
                    var d5 = $(this).find('td').eq(4).html();
                    var d6 = $(this).find('td').eq(5).html();
                    var d7 = $(this).find('td').eq(6).html();
                    var d8 = $(this).find('td').eq(7).html();
                    var d9 = $(this).find('td').eq(8).html();
                    var d10 = $(this).find('td').eq(9).html();
                    var d11 = $(this).find('td').eq(10).html();
                    var d12 = $(this).find('td').eq(11).html();
                    var d13 = $(this).find('td').eq(12).html();
                    var d14 = $(this).find('td').eq(13).html();
                    var d15 = $(this).find('td').eq(14).html();
                    var d16 = $(this).find('td').eq(15).html();
                    var d17 = $(this).find('td').eq(16).html();
                    var d18 = $(this).find('td').eq(17).html();
                    var d19 = $(this).find('td').eq(18).html();
                    var d20 = $(this).find('td').eq(19).html();
                    var d21 = $(this).find('td').eq(20).html();
                    var d22 = $(this).find('td').eq(21).html();
                    var d23 = $(this).find('td').eq(22).html();
                    var d24 = $(this).find('td').eq(23).html();
                    var d25 = $(this).find('td').eq(24).html();
                    var d26 = $(this).find('td').eq(25).html();
                    var d27 = $(this).find('td').eq(26).html();
                    var d28 = $(this).find('td').eq(27).html();
                    var d29 = $(this).find('td').eq(28).html();
                    var d30 = $(this).find('td').eq(29).html();
                    var d31 = $(this).find('td').eq(30).html();
                    var d32 = $(this).find('td').eq(31).html();
                    var d33 = $(this).find('td').eq(32).html();
                    var d34 = $(this).find('td').eq(33).html();
                    var d35 = $(this).find('td').eq(34).html();
                    var d36 = $(this).find('td').eq(35).html();
                    var d37 = $(this).find('td').eq(36).html();
                    var d38 = $(this).find('td').eq(37).html();
                    var d39 = $(this).find('td').eq(38).html();
                    
                    valor = new Array(d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38,d39);
                    valores.push(valor);
                    console.log(valor);
                    // alert(valor);
                    $.post('insertar.php', {
                        d1: d1,
                        d2: d2,
                        d3: d3,
                        d4: d4,
                        d5: d5,
                        d6: d6,
                        d7: d7,
                        d8: d8,
                        d9: d9,
                        d10: d10,
                        d11: d11,
                        d12: d12,
                        d13: d13,
                        d14: d14,
                        d15: d15,
                        d16: d16,
                        d17: d17,
                        d18: d18,
                        d19: d19,
                        d20: d20,
                        d21: d21,
                        d22: d22,
                        d23: d23,
                        d24: d24,
                        d25: d25,
                        d26: d26,
                        d27: d27,
                        d28: d28,
                        d29: d29,
                        d30: d30,
                        d31: d31,
                        d32: d32,
                        d33: d33,
                        d34: d34,
                        d35: d35,
                        d36: d36,
                        d37: d37,
                        d38: d38,
                        d39: d39,
                        d40: evaluacion,
                        d41: $num,
                        
                    }, function(datos) {
                        $('#respuesta').html(datos);
                    });

                    contador = contador + 1;
                    $('#contador').html("Se registro " + contador + " registros correctamente.");

                });



            });
        </script>

    </body>

    </html>