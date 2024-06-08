$(document).ready(function() {
    // Función para añadir una nueva fila a la tabla
    $('#anadir').click(function() {
        // Obtener los valores de los campos de entrada
        var nombre = $('#nombre').val();
        var cargo = $('#cargo').val();
        var url = $('#url').val();

        // Verificar si todos los campos tienen valores
        if (nombre && cargo && url) {
            // Crear una nueva fila con los valores obtenidos
            var newRow = '<tr>' +
                '<td class="nombre">' + nombre + '</td>' +
                '<td class="cargo">' + cargo + '</td>' +
                '<td class="url">' + url + '</td>' +
                '<td>' +
                '<button class="editar">Editar</button>' +
                '<button class="borrar">Borrar</button>' +
                '</td>' +
                '</tr>';
            // Añadir la nueva fila al final del tbody
            $('table tbody').append(newRow);

            // Limpiar los campos de entrada después de añadir la fila
            $('#nombre').val('');
            $('#cargo').val('');
            $('#url').val('');
        } else {
            // Mostrar un modal de error si algún campo está vacío
            $("#errorModal").dialog();
        }
    });

    // Función para editar una fila existente
    $(document).on('click', '.editar', function() {
        // Obtener la fila que contiene el botón Editar
        var row = $(this).closest('tr');

        // Obtener los valores de la fila
        var nombre = row.find('.nombre').text();
        var cargo = row.find('.cargo').text();
        var url = row.find('.url').text();

        // Reemplazar el texto de las celdas con campos de entrada
        row.find('.nombre').html('<input type="text" value="' + nombre + '">');
        row.find('.cargo').html('<input type="text" value="' + cargo + '">');
        row.find('.url').html('<input type="text" value="' + url + '">');

        // Reemplazar el botón Editar con los botones Guardar y Cancelar
        row.find('td:last').html('<button class="guardar">Guardar</button><button class="cancelar">Cancelar</button>');
    });

    // Función para guardar los cambios en una fila editada
    $(document).on('click', '.guardar', function() {
        // Obtener la fila que contiene el botón Guardar
        var row = $(this).closest('tr');

        // Obtener los valores de los campos de entrada
        var nombre = row.find('.nombre input').val();
        var cargo = row.find('.cargo input').val();
        var url = row.find('.url input').val();

        // Reemplazar los campos de entrada con el texto actualizado
        row.find('.nombre').text(nombre);
        row.find('.cargo').text(cargo);
        row.find('.url').text(url);

        // Reemplazar los botones Guardar y Cancelar con el botón Editar
        row.find('td:last').html('<button class="editar">Editar</button><button class="borrar">Borrar</button>');
    });

    // Función para cancelar la edición de una fila
    $(document).on('click', '.cancelar', function() {
        // Obtener la fila que contiene el botón Cancelar
        var row = $(this).closest('tr');

        // Obtener los valores originales de las celdas
        var nombre = row.find('input.nombre').attr('value');
        var cargo = row.find('input.cargo').attr('value');
        var url = row.find(' input.url').attr('value');

        // Reemplazar los campos de entrada con el texto original
        row.find('.nombre').text(nombre);
        row.find('.cargo').text(cargo);
        row.find('.url').text(url);

        // Reemplazar los botones Guardar y Cancelar con el botón Editar
        row.find('td:last').html('<button class="editar">Editar</button><button class="borrar">Borrar</button>');
    });

    // Función para borrar una fila
    $(document).on('click', '.borrar', function() {
        // Eliminar la fila que contiene el botón Borrar
        $(this).closest('tr').remove();
    });
});