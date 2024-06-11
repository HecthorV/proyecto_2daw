$(function () {
    anadirModal()
})

function anadirModal() {
    var modalHTML = `
        <div id="modalAltaMasiva" class="modal" title="ALTA MASIVA">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Contenido del modal...</p>
            </div>
        </div>
    `;

    $("aside").append(modalHTML);

    $("#modalAltaMasiva").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Cerrar: function() {
                $(this).dialog("close");
            }
        }
    });
    // $("#modalAltaMasiva").dialog()
    // $("div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-draggable.ui-resizable").remove()
    anadirBtnModal()
}

function anadirBtnModal() {

    const btnAltaMasiva = $('<button>', {
        text: 'Alta masiva',
        class: 'action-new btn btn-secondary',
        id: 'btnAltaMasiva'
    });

    $("div.page-actions").append(btnAltaMasiva);

    btnAltaMasiva.on('click', function() {
        $("#modalAltaMasiva").dialog("open");
    })
}