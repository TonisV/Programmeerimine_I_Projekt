

class CellData {

    constructor(eventElement, inputElement, url) {
        this.cellInput = eventElement.children(inputElement);
        this.cellInputParent = this.cellInput.parent();
        this.rowId = eventElement.parent().attr('id').split('-');
        this.cellName = this.cellInput.attr('name');
        this.cellData = this.cellInput.val();
        this.url = url;
    }

}


class Query {

    static inputUpdate(obj) {

        // Enable element
        obj.cellInput.prop("disabled", false);

        // After element loses focus save new value and disable element
        obj.cellInput.focusout(function () {

            // Holds old input value
            var cellOldData = obj.cellData;
            // Holds latest input value
            var cellNewData = obj.cellInput.val();
            // Ajax url for data handling
            var urlString = 'work_id=' + obj.rowId[1] + '&' + obj.cellName + '=' + cellNewData;

            // Update cell info only if it is changed
            if (cellOldData !== cellNewData) {
                // Send url to ajax function
                AjaxReq.postData(obj.url, urlString, 'inputUp', obj.cellInput);
            }

            // Disable element
            obj.cellInput.prop("disabled", true);
        });
    }

    static selectUpdate(obj) {
        // Ajax url for data handling
        var urlString = 'work_id=' + obj.rowId[1] + '&' + obj.cellName + '=' + obj.cellData;
        // Send url to ajax function
        AjaxReq.postData(obj.url, urlString, 'selectUp', obj.cellInput);
    }

    static selectInsert(obj) {
        // Holds select element value from last-row
        var selectedValue = obj.cellData;

        // If select element value is 2 then get all data from row and save it
        if (selectedValue === '2') {

            // Find all inputs in last row to make URL encoded string
            var urlString = obj.cellInputParent.find(':input').serialize();

            // Send url to ajax function
            AjaxReq.postData(obj.url, urlString, 'selectIn', '');

        }
    }

    static callbacks(callType, messageElement, data) {

        switch(callType) {
            case 'inputUp':
                data === 'success' ? toggleSuccessClass(messageElement) : toggleErrorClass(messageElement);
                break;
            case 'selectUp':
                data === 'success' ? toggleSuccessClass(messageElement) : toggleErrorClass(messageElement);
                break;
            case 'selectIn':
                // find out if returned message contains error information
                if (data.indexOf('error') >= 0) {
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
                break;
        }
    }
}


class AjaxReq {

    static postData(url, uString, callType, messageElement) {
        // Ajax  function for data sending
        $.post(url, uString, function (data) {
            // Callback function after response
            Query.callbacks(callType, messageElement, data);
        }, "text");
    }

}