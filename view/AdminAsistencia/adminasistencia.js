var usu_id = $('#usu_idx').val();

function init() {
    $("#asistencia_form").off("submit").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();

    var formData = new FormData($("#asistencia_form")[0]);

    // Obtener la imagen del canvas
    const canvas = document.getElementById("theCanvas");
    const dataURL = canvas.toDataURL("image/png");
    const blob = dataURLtoBlob(dataURL); // Convertir la imagen a Blob
    formData.append('foto', blob, 'capturedImage.png'); // Añadir la imagen al formData

    formData.append('usu_id', $('#usu_id').val());   // Captura todos los valores del formulario

    $.ajax({
        url: "../../controller/asistencia.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#asistencia_data').DataTable().ajax.reload(); // Recargar la tabla después de insertar
            $("#modalmantenimiento").modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

// Convertir la dataURL en un Blob
function dataURLtoBlob(dataURL) {
    const arr = dataURL.split(",");
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], { type: mime });
}

$(document).ready(function() {
    
    // Capturar la imagen cuando se presiona el botón
    $("#capture-button").click(function (e) {
        e.preventDefault();  // Evita que el formulario se envíe
        const canvasContext = $("canvas")[0].getContext("2d");
        canvasContext.drawImage($("video")[0], 0, 0, 320, 240);
        const dataUrl = $("canvas")[0].toDataURL("image/png");

        // Ahora, puedes manejar la imagen capturada
        console.log("Foto capturada:", dataUrl);
    });

    $.post("../../controller/asistencia.php?op=combo", function (data) {
        $('#usu_id').html(data);
    });

    $('#usu_id').change(function() {
        var usu_id = $(this).val(); // Obtener el valor del usuario seleccionado

        $('#asistencia_data').DataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                ],
            "ajax": {
                url: "../../controller/asistencia.php?op=listar",
                type: "post",
                data: { usu_id: usu_id }, // Enviar el ID del usuario al backend
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo": true,
            "iDisplayLength": 10,
            "order": [[ 0, "desc" ]],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
        });
    });
});

function eliminar(id_asistencia) {
    swal.fire({
        title: "Eliminar!",
        text: "¿Desea eliminar el registro de asistencia?",
        icon: "error",
        confirmButtonText: "Sí",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/asistencia.php?op=eliminar", { id_asistencia: id_asistencia }, function (data) {
                $("#asistencia_data").DataTable().ajax.reload(); // Recargar la tabla de asistencia

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se eliminó la asistencia correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        }
    });
}

let map; // Definir globalmente para que se pueda destruir y recrear

function initMap(lat, lng) {
    // Verifica si lat y lng son válidos
    if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
        console.log("Coordenadas: ", lat, lng); // Depuración: Verifica que las coordenadas sean correctas
        
        // Si el mapa ya existe, destruirlo antes de crear uno nuevo
        if (map) {
            map.remove(); // Eliminar el mapa actual
        }

        // Crear el mapa centrado en las coordenadas proporcionadas
        map = L.map('map').setView([lat, lng], 15);  // Usar zoom 15, puedes ajustar el nivel

        // Usar OpenStreetMap como fondo
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Colocar un marcador en las coordenadas
        L.marker([lat, lng]).addTo(map)
            .bindPopup("Ubicación de Asistencia")
            .openPopup();

        // Actualizar los valores de latitud y longitud
        $('#latitud').val(lat);
        $('#longitud').val(lng);
    } else {
        console.log("Coordenadas no válidas: ", lat, lng); // Depuración si las coordenadas no son válidas
    }

    // Asegurarse de que el mapa se ajuste correctamente al abrir el modal
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        map.invalidateSize();  // Redibuja el mapa para que se ajuste al tamaño del contenedor
    });
}



function editar(id_asistencia) {
    // Obtener los datos de asistencia por su ID
    $.post("../../controller/asistencia.php?op=mostrar", { id_asistencia: id_asistencia }, function (data) {
        data = JSON.parse(data);
        console.log(data);
        
        // Rellenar los campos con los datos recibidos
        $('#id_asistencia').val(data.id_asistencia);
        $('#usu_id').val(data.usu_id); // ID del usuario
        $('#fecha').val(data.fecha); // Fecha de asistencia
        $('#hora').val(data.hora); // Hora de asistencia
        
        // Mostrar la imagen en lugar del campo de texto de la foto
        if (data.foto) {
            $('#preview_foto').attr('src', '../../public/fotos_asistencia/' + data.foto);
            $('#preview_foto').show(); // Asegurarse de que se muestre la imagen
        } else {
            $('#preview_foto').hide(); // Si no hay imagen, ocultar el campo de imagen
        }

        // Mostrar el mapa en la edición
        $('#map').show(); // Mostrar el mapa solo cuando se edite el registro
        $('#latitud').val(data.latitud); // Latitud de la ubicación
        $('#longitud').val(data.longitud); // Longitud de la ubicación

        // Ocultar la cámara para la edición
        $('#theVideo').hide();
        $('#theCanvas').hide();

        // Desactivar botones relacionados con la cámara
        $('#btnCapture').prop('disabled', true);
        $('#btnDownloadImage').prop('disabled', true);
        $('#btnSendImageToServer').prop('disabled', true);
        $('#btnStartCamera').prop('disabled', true);

        // Inicializar el mapa con las coordenadas de la asistencia
        initMap(data.latitud, data.longitud);
    });

    // Cambiar el título del modal
    $('#lbltitulo').html('Mostrar Asistencia');

    // Mostrar el modal para editar la asistencia
    $("#modalmantenimiento").modal('show');
}

