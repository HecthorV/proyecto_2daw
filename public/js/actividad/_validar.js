function validarActividadCompuesta() {
    let descripcion = $("#descripcion_compuesta").val() == "" ? false : true;
    let fechaHoraInicio = $("#fecha_hora_inicio_compuesta").val() == "" ? false : true;

    return descripcion && fechaHoraInicio;
}

function validarActividadSimple() {

    let descripcion = $("#descripcion").val() == "" ? false : true;
    let idActividadPadre = $("#actividad_padre").val() == "" ? false : true;

    return descripcion && idActividadPadre;
}