function validarSeleccion(variable,valor) {
    console.log(variable + ': '+valor)
    
    if (valor==0) {
        alert('Debes seleccionar una '+ variable +' para poder obtener estadísticas');
        /* let obj = '#'+variable;
        $(obj).focus(); */
        return false;
    }
    return true;
}
    $(".loader").fadeOut("fast", function() {
    $("#content").fadeIn("fast");
});
    
    $('.cambiarclave').on('click', function() {
        $('#cambiarclave').modal('show');
    });

    function actualizar_clave() {
        var parametrosstse = new FormData($("#formulario-clavenueva")[0]);
        $.ajax({
                type: "POST",
                url: "RAclave.php",
                data: parametrosstse,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                $("#respuestaerrgclave").html(data);
            })
            .fail(function(data) {
                alert("error");
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    }


    $(".iesdirector").click(function() {
        var idenvi = $(this).attr('idenvi');
        var iesdes = $(this).attr('iesdes');
        var ruta = "idenvi=" + idenvi + "&iesdes=" + iesdes;
        $.ajax({
                url: "informacionpDireccion.php",
                type: "POST",
                dataType: "html",
                data: ruta,
                beforeSend: function() {
                    $('.cargando').removeClass("cargar");
                    $('.loader').show();

                }
            })
            .done(function(data) {
                
                $(".resultado").html(data);

            })
            .fail(function(xhr, status, error) {
                // alert("error");
                // Manejo del error
                console.error("Ocurrió un error durante la solicitud AJAX:");
                console.error("Estado:", status);           // Estado de la solicitud (error, timeout, etc.)
                console.error("Error:", error);             // Mensaje de error (puede ser null)
                console.error("Código de estado HTTP:", xhr.status);    // Código de estado HTTP (404, 500, etc.)
                console.error("Texto del estado HTTP:", xhr.statusText);
                alert("Ocurrió un error en la solicitud: " + status + " - " + error);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });


    $(document).on('change', '.xCombo', function() {
        let obj = $(this);
        let dato = obj.val()
        let info = obj.data('info');
        let pagina = obj.data('php') + '.php?info=' + info + '&dato=' + dato;
        let destino = '#'+obj.data('destino');
        
        if (destino=='#undefined'){
            destino = '#mostrar';
        }
        console.log(destino);
        if (dato != '') {
            $.ajax({
                url: pagina,
                type: 'POST',
                /* contentType: false, */
                beforeSend: function() {
                    $('.loader').show();
                }
            }).done(function(datos) {
                $('.loader').hide();

                $(destino).html(datos);
            }).fail(function(xhr, status, error) {
                // alert("error");
                // Manejo del error
                console.error("Ocurrió un error durante la solicitud AJAX:");
                console.error("Estado:", status);           // Estado de la solicitud (error, timeout, etc.)
                console.error("Error:", error);             // Mensaje de error (puede ser null)
                console.error("Código de estado HTTP:", xhr.status);    // Código de estado HTTP (404, 500, etc.)
                console.error("Texto del estado HTTP:", xhr.statusText);
                alert("Ocurrió un error en la solicitud: " + status + " - " + error);
            }).always(function() {
                $('.loader').hide();
            });
        } else {
            $(destino).html('<option value="0">(Todos)</option>');

        }

    });

        $(document).on('click', '.xLinkInfo', function() {
        let obj = $(this);
        let pagina = obj.data('php') + '.php';
        let info = obj.data('info');
        let destino = '#'+obj.data('destino');
        
        if (destino=='#undefined'){
            destino = '.resultado';
        }
        
        $.ajax({
                url: pagina + '?info=' + info,

                type: "POST",
                dataType: "html",
                beforeSend: function() {
                    $('.cargando').removeClass("cargar");
                    $('.loader').show();

                }
            })

            .done(function(data) {
                
                $(destino).html(data);
                

            })
            .fail(function(xhr, status, error) {
                // alert("error");
                // Manejo del error
                console.error("Ocurrió un error durante la solicitud AJAX:");
                console.error("Estado:", status);           // Estado de la solicitud (error, timeout, etc.)
                console.error("Error:", error);             // Mensaje de error (puede ser null)
                console.error("Código de estado HTTP:", xhr.status);    // Código de estado HTTP (404, 500, etc.)
                console.error("Texto del estado HTTP:", xhr.statusText);
                alert("Ocurrió un error en la solicitud: " + status + " - " + error);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });

    

    $(".xLink").click(function() {
        let obj = $(this);
        let pagina = obj.data('php') + '.php';
        $.ajax({
                url: pagina,
                type: "POST",
                dataType: "html",
                beforeSend: function() {
                    $('.loader').show();
                    $('.cargando').removeClass("cargar");
                }
            })
            .done(function(data) {
                
                $(".resultado").html(data);

            })
            .fail(function(xhr, status, error) {
                // alert("error");
                // Manejo del error
                console.error("Ocurrió un error durante la solicitud AJAX:");
                console.error("Estado:", status);           // Estado de la solicitud (error, timeout, etc.)
                console.error("Error:", error);             // Mensaje de error (puede ser null)
                console.error("Código de estado HTTP:", xhr.status);    // Código de estado HTTP (404, 500, etc.)
                console.error("Texto del estado HTTP:", xhr.statusText);
                alert("Ocurrió un error en la solicitud: " + status + " - " + error);
            })
            .always(function() {
                $('.loader').hide();
                $('.cargando').addClass("cargar");
            });
    });

    $('#informacionpcolea').click(function() {
        var infoa = $(this).attr('infocolegioa');

        var ruta = "infoa=" + infoa;
        $.ajax({
                url: "informacionpcole.php",
                type: 'POST',
                data: ruta,
                dataType: 'html',

                beforeSend: function() {
                    $('.cargando').removeClass("cargar");
                    $('.loader').show();
                }

            })
            .done(function(data) {
                $('.loader').hide();
                $(".resultado").html(data);
                $('.cargando').addClass("cargar");
            })
    });

    $('#informacionpcoleb').click(function() {
        var infoa = $(this).attr('infocolegiob');

        var ruta = "infoa=" + infoa;
        $.ajax({
                url: "informacionpcole.php",
                type: 'POST',
                data: ruta,
                dataType: 'html',

                beforeSend: function() {
                    $('.loader').removeClass("cargar");
                }

            })
            .done(function(data) {
                $(".resultado").html(data);
                $('.loader').addClass("cargar");
            })
    });

    /**
     * Para Subir Archivos
     */
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('excelFile');
    const fileDetails = document.getElementById('file-details');
    const progressBar = document.querySelector('.progress-bar');
    const progressContainer = document.querySelector('.progress');
    const fileAlert = document.getElementById('file-alert');
    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        showFileName(fileInput.files);
    });

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        showFileName(e.dataTransfer.files);
    });

    function showFileName(files) {
        if (files.length > 0) {
            fileDetails.innerHTML = `Archivo seleccionado: <strong>${files[0].name}</strong>`;
            fileAlert.style.display = 'none';
        } else {
            fileDetails.innerHTML = '';
        }
    }

    $('#modalSubirArchivo').on('show.bs.modal', function(event) {
        // Reset the form
        $('#frmSubirArchivo')[0].reset();

        var button = $(event.relatedTarget); // Botón que activó el modal
        var row = button.closest('tr'); // Fila que contiene el botón
        let area = button.data('area')
        let nivel = button.data('nivel')
        let grado = button.data('grado')
        let tipo = button.data('tipo')
        let codmodular = button.data('codmodular')
        let historial = button.data('historial')
        let detalle = button.data('detalle')
        // Obtener información de las celdas
        var nombre = row.find('.nombreArea').text();

        // Clear file details
        fileDetails.innerHTML = '';
        // Reset progress bar
        progressContainer.style.display = 'none';
        progressBar.style.width = '0%';
        progressBar.setAttribute('aria-valuenow', '0');
        progressBar.textContent = '0%';
        // Store the button in modal data
        $('#modalSubirArchivo').data('button', button);

        // Recuperar y mostrar información
        $('#idArea').val(area);
        $('#idNivel').val(nivel);
        $('#idGrado').val(grado);
        $('#idCodModular').val(codmodular);
        $('#idHistorial').val(historial);
        $('#idTipo').val(tipo);
        $('#idDetalle').val(detalle);
        $('#nombreArea').html(nombre);
        $('#nombreGrado').html(grado);
        $('#nombreNivel').html(nivel);
        $('#tipoEvaluacion').html(tipo);
    });

    
    $('#subirExcel').on('click', function() {

        if (!fileInput.files.length) {
            fileAlert.style.display = 'block';
            return;
        }

                var formData = new FormData($('#frmSubirArchivo')[0]);
                $.ajax({
                    url: 'views/ies/uploadExcel.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percentComplete = (e.loaded / e.total) * 100;
                                progressBar.style.width = percentComplete + '%';
                                progressBar.setAttribute('aria-valuenow', percentComplete);
                                progressBar.textContent = Math.round(percentComplete) + '%';
                            }
                        }, false);
                        return xhr;
                    },
                    beforeSend: function() {
                        progressContainer.style.display = 'block';
                        progressBar.style.width = '0%';
                        progressBar.setAttribute('aria-valuenow', '0');
                        progressBar.textContent = '0%';
                        $('.loader').show();
                    },
                    success: function(response) {
                        $('.loader').hide();
                        if (response === 'Archivo subido y procesado con éxito.') {
                            var button = $('#modalSubirArchivo').data('button');
                            button.removeClass('btn-primary').addClass('btn-success').prop('disabled', true);
                        }
                        alert(response);
                        $('#modalSubirArchivo').modal('hide');
                        progressContainer.style.display = 'none';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al subir el archivo: ' + errorThrown);
                        $('.loader').hide();
                        progressContainer.style.display = 'none';
                    }
                });
            });
