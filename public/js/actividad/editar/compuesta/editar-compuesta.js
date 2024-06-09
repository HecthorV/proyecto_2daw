$( function() {

    // $("#anadir_actividad").appendTo("div.page-actions")

    // Eventos
    cargarEventos();
    seleccionarEvento();

    // Fecha
    inicializarInputDate();
    seleccionarFecha();



    $("#editar_actividad_compuesta").on("click", function (e) {
        e.preventDefault();
        if (validarActividadCompuesta()) {
            editarActividad($("#id_actividad").val(), "compuesta", $("#eventos").val());
        }
    })

});

function inicializarInputDate() {
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
}

function seleccionarFecha() {
    let fechaHoraInicio = document.getElementById('fechaHoraInicio_compuesta_servidor').value;
    let fechaHoraFin = document.getElementById('fechaHoraFin_compuesta_servidor').value;

    let startDate = new Date(fechaHoraInicio);
    let endDate = new Date(fechaHoraFin);

    $('input.daterange').data('daterangepicker').setStartDate(startDate);
    $('input.daterange').data('daterangepicker').setEndDate(endDate);
}

