jQuery(document).ready(
    function ( $ ) {
        'use strict';

        /**
         * All of the code for your admin-facing JavaScript source
         * should reside in this file.
         */

        /**
         * Form validation for author name field
         */
        $('#wp_author').on(
            'keypress', function (event) {
                let regex = new RegExp("[a-zA-Z ]+$");
                let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        );

        /**
         * Form validation for publisher input field
         */
        $('#wp_publisher').on(
            'keypress', function (event) {
                let regex = new RegExp("[a-zA-Z()&. _]+$");
                let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        );

        /**
         * Form validation for edition input field
         */

        $('#wp_edition').on(
            'keypress', function (event) {
                let regex = new RegExp("[a-zA-Z0-9()&. _]+$");
                let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        );

        /**
         * Form validation for url input field
         */

        $('#wp_url').on(
            'keypress', function (event) {
                let regex = new RegExp("[a-zA-Z0-9()&.:@\?\/_]+$");
                let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        );

    }
)(jQuery);
