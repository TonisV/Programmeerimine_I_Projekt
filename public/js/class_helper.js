/*
 *
 * CLASS Helper
 * Contains helper functions
 *
 */

class Helper {

    // Change select element class when changing values
    static changeSelectClass() {
        $(document).on('change', '.row-select', function(){
            Helper.toggleSelectClass($(this));
        });
    }

    static toggleErrorClass(location) {
        location.addClass('error');
        setTimeout(function() {
            location.removeClass('error');
        }, 5000);

    }

    static toggleSuccessClass(location) {
        location.addClass('success');
        setTimeout(function() {
            location.removeClass('success');
        }, 1000);

    }

    static toggleSelectClass(location) {
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

}