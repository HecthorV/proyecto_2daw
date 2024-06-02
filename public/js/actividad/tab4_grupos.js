

// // ARRAY INDEXADO
// let grupos = {
//     "grupos" : [
//         [1, "1DAW", "1", "A", 1],
//         [2, "2DAW", "2", "A", 1],
//         [3, "1DAM", "1", "A", 1],
//         [4, "2DAM", "2", "A", 1]
//     ]
// }

// ARRAY ASOCIATIVO / OBJETOS
let grupos = {
    "grupos" : [
        {"nombre": "1DAW", "curso": "1", "letra": "A", "nivel_educativo": 1},
        {"nombre": "2DAW", "curso": "2", "letra": "A", "nivel_educativo": 1},
        {"nombre": "1DAM", "curso": "1", "letra": "A", "nivel_educativo": 1},
        {"nombre": "2DAM", "curso": "2", "letra": "A", "nivel_educativo": 1}
    ]
};

// TODO plantear pestaña Recursos
let divSelectGroups = $("#select_groups")
let divSelectedGroups = $("#selected_groups")

for (let i = 0; i < grupos.grupos.length; i++) {
    // ROWS
    var p = $("<p>")
    p.html(grupos.grupos[i].nombre);
    p.data("id", grupos.grupos[i].id);

    divSelectGroups.append(p)


    // for (let j = 0; j < grupos.grupos[i].length; j++) {
    //     // COLUMNS
    //     var p = $("<p>")
    //     p.html(grupos.grupos[i][j]);
    //     p.data();
    //     divSelectGroups.append("")
    //     console.log(grupos.grupos[i][j]);
    // }
}

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