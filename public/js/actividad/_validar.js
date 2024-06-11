function validarActividadCompuesta() {
    let descripcion = $("#descripcion_compuesta").val() == "" ? false : true;
    if (descripcion == false) {
        alert("Por favor, escribe una descripción.");
    }

    let fechaHoraInicio = $("#fecha_hora_inicio_compuesta").val() == "" ? false : true;
    if (fechaHoraInicio == false) {
        alert("Por favor, selecciona una fecha y hora de inicio.");
    }

    let idEspacio = $("#espacio_seleccionado") == "" ? false : true;
    if (idEspacio == false) {
        alert("Por favor, selecciona un espacio.");
    }

    return descripcion && fechaHoraInicio;
}

function validarActividadSimple() {

    let descripcion = $("#descripcion").val() == "" ? false : true;
    if (!descripcion) {
        alert("Por favor, escribe una descripción.");
    }

    // let idActividadPadre = $("#actividad_padre").val() == "" ? false : true;
    // if (!idActividadPadre) {
    //     alert("Por favor, selecciona un padre.");
    // }

    return descripcion;// && idActividadPadre;
}