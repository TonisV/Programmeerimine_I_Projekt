
class UpdateCell {

    constructor(clickElement, inputElement, cellDisable = false) {
        this.cellInput    = clickElement.children(inputElement);
        this.inputElement = inputElement;
        this.rowId        = clickElement.parent().attr('id').split('-');
        this.cellName     = this.cellInput.attr('name');
        this.cellData     = this.cellInput.val();
        this.url          = '?controller=worksheet&action=update';
        this.cellDisable  = cellDisable;
        this.update();
    }


    update() {

        // Holds error element location for error displaying
        var errorElement = this.cellInput;

        if (this.inputElement == 'input') {

            // Enable element
            this.cellInput.prop("disabled", false);

            // After element loses focus save new value and disable element
            this.cellInput.focusout(function () {

                // Holds latest input value
                var cellNewData = errorElement.val();
                // Ajax url for data handling
                var urlString  = 'work_id=' + this.rowId[1] + '&' + this.cellName + '=' + cellNewData;

                // Update cell info only if it is changed
                if (this.cellData !== cellNewData) {
                    postData(this.url, urlString, errorElement);
                }

                // Disable element
                this.cellInput.prop("disabled", true);
            });

        } else {
            var urlString = 'work_id=' + this.rowId[1] + '&' + this.cellName + '=' + this.cellData;

            this.postData(this.url, urlString, errorElement);
        }

    }

    postData(url, uString, errorElement) {
        // Ajax  function for data sending
        $.post(url, uString, function (data) {
            // find out if returned message contains error information
            if (data === 'success') {
                // change input class if success
                toggleSuccessClass(errorElement);
            } else {
                // log errors
                console.log(data);
                // change input class if error
                toggleErrorClass(errorElement);
            }
        }, "text");
    }

}