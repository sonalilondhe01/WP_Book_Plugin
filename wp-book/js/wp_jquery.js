jQuery( document ).ready( function ( $ ) {

    /* author_name input validation */
    $('#author_name').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z ]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /* publisher input validation */
    $('#publisher').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z()&. _]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /* edition input validation */

    $('#edition').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z0-9()&. _]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
});