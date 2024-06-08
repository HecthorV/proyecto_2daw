
function cargarGrupos() {
    $.ajax({
        url: 'api/grupos/findAll',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const grupo of response) {

                const grupoDiv = $('<div>', {
                    'data-id': grupo.id,
                    'data-curso': grupo.curso,
                    class: 'grupo'
                });

                const nombreSpan = $('<span>', {
                    text: grupo.curso + "º " + grupo.nombre + " " + grupo.letra,
                    class: 'negrita'
                });

                grupoDiv.append(nombreSpan);

                $('#select').append(grupoDiv);
            }
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });


    $('#select, #selected').on('click', 'div.grupo', function() {
        const isSelected = $(this).parent().attr('id') === 'selected';
        if (isSelected) {
            $('#select').append($(this));
        } else {
            $('#selected').append($(this));
        }
    });

    // Filtro por curso
    $('select[name="filtrar_por_curso"]').on('change', function() {
        // Obtén la opción seleccionada
        var selectedOption = $(this).val();

        // Si la opción seleccionada es 'todos', muestra todos los grupos
        if (selectedOption == '0') {
            $('#select .grupo').show();
        } else {
            // Oculta todos los grupos
            $('#select .grupo').hide();

            // Muestra solo los grupos que correspondan a la opción seleccionada
            $('#select .grupo[data-curso="' + selectedOption + '"]').show();
        }
    });
}

function obtenerGruposIdsDiv() {
    const divsGruposelegidos = $('#selected > [data-id]'); // '>' significa: hijo directo
    const idsGrupos = [];

    for (const divGrupo of divsGruposelegidos) {
        var id = $(divGrupo).data('id');
        idsGrupos.push(id);
    }

    return idsGrupos;
}