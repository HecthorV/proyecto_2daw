$( function() {

    $("#anadir_actividad").appendTo("div.page-actions")



    $("#editar_actividad_compuesta").on("click", function (e) {
        e.preventDefault();
        if (validarActividadCompuesta()) {
            editarActividad(0, "compuesta", $("#eventos").val());
        }
    })

});