
function obtenerDatosActividadCompuesta() {
    var partes = $('#fechaHoraInicio_compuesta').val().split(" / ")
    var fechaHoraInicio = partes[0]
    var fechaHoraFin = partes[1]

    return {
        descripcion: $('#descripcion_compuesta').val(),
        fechaHoraInicio: fechaHoraInicio,
        fechaHoraFin: fechaHoraFin
    };
}

function obtenerDatosActividadSimple() {
    // Fecha y hora de inicio
    var dates = $("#fechaHoraInicio").val().split(" / ");
    var datetime_start = dates[0];
    var datetime_end = dates[1];

    // Espacios
    // const espacios = obtenerEspaciosIdsDiv();
    const idEspacio = obtenerIdEspaciosSeleccionado();

    // Ponentes
    const ponentes = obtenerPonentes();

    // Grupos
    const grupos = obtenerGruposIdsDiv();

    // Create a regular object with the form data
    var datos_actividad = {
        idActividadPadre: $("#actividad_padre").val(),
        descripcion: $("#descripcion").val(),
        fechaHoraInicio: datetime_start,
        fechaHoraFin: datetime_end,
        aforo: $("#aforo_simple").val(),
        idEspacio: idEspacio,
        ponentes: ponentes,
        grupos: grupos
    };

    return datos_actividad;
}

function crearActividad(idPadre, simple_compuesta, idEvento) {

    let datos_actividad

    if (simple_compuesta === "simple") {
        datos_actividad = obtenerDatosActividadSimple();
    } else {
        datos_actividad = obtenerDatosActividadCompuesta();
    }

    datos_actividad.isCompuesta = simple_compuesta === "compuesta";

    if ((idEvento == null) && simple_compuesta === "compuesta") {
        alert("Debe seleccionar un evento");
    } else {
        datos_actividad.idEvento = idEvento;
    }

    console.log(datos_actividad)

    $.ajax({
        url: 'api/actividad/insert',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(datos_actividad),
        dataType: 'json',
        success: function(response) {
            console.log(response);
            
            window.location.href = "http://localhost:8000/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CActividadCrudController";
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus);
            console.log(error);
        }
    });
}
