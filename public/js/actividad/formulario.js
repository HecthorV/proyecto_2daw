$( function() {
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
        function(start, end, label) {
            console.log("New date range selected: " + start.format('DD/MM/YYYY') + " to " + end.format('DD/MM/YYYY') + " (predefined range: " + label + ")");
            datetime_start = start.format('DD/MM/YYYY HH:mm');
            datetime_end = end.format('DD/MM/YYYY HH:mm');
        }
    );


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
    

    $("#b_compuesta")   .addClass("deshabilitado");
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

    cargarEventos();
    habilitarPanelDerecho();

    $("#guardar_compuesta").on("click", function (e) {
        e.preventDefault();
        crearActividad();
    })


    // Ponentes
    cargarPonentes();
});