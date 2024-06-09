
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

