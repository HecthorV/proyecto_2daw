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

                recursoDiv.attr('data-id', item.id);

                const nombreSpan = $('<span>', {
                    text: item.nombre,
                    'data-id': item.id
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



function obtenerIdsDiv() {
    const divsRecursosElegidos = $('#elegidosRecursos [data-id]');
    const idsRecursos = [];

    for (const divRecurso of divsRecursosElegidos) {
        var id = $(divRecurso).data('id');
        idsRecursos.push(id);
    }

    return idsRecursos;
}


function cargarEspacios() {

    let recursosIds = obtenerIdsDiv();

    $.ajax({
        url: '/api/espacios/findByIdsRecursos',
        method: 'GET',
        headers: {
            'X-Recurso-Ids': obtenerIdsDiv()
        },
        success: function(response) {
            console.log(response);

            const divEspacios = $('#espacios')
            divEspacios.empty();

            let espacios = response
            for (const espacio of espacios) {

                let divEspacio = $('<div>', {
                    class: 'espacio',
                    text: espacio.nombre,
                    'data-id': espacio.id
                })

                divEspacios.append(divEspacio)
            }
        },
        error: function(status, error) {
            console.error('Error en la petición:');
            console.log(error)
        }
    });


}
