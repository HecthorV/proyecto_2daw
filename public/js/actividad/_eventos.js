
// function encenderSelectElegirSimpleCompuesta() {
    
//     $("#elegir_simple_compusesta").change(function (e) { 
//         // e.preventDefault();
        
//         console.log(this.value);
//         console.log(e);
//     });
// }

function cargarEventos() {
    $.ajax({
        url: 'api/eventos/findAll',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const item of response) {
                // $("#eventos").append(
                //     $('<option>', {
                //         value: item.id,
                //         text: item.nombre
                //     })
                // );

                const option = $('<option>');
                option.val(item.id)
                option.text(item.nombre)

                $("#eventos").append(option);
            }
        },
        error: function(textStatus, error) {
            console.error('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });
}

function crearTabsActividad() {
    $("span.icon").on("click", function () {
        $("div[name='para_anadir_actividad']").removeClass("deshabilitado");
    })
}

function cargarActividadesPadre() {
    $.ajax({
        url: 'api/actividad/findAll',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);

            for (const item of response) {

                const divActividad = $('<div>', {
                    class: 'actividad d-flex justify-content-space-around',
                    "data-id": item.id
                });

                const pNombre = $('<p>',{
                    text: item.nombre
                });

                let fechaInicio = new Date(item.fechaHoraInicio.date);
                let fechaFin = new Date(item.fechaHoraFin.date);

                let fechaInicioFormateada = fechaInicio.getDate() + "/" + (fechaInicio.getMonth()+1) + "/" + fechaInicio.getFullYear() + " " + fechaInicio.getHours() + ":" + fechaInicio.getMinutes();
                let fechaFinFormateada = fechaFin.getDate() + "/" + (fechaFin.getMonth()+1) + "/" + fechaFin.getFullYear() + " " + fechaFin.getHours() + ":" + fechaFin.getMinutes();

                const pRangoFechas = $('<p>',{
                    text: fechaInicioFormateada + " hasta " + fechaFinFormateada
                });

                divActividad.append(pNombre);
                divActividad.append(pRangoFechas);

                $("#listaActividades").append(divActividad);
            }

            $('#listaActividades').on('click', '.actividad', function() {
                $('.actividad').removeClass('selected');
                $(this).addClass('selected');
            });
        },
        error: function(textStatus, error) {
            console.error('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });
}

