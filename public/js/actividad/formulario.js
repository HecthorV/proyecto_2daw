$( function() {

    $("#tabs").tabs({
        collapsible: true
    });

    $('.ui-tabs-nav a').on('click', function(e) {
        // Obtén la pestaña actual
        var currentTab = $('.ui-tabs-active');

        // Verifica si hay campos obligatorios no llenos en la pestaña actual
        var emptyFields = currentTab.find('.required').filter(function() {
            return !this.value;
        });

        // Si hay campos obligatorios no llenos, evita que el usuario avance a la siguiente pestaña
        if (emptyFields.length > 0) {
            e.preventDefault();
            alert('Por favor, llena todos los campos obligatorios antes de avanzar.');
        }
    });

    $("#anadir_actividad").appendTo("div.page-actions")

    $("div[name='para_anadir_actividad']").addClass("deshabilitado");
    
    let today = new Date();
    let datetime_start,datetime_end = "";

    $('input.daterange').daterangepicker({
        "showWeekNumbers": false,
        "showISOWeekNumbers": false,
        "showCustomRangeLabel": false,
        "minDate": today,
        "opens": "left",
        locale: {
            direction: 'ltr',
            format: 'DD/MM/YYYY HH:mm', // Formato de fecha para Madrid, España
            separator: ' / ',
            applyLabel: 'Aplicar', // Cambiado a español
            cancelLabel: 'Cancelar', // Cambiado a español
            weekLabel: 'Sem', // Abreviatura de "Semana" en español
            customRangeLabel: 'Rango personalizado', // Cambiado a español
            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'], // Abreviaturas de los días de la semana en español
            monthNames: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'], // Nombres de los meses en español
            firstDay: 1 // Lunes es el primer día de la semana en España
        },
        timePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 5,
    }, 
        function(start, end) {
            console.log("New date range selected: " + start.format('DD/MM/YYYY') + " to " + end.format('DD/MM/YYYY'));
            datetime_start = start.format('DD/MM/YYYY HH:mm');
            datetime_end = end.format('DD/MM/YYYY HH:mm');
        }
    );

    cargarActividadesPadre();
    $("#elegirActividadPadre").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Ok: function() {
                let idActividad = $("#listaActividades div.actividad.selected").data("id");
                $("#actividad_padre").val(idActividad);
                $(this).dialog("close");
            },
            Cancelar: function() {
                $(this).dialog("close");
            }
        }
    });
    $("#buscarActividadPadre").click(function() {
        $("#elegirActividadPadre").dialog("open");
    });

    // $('#actividadForm').submit(function(event) {
    //     // Evitar el comportamiento predeterminado del formulario
    //     event.preventDefault();
        
    //     // Crear un nuevo objeto FormData
    //     var formData = new FormData($(this)[0]); // Pasar el formulario directamente al constructor de FormData
        
    //     // Agregar los datos adicionales
    //     var datetime_start = "2024-05-07 08:00:00";
    //     var datetime_end = "2024-05-07 10:00:00";
    //     formData.append("fechaInicio", datetime_start);
    //     formData.append("fechaFin", datetime_end);
        
    //     // Mostrar los datos por consola
    //     console.log("Datos del formulario:");
    //     for (var pair of formData.entries()) {
    //         console.log(pair[0] + ': ' + pair[1]);
    //     }
    // });
    

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
            $("#buscarActividadPadre").addClass("visible");
            $("#actividad_padre").val("")
        } else {
            // ES COMPUESTA
            console.log("ES COMPUESTA");
            $("#b_compuesta")   .removeClass("deshabilitado");
            $("#b_simple")      .addClass("deshabilitado");
            $("#buscarActividadPadre").removeClass("visible");
            $("#actividad_padre").val("")
        }

    });

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
        if (validarActividadCompuesta()) {
            crearActividad(0, "compuesta", $("#eventos").val());
        } else {
            alert("Por favor, llena todos los campos obligatorios.")
        }
    })
    $("#crear_actividad_simple").on("click", function (e) {
        e.preventDefault();
        if (validarActividadSimple()) {
            crearActividad(0, "simple", $("#eventos").val());
        }
        else if ($("#actividad_padre").val() == "") {
                alert("Por favor, debes seleccionar una actividad padre.")
        } else {
            alert("Por favor, llena todos los campos obligatorios.")
        }
    })

});