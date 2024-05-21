
function obtenerPlantillaPonente() {
    $.ajax({
        url: 'localhost:8000/',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Respuesta exitosa:');
            console.log(response); // Aquí puedes hacer algo con la respuesta del servidor
            
            let ponentes = response.ponentes; // TODO hay que hacer la API para saber

            for (const ponente of ponentes) {
                let div = $("<div>");
                let ponente = obtenerPlantillaPonente();
                select
            }
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });
}

$(function () {

    const url = "localhost:8000/api/ponentes";
    let select = $("#select");
    let selected = $("#selected");

    // Rellenar el div para seleccionar ponente
    $.ajax({
        url: 'tu/servidor/ficticio',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Respuesta exitosa:');
            console.log(response); // Aquí puedes hacer algo con la respuesta del servidor
            
            let ponentes = response.ponentes; // TODO hay que hacer la API para saber

            for (const ponente of ponentes) {
                let div = $("<div>");
                div.addClass("ponente")
                div.html(ponente);
                select
            }
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });



})