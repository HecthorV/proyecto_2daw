$(function () {
    
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
            {"id": 1, "nombre": "1DAW", "curso": "1", "letra": "A", "nivel_educativo": 1},
            {"id": 2, "nombre": "2DAW", "curso": "2", "letra": "A", "nivel_educativo": 1},
            {"id": 3, "nombre": "1DAM", "curso": "1", "letra": "A", "nivel_educativo": 1},
            {"id": 4, "nombre": "2DAM", "curso": "2", "letra": "A", "nivel_educativo": 1}
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

})