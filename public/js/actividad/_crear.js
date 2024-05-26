
function obtenerDatosActividad() {
    var partes = $('#fechaHoraInicio_compuesta').val().split(" / ")
    var fechaHoraInicio = partes[0]
    var fechaHoraFin = partes[1]

    return {
        descripcion: $('#descripcion_compuesta').val(),
        fechaHoraInicio: fechaHoraInicio,
        fechaHoraFin: fechaHoraFin,
        isCompuesta: $("#elegir_simple_compusesta").val(),
        idEvento: $("#eventos").val(),
    };
}

function crearActividad(idPadre, simple_compuesta, idEvento) {
    // if (simple_compuesta == "simple") {
        
    // } else {
        datos_actividad = obtenerDatosActividad();
        console.log(datos_actividad);

        $.ajax({
            url: 'api/actividad/insert',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(datos_actividad),
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $("#evento_seleccionado").val(response);
            },
            error: function(textStatus, error) {
                console.log('Error en la petición:');
                console.log(textStatus);
                console.log(error);
            }
        });
    // }
}