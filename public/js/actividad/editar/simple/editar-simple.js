$( function() {

    $("#tabs").tabs({
        collapsible: true
    });

    $("#anadir_actividad").appendTo("div.page-actions")

    // Información
    cargarIntroduccion();

    // Eventos
    cargarEventos();

    // Recursos
    cargarRecursos();
    $('#btnBuscarEspacios').on('click', function () {
        cargarEspacios();
    })


    // Ponentes
    // cargarPonentes();

    // Grupos
    cargarGrupos()


    // CREAR ACTIVIDAD
    // $("#guardar_compuesta").on("click", function (e) {
    //     e.preventDefault();
    //     crearActividad();
    // })

    $("#editar_actividad_simple").on("click", function (e) {
        e.preventDefault();
        editarActividad($("#actividad_padre").val(), "simple", $("#eventos").val());
        window.location.href = "http://localhost:8000/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CDetalleActividadCrudController";
    })

});