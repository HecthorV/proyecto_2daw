$( function() {
    // Función para descargar la plantilla CSV
    $("#downloadTemplate").click(function() {
        var csv = 'nombre,correo,fecha_nacimiento\n';
        // Agregar filas de ejemplo
        csv += 'Juan,juan@example.com,05/08/2006\n';
        csv += 'Maria,maria@example.com,13/02/1992\n';
        csv += 'Antonio,antonio@example.com,20/08/2002\n';

        var filename = 'plantilla.csv';
        var csvFile = new Blob([csv], {type: "text/csv"});
        var downloadLink = document.createElement("a");

        downloadLink.download = filename;
        // Descargar en el navegador
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        // click para iniciar la descarga
        downloadLink.click();
    });

    // Función para cargar el archivo CSV y mostrar su contenido en la consola
    $("#uploadCsv").change(function(ev) {
        var file = ev.target.files[0];
        // Lector para csv
            var reader = new FileReader();
            reader.onload = function(e) {
                var contents = e.target.result;
                var lines = contents.split('\n');
                var data = lines.map(function(line) {
                    return line.split(',');
                });

                console.log(data);
                data.shift()
                // data.pop()
                // console.log(data);


                $.ajax({
                    url: 'api/alumno/insertMasivo',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(textStatus, error) {
                        console.log('Error en la petición:');
                        console.log(textStatus);
                        console.log(error);
                    }
                });
            };
            reader.readAsText(file);
        });
});