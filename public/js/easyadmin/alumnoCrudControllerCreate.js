$(function () {

    const btnAltaMasiva = $('<button>', {
        text: 'Alta masiva',
        class: 'action-new btn btn-secondary',
        id: 'btnAltaMasiva'
    });

    $("div.page-actions").append(btnAltaMasiva);

    var modalHTML = `
            <div id="modalAltaMasiva" class="modal" title="ALTA MASIVA">
                <div class="modal-content">
                    <main>
                        <div id="container" class="container-fluid">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h1>Alta masiva de personas</h1>
                                </div>
                            </div>
                            <div class="row mt-10">
                                <div class="col-12">
                                    <div class="d-flex justify-content-around">
                                        <button id="downloadTemplate">Descargar plantilla CSV</button>
                                        <input type="file" id="uploadCsv" accept=".csv">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        `;

    $("aside").append(modalHTML);



    $("#modalAltaMasiva").dialog({
        autoOpen: false,
        modal: true,
        width: 500,
        height: 400,
        buttons: {
            Cerrar: function() {
                $(this).dialog("close");
            }
        }
    });

    $("#modalAltaMasiva").dialog()
    $("#modalAltaMasiva").dialog("close")
})