// function nuevo() {
//     // Cambiar el título del modal
//     $('#lbltitulo').html('Nuevo Registro de Asistencia');
    
//     // Restablecer el formulario
//     $("#asistencia_form")[0].reset(); // Limpiar todos los campos del formulario
    
//     // Limpiar campos específicos
//     $('#theCanvas')[0].getContext('2d').clearRect(0, 0, $('#theCanvas')[0].width, $('#theCanvas')[0].height); // Limpiar el canvas
//     $('#preview_foto').attr('src', ''); // Limpiar la imagen previa
//     $('#preview_foto').css('display', 'none'); // Ocultar el elemento de la imagen
    
//     // Mostrar de nuevo la cámara para un nuevo registro
//     $('#theVideo').show(); // Mostrar el video
//     $('#theCanvas').show(); // Mostrar el canvas

//     // Reiniciar botones relacionados con la cámara y la imagen
//     $('#btnCapture').prop('disabled', false); // Activar el botón de captura de foto
//     $('#btnDownloadImage').prop('disabled', true);
//     $('#btnSendImageToServer').prop('disabled', true);
//     $('#btnStartCamera').prop('disabled', false); // Habilitar el botón de iniciar la cámara

//     // Limpiar campos de latitud, longitud y hora
//     $('#latitud').val(''); // Limpiar el campo de latitud
//     $('#longitud').val(''); // Limpiar el campo de longitud
//     $('#hora').val(''); // Limpiar el campo de hora

//     // Asegurarse de que no se duplique el evento de submit
//     $("#asistencia_form").off("submit").on("submit", function(e) {
//         guardaryeditar(e); // Llamar a la función de guardar
//     });

//     // Mostrar el modal para nuevo registro
//     $("#modalmantenimiento").modal('show');
// }

function nuevo() {
    // Cambiar el título del modal
    $('#lbltitulo').html('Nuevo Registro de Asistencia');
    
    // Restablecer el formulario
    $("#asistencia_form")[0].reset(); // Limpiar todos los campos del formulario
    
    // Limpiar campos específicos, si es necesario
    $('#theCanvas')[0].getContext('2d').clearRect(0, 0, $('#theCanvas')[0].width, $('#theCanvas')[0].height); // Limpiar el canvas
    $('#preview_foto').attr('src', '').hide(); // Limpiar la imagen previa y ocultarla
    
    // Ocultar el mapa ya que estamos en la vista de nuevo registro
    $('#map').hide(); // Ocultar el contenedor del mapa
    
    // Mostrar de nuevo la cámara para un nuevo registro
    $('#theVideo').show(); // Mostrar el video
    $('#theCanvas').show(); // Mostrar el canvas

    // Reiniciar los botones relacionados con la cámara
    $('#btnCapture').prop('disabled', false); // Activar el botón de captura de foto
    $('#btnDownloadImage').prop('disabled', true); // Desactivar el botón de descargar imagen
    $('#btnSendImageToServer').prop('disabled', true); // Desactivar el botón de guardar imagen
    $('#btnStartCamera').prop('disabled', false); // Habilitar botón para iniciar cámara

    // Limpiar campos de latitud, longitud y hora
    $('#latitud').val(''); // Limpiar el campo de latitud
    $('#longitud').val(''); // Limpiar el campo de longitud
    $('#hora').val(''); // Limpiar el campo de hora

    // Desvincular cualquier evento anterior de submit para evitar duplicados
    $("#asistencia_form").off('submit');

    // Registrar el evento submit del formulario nuevamente
    $("#asistencia_form").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($("#asistencia_form")[0]);
        
        $.ajax({
            url: "../../controller/asistencia.php?op=guardaryeditar",
            type: "POST",
            data: { usu_id: usu_id },
            contentType: false,
            processData: false,
            success: function(data) {
                console.log("Respuesta del servidor:", data);  // Verifica la respuesta del servidor
                $('#asistencia_data').DataTable().ajax.reload(); // Recargar la tabla después de insertar
                $("#modalmantenimiento").modal('hide');

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Registro Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error en el envío de datos: ", textStatus, errorThrown); // Capturar cualquier error en la solicitud AJAX
            }
        });
    });

    // Mostrar el modal para nuevo registro
    $("#modalmantenimiento").modal('show'); // Mostrar el modal
}




init();
