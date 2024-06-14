$(function () {

    const listadoActividades = $("#listadoActividades")

    $.ajax({
        url: '/api/actividad/findAll/completo',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const item of response) {
                console.log(item);

                let nombreEvento = item.evento == null ? 'SIN EVENTO' : item.evento.nombre;
                let fechaHoraInicioFin = formatearFechaHora(item.fechaHoraInicio.date) + ' - ' + formatearFechaHora(item.fechaHoraFin.date);
                
                // TODO bucle para recorer sus simples y crear más div.simple
                let fechaHoraInicioFin_simple = formatearFechaHora(item.fechaHoraInicio.date) + ' - ' + formatearFechaHora(item.fechaHoraFin.date);
                let descripcion_simple = item.descripcion == null ? '' : item.descripcion

                console.log(formatearFechaHora(item.fechaHoraInicio.date))
                // Añadir el literal al div
                listadoActividades.append(`
                    <div class="col-md-6 col-lg-3 wow fadeIn actividad" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">
                        <div class="product-item text-center border h-100 p-4">
                            <a href="" name="nombre" class="h6 d-inline-block mb-2">${item.nombre}</a>
                            <p name="fechaHoraInicioFin_compuesta">${fechaHoraInicioFin}</p>
                            <div name="detallesActividades">
                                <div class="simple">
                                    <p name="descripcion">${descripcion_simple}</p>
                                    <p name="fechaHoraInicioFin">${fechaHoraInicioFin_simple}</p>
                                    <p name="evento">${nombreEvento}</p>
                                </div>
                            </div>
                            <a href="" class="btn btn-outline-primary px-3">Suscribirse</a>
                        </div>
                    </div>
                `);
            }
        },
        error: function(textStatus, error) {
            console.error('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });

})

function formatearFechaHora(fecha) {
    let date = new Date(fecha);
    let day = date.getDate().toString().padStart(2, '0');
    let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Los meses en JavaScript empiezan en 0
    let year = date.getFullYear();
    let hours = date.getHours().toString().padStart(2, '0');
    let minutes = date.getMinutes().toString().padStart(2, '0');

    return `${day}/${month}/${year} ${hours}:${minutes}`;
}