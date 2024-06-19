function validarActividadCompuesta() {
    let descripcion = $("#descripcion_compuesta").val() == "" ? false : true;
    if (descripcion == false) {
        alert("Por favor, escribe una descripción.");
    }

    let fechaHoraInicio = $("#fecha_hora_inicio_compuesta").val() == "" ? false : true;
    if (fechaHoraInicio == false) {
        alert("Por favor, selecciona una fecha y hora de inicio.");
    }

    if ($("#eventos").val() == null || $("#eventos").val() == -1) {
        // alert("Se seleccionará por defecto SIN EVENTO.");
        $("#continuarSinEvento").dialog("open");
    }

    return descripcion && fechaHoraInicio;
}

function validarActividadSimple() {

    let descripcion = $("#descripcion").val() == "" ? false : true;
    if (!descripcion) {
        alert("Por favor, escribe una descripción.");
    }

    let fechaHoraInicio = $("#fechaHoraInicio").val() == "" ? false : true;
    if (fechaHoraInicio == false) {
        alert("Por favor, selecciona una fecha y hora de inicio.");
    }

    let idEspacio = $("#espacio_seleccionado") == "" ? false : true;
    if (idEspacio == false) {
        alert("Por favor, selecciona un espacio.");
    }

    return descripcion;// && idActividadPadre;
}