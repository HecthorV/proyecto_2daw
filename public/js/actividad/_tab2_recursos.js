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

    const selectedIds = [1, 2, 3];

    $.ajax({
        url: 'api/recursos/findByRecursos',
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


}
