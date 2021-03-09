jQuery( document ).ready( function ( $ ) {

    /* author_name input validation */
    $('#wp_author').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z ]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /* publisher input validation */
    $('#wp_publisher').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z()&. _]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /* edition input validation */

    $('#wp_edition').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z0-9()&. _]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /* edition input validation

    $('#url').on('keypress', function (event) {
        let regex = new RegExp("[a-zA-Z.:\]+$");
        let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

     */
});