// Datos que deseas enviar al servidor
var data = {
    "nombre": "Partido de fútbol",
    "fechaHoraInicio": "2020/05/21",
    "fechaHoraFin": "2020/06/10",
    "aforo": "6",
    "isCompuesta": "1",

    "arrayPonentes": "[]",
    "espacioId" : "45",
};

// Configuración de la petición AJAX
$.ajax({
    url: 'tu/servidor/ficticio',
    method: 'POST',
    data: JSON.stringify(data),
    dataType: 'json',
    success: function(response) {
        console.log('Respuesta exitosa:');
        console.log(response); // Aquí puedes hacer algo con la respuesta del servidor
    },
    error: function(textStatus, error) {
        console.log('Error en la petición:');
        console.log(textStatus); // Aquí puedes mostrar el tipo de error
    }
});
