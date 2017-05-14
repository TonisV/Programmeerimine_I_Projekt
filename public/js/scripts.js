/*
*
* TV Worksheet - Scripts
*
*/

$(function() {

});


/* Double click events in rows */
$('.work-table tbody td').dblclick(function(event){
    event.preventDefault();

    var $cellInput = $(this).children('input');

    var rowId      = $(this).parent().attr('id');
    var cellName   = $cellInput.attr('name');
    var cellData   = $cellInput.val();

    // Enable element
    $cellInput.prop("disabled", false);

    // After element loses focus Save new value and disable element
    $cellInput.focusout(function () {
        if (cellData !== $cellInput.val()) {
            saveCell(rowId, cellName, $cellInput.val());
        }
        $cellInput.prop("disabled", true);
    });

});

/* Last row select event */
$('#last_row_select').change(function(){

    var selectedValue = $(this).val();
    var cells = $('#lastrow').find(':input').serializeArray();



    // Enable element
    if (selectedValue === 2) {
        saveNewRow(cells);
    }

});


function saveCell(rowId, cellName, data) {
    console.log('saved - ' + rowId + ', ' + cellName + ', ' + data);
}

function saveNewRow(cells) {
    console.log('saved - ' + cells);
}

function updateRow(rowId, cells) {
    console.log('saved - ' + rowId + ', ' + cells);
}
