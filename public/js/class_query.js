/*
 *
 * CLASS Query
 * Makes queries with Ajax requests
 *
 */

class Query {

    // Saves input after double clicking in row cell and changing value
    static updateInputData() {
        $(document).on('dblclick','.work-table tbody td', function(event){
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

                    // If all ok then delete selected row
                    if (cellName === 'client_name' && cellNewData.indexOf('DE') >= 0) {
                        Query.deleteRow($('#row-'+rowId[1]), rowId[1], cellNewData);
                    } else {
                        // Ajax  function for data sending
                        $.post(url, urlString, function (data) {
                            // find out if returned message contains error information
                            if (data === 'success') {
                                // change input class if success
                                Helper.toggleSuccessClass($cellInput);
                            } else {
                                // log errors
                                console.log(data);
                                // change input class if error
                                Helper.toggleErrorClass($cellInput);
                            }
                        }, "text");
                    }

                }

                // Disable element
                $cellInput.prop("disabled", true);
            });

        });
    }

    // Saves input after selecting value in select element
    // if selected value equals 4 then saves and gets check_out_time from server
    static updateSelectData() {
        $(document).on('change', '.work-table-row .select-cell', function(event){
            event.preventDefault();

            var $cellInput   = $(this).children('select');
            var rowId        = $(this).parent().attr('id').split('-');
            var workCheckOut = $(this).parent().find($('.work-check-out'));
            var cellName     = $cellInput.attr('name');
            var cellData     = $cellInput.val();

            // Ajax url for data handling
            var url = '?controller=worksheet&action=update';
            // Ajax url with data
            var urlString  = 'work_id='+rowId[1]+'&'+cellName+'='+cellData;

            // Ajax  function for data sending
            $.post(url, urlString, function (data) {

                // find out if returned message contains error information
                if (data.indexOf('error') >= 0) {

                    // log errors
                    console.log(data);
                    // change input class if error
                    Helper.toggleErrorClass($cellInput);

                } else {

                    // change input class if success
                    Helper.toggleSuccessClass($cellInput);

                    if (cellData === '4') {
                        // Change timestamp in correct cell
                        workCheckOut.html(data);
                        // Disable element
                        $cellInput.prop("disabled", true);
                    }

                }

            }, "text");

        });
    }

    // Saves data from last row and inserts new row in table
    static insertNewRow() {
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
                        Helper.toggleErrorClass($('#last-row'));
                        // Restore default value
                        $('#last-row-select').val('1');

                    } else {

                        // If save was successful then insert new row
                        $(".work-table tbody").append(data);
                        // change last-row class if success
                        Helper.toggleSuccessClass($('.work-table tbody tr:last'));
                        // Restores default settings in last row
                        $(':input','#last-row').val('');
                        $('#last-row-select').val('1');

                    }

                }, "text");
            }

        });
    }

    // If message is right then delete row
    static deleteRow($row, $id, $message) {

        // Ajax url for data handling
        var url = '?controller=worksheet&action=delete';
        // Ajax url with data
        var urlString  = 'work_id=' + $id + '&client_name=' + $message;

        // Ajax  function for data sending
        $.post(url, urlString, function (data) {

            // find out if returned message contains error information
            if (data.indexOf('error') >= 0) {
                // log errors
                console.log(data);
            } else {
                // change input class if success
                console.log(data);
                $row.remove();
            }

        }, "text");

    }

}