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
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    });

    // Función para cargar el archivo CSV y mostrar su contenido en la consola
    $("#uploadCsv").change(function(evt) {
        var file = evt.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var contents = e.target.result;
            var lines = contents.split('\n');
            var data = lines.map(function(line) {
                return line.split(',');
            });
            console.log(data);
        };
        reader.readAsText(file);
    });
});