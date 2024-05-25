
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
                $("#eventos").append(
                    $('<option>', {
                        value: item.id,
                        text: item.nombre
                    })
                );
            }
        },
        error: function(textStatus, error) {
            console.log('Error en la petición:');
            console.log(textStatus); // Aquí puedes mostrar el tipo de error
        }
    });

    $('#eventos').on('change', function(e) {
        
        $('#evento_seleccionado').val( $(this).val() );

    });
}