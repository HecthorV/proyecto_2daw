function cargarRecursos() {
    const eligeRecursos = $('#eligeRecursos');
    const elegidosRecursos = $('#elegidosRecursos');

    $.ajax({
        url: 'api/recursos/findAll',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const item of response) {
                const recursoDiv = $('<div>');
                const contentDiv = $('<div>');

                const nombreSpan = $('<span>', {
                    text: item.nombre
                });

                contentDiv.append(nombreSpan);
                recursoDiv.append(contentDiv);

                nombreSpan.addClass("negrita");
                recursoDiv.addClass("recurso col-3 row-4em");

                eligeRecursos.append(recursoDiv);
            }

            // Attach click event to dynamically added elements
            $('#eligeRecursos, #elegidosRecursos').on('click', 'div.recurso', function() {
                if ($(this).parent().attr('id') === 'eligeRecursos') {
                    elegidosRecursos.append($(this));
                } else {
                    eligeRecursos.append($(this));
                }
            });
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });
}



function cargarEspacios() {

    const selectedIds = [2, 6, 7];

    $.ajax({
        url: 'api/recursos/findByIdsRecursos',
        method: 'GET',
        dataType: 'json',
        headers: {
            'X-Selected-Ids': selectedIds.join(',')
        },
        success: function(response) {
            console.log(response);
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus);
        }
    });


    $.ajax({
        url: '/api/espacios/findByIdsRecursos',
        method: 'GET',
        headers: {
            'X-Recurso-Ids': '1,5'
        },
        success: function(response) {
            console.log(response);
            // Aquí maneja la respuesta, por ejemplo, actualizando la UI con los datos obtenidos
        },
        error: function(xhr, status, error) {
            console.error('Error en la petición:');
            console.error(xhr.responseText); // Aquí puedes mostrar el mensaje de error devuelto por el servidor
        }
    });


}
