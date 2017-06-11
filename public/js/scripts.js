/*
 *
 * UPDATE CELL INFO AND ERROR HANDLING
 * Validates and saves data from last-row as new row
 *
 */
/*
$('.work-table tbody td').dblclick(function(event){
    event.preventDefault();

    var $cellInput = $(this).children('input');

    var rowId      = $(this).parent().attr('id').split('-');
    var cellName   = $cellInput.attr('name');
    var cellData   = $cellInput.val();

    // Ajax url for data handling
    var url = '?controller=worksheet&action=update';

    // Enable element
    $cellInput.prop("disabled", false);

    // After element loses focus Save new value and disable element
    $cellInput.focusout(function () {

        var cellNewData = $cellInput.val();
        var urlString  = 'work_id='+rowId[1]+'&'+cellName+'='+cellNewData;

        // Update cell info only if it is changed
        if (cellData !== cellNewData) {
            // Ajax  function for data sending
            $.post(url, urlString, function (data) {

                // find out if returned message contains error information
                if (data === 'success') {
                    // change input class if success
                    toggleSuccessClass($cellInput);
                } else {
                    // log errors
                    console.log(data);
                    // change input class if error
                    toggleErrorClass($cellInput);
                }
            }, "text");
        }
        // Disable element
        $cellInput.prop("disabled", true);
    });

});*/

// Updates data from input elements
$('.work-table tbody td').dblclick(function(event){
    event.preventDefault();
    new UpdateCell($(this), 'input');
});

// Updates data from select elements
$('.work-table tbody td').change(function(event){
    event.preventDefault();
    new UpdateCell($(this), 'select');
});

/*
*
* INSERT NEW ROW AND ERROR HANDLING
* Saves data from last row with Ajax request
*
*/
$('#last-row-select').change(function(){

    // Holds select element value from last-row
    var selectedValue = $(this).val();

    // If select element value is 2 then get all data from row and save it
    if (selectedValue === '2') {

        // Find all inputs in last row to make URL encoded string
        var urlString = $('#last-row').find(':input').serialize();

        // Ajax url for data handling
        var url = '?controller=worksheet&action=insert';

        // Ajax  function for data sending
        $.post(url, urlString, function (data) {

            // find out if returned message contains error information
            if (data.indexOf('error') >= 0) {

                // log errors
                console.log(data);

                // change last-row class if error
                toggleErrorClass($('#last-row'));
                // Restore default value
                $('#last-row-select').val('1');

            } else {

                // If save was successful then append worksheet table with new data
                $(".work-table tbody").append(data);
                toggleSuccessClass($('.work-table tbody tr:last'));
                // Restores default settings in last row
                $(':input','#last-row').val('');
                $('#last-row-select').val('1');

            }
        }, "text");
    }

});


$('.row-select').change(function(){
    toggleSelectClass($(this));
});


/*
 *
 * HELPER FUNCTIONS
 *
 */

function toggleErrorClass(location) {
    location.addClass('error');
    setTimeout(function() {
        location.removeClass('error');
    }, 5000);
}

function toggleSuccessClass(location) {
    location.addClass('success');
    setTimeout(function() {
        location.removeClass('success');
    }, 1000);
}

function toggleSelectClass(location) {
    var selectVal = location.val();
    switch(selectVal) {
        case '2':
            location.removeClass().addClass('row-select waiting');
            break;
        case '3':
            location.removeClass().addClass('row-select notified');
            break;
        case '4':
            location.removeClass().addClass('row-select paid');
            break;
        default:
            location.removeClass().addClass('row-select');
    }
}
