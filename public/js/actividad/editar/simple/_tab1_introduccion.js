function cargarIntroduccion() {
    let datetime_start,datetime_end = "";

    $('input.daterange').daterangepicker({
            "showWeekNumbers": false,
            "showISOWeekNumbers": false,
            "showCustomRangeLabel": false,
            // "minDate": today,
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

    const inputFechaHoraInicio = $("#fechaHoraInicio");

    let fechaHoraInicioServidor = $("#fechaHoraInicio_servidor").val();
    let fechas = fechaHoraInicioServidor.split(' / ');

    let startDate = moment(fechas[0], "DD/MM/YYYY HH:mm");
    let endDate = moment(fechas[1], "DD/MM/YYYY HH:mm");

    inputFechaHoraInicio.data('daterangepicker').setStartDate(startDate);
    inputFechaHoraInicio.data('daterangepicker').setEndDate(endDate);
}