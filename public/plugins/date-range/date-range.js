$(function () {
    // Get today's date
    var today = new Date();

    $('.daterange').daterangepicker({
            "showWeekNumbers": false,
            "showISOWeekNumbers": false,
            "showCustomRangeLabel": false,
            "minDate": today,
            "opens": "right",
            locale: {
                direction: 'ltr',
                format: 'DD/MM/YYYY', // Formato de fecha para Madrid, España
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
            timePicker24Hours: true,
            timePickerIncrement: 15,
            
        }, function(start, end, label) {
            // console.log("New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY') + ' (predefined range: ' + label + ')");
        });

})