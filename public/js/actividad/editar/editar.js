$( function() {

    $("#tabs").tabs({
        collapsible: true
    });

    $("#anadir_actividad").appendTo("div.page-actions")

    $("div[name='para_anadir_actividad']").addClass("deshabilitado");
    


    

    // Formulario de compuesta
    $("#b_compuesta")   .addClass("deshabilitado");
    // Formulario de simple
    $("#b_simple")      .addClass("deshabilitado");

    $('#elegir_simple_compusesta').on('change', function(e) {
        
        if ( $(this).val() == "0" ) {
            // ES SIMPLE
            console.log("ES SIMPLE");
            $("#b_simple")      .removeClass("deshabilitado");
            $("#b_compuesta")   .addClass("deshabilitado");
        } else {
            // ES COMPUESTA
            console.log("ES COMPUESTA");
            $("#b_compuesta")   .removeClass("deshabilitado");
            $("#b_simple")      .addClass("deshabilitado");
        }

    });

    // Información
    cargarIntroduccion();

    // Eventos
    cargarEventos();
    crearTabsActividad();

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

    $("#crear_actividad_compuesta").on("click", function (e) {
        e.preventDefault();
        // console.log(obtenerDatosActividadSimple())
        crearActividad(0, "compuesta", $("#eventos").val());
    })
    $("#crear_actividad_simple").on("click", function (e) {
        e.preventDefault();
        // console.log(obtenerDatosActividadSimple())
        crearActividad(0, "simple", $("#eventos").val());
    })

});