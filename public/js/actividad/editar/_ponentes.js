
function cargarPonentes() {
    $.ajax({
        url: 'api/ponentes/findAll',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const item of response) {
                const ponenteDiv = $('<div>');
                const headerDiv = $('<div>');
                const imageDiv = $('<div>');

                const nombreSpan = $('<span>', {
                    text: item.nombre
                });

                const cargoSpan = $('<span>', {
                    text: item.cargo
                });

                headerDiv.append(nombreSpan);
                headerDiv.append(cargoSpan);
                ponenteDiv.append(headerDiv);


                if (item.url) {
                    const ponenteImg = $('<img>', {
                        src: "images/uploads/ponente/"+item.url,
                        alt: item.nombre,
                        style: 'margin-left: 10px; width: 50px; height: 50px;'
                    });
                    imageDiv.append(ponenteImg);
                    ponenteDiv.append(imageDiv);
                }

                cargoSpan.addClass("negrita");
                ponenteDiv.addClass("ponente");
                headerDiv.addClass("ponenteHeader");
                imageDiv.addClass("ponenteImage");

                $('#select').append(ponenteDiv);
            }
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });


    $('#select, #selected').on('click', 'div.ponente', function() {
        const isSelected = $(this).parent().attr('id') === 'selected';
        if (isSelected) {
            $('#select').append($(this));
        } else {
            $('#selected').append($(this));
        }
    });
}

function obtenerPonentes() {
    var datos = [];
    var filas = $("table tbody tr");

    filas.each(function() {
        var fila = $(this);
        var celdas = fila.find("td:not(:last-child)");

        var dato = {
            nombre: celdas.eq(0).text(),
            cargo: celdas.eq(1).text(),
            url: celdas.eq(2).text()
        };

        datos.push(dato);
    });

    return JSON.stringify(datos);;
}