
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