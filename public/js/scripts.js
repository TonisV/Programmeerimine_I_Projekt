/*
 *
 * UPDATE CELL INFO AND ERROR HANDLING
 *
 *
 */

// Holds inputs parent selector
//var $tableCell = $('.work-table tbody td');

// Updates data from input element
$('.work-table tbody td').dblclick(function(event){
    event.preventDefault();
    var cell = new CellData(
        $(this),
        'input',
        '?controller=worksheet&action=update'
    );
    Query.inputUpdate(cell);
});

// Updates data from select element
$('.work-table-row .select-cell').change(function(event){
    event.preventDefault();
    var cell = new CellData(
        $(this),
        'select',
        '?controller=worksheet&action=update'
    );
    Query.selectUpdate(cell);
});

// Inserts new row
$('#last-row .select-cell').change(function(){
    var cell = new CellData(
        $(this),
        'select',
        '?controller=worksheet&action=insert'
    );
    Query.selectInsert(cell);
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


/*
 *
 * HELPER FUNCTIONS
 *
 */

$('.row-select').change(function(){
    toggleSelectClass($(this));
});

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
