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
                const recursoDiv = $('<div>'); // div padre con clase recurso
                const contentDiv = $('<div>'); // div para css

                recursoDiv.attr('data-id', item.id);
                // recursoDiv.data('id', item.id); // ha dado error

                const nombreSpan = $('<span>', {
                    text: item.nombre
                });

                contentDiv.append(nombreSpan);
                recursoDiv.append(contentDiv);

                nombreSpan.addClass("negrita");
                recursoDiv.addClass("recurso col-lg-3 col-sm-12 row-4em");

                eligeRecursos.append(recursoDiv);
            }

            $('#eligeRecursos, #elegidosRecursos').on('click', 'div.recurso', function() {
                // $(this) es div.recurso
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



function obtenerRecursosIdsDiv() {
    const divsRecursosElegidos = $('#elegidosRecursos > [data-id]'); // '>' significa: hijo directo
    const idsRecursos = [];

    for (const divRecurso of divsRecursosElegidos) {
        var id = $(divRecurso).data('id');
        idsRecursos.push(id);
    }

    return idsRecursos;
}



function cargarEspacios() {

    let recursosIds = obtenerRecursosIdsDiv();

    $.ajax({
        url: '/api/espacios/findByIdsRecursos',
        method: 'GET',
        headers: {
            'X-Recurso-Ids': recursosIds // tiene nombre raro por consenso
        },
        success: function(response) {
            console.log(response);

            const divEspacios = $('#listaEspacios')
            divEspacios.empty();

            let espacios = response
            for (const espacio of espacios) {

                let divEspacio = $('<div>', {
                    class: 'espacio',
                    text: espacio.nombre,
                    'data-id': espacio.id
                })
                // divEspacio.data('id', espacio.id);

                divEspacios.append(divEspacio)
            }

            divEspacios.on('click', '.espacio', function() {
                $('.espacio').removeClass('selected');
                $(this).addClass('selected');
            });
        },
        error: function(status, error) {
            console.error('Error en la petición:');
            console.log(error)
        }
    });
}

function obtenerIdEspaciosSeleccionado() {
    return $("#listaEspacios div.espacio.selected").data("id");
}

// function obtenerEspaciosIdsDiv() {
//     const divsEspaciosElegidos = $('#espacios > [data-id]'); // '>' significa: hijo directo
//     const idsEspacios = [];
//
//     for (const divEspacio of divsEspaciosElegidos) {
//         var id = $(divEspacio).data('id');
//         idsEspacios.push(id);
//     }
//
//     return idsEspacios;
// }

