$(function () {

    $("#btnAltaMasiva").on('click', function() {
        $("#modalAltaMasiva").dialog("open");
    })

})

$("#modalAltaMasiva").dialog("open")
$("#modalAltaMasiva").dialog("close")
$("div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-draggable.ui-resizable").remove()