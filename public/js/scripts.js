/*
*
* TV Worksheet - Scripts
*
*/




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
$('#last-row-select').change(function(){

    // Get select element value
    var selectedValue = $(this).val();

    // If select element as value 2 then get all data from row and save it
    if (selectedValue === '2') {

        // Find all inputs in last row an make them as object
        var cells = $('#last-row').find(':input').serialize();

        // Save only if mobile number is found
        var testCell  = cells[1].value;
        if (testCell) {
            saveNewRow(cells);
        } else {
            alert('mobiilinumber on kohustuslik');
        }

    }

});


function saveCell(rowId, cellName, data) {
    console.log('saved - ' + rowId + ', ' + cellName + ', ' + data);
}

function saveNewRow(cells) {
    var formdata = JSON.stringify(cells);
    alert (formdata);
    console.log('saved - ' + cells);
}

function updateRow(rowId, cells) {
    console.log('saved - ' + rowId + ', ' + cells);
}
