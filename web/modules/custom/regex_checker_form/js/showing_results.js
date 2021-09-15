(fucntion ($, Drupal) {
    'use strict';

    $(document).ready(function() {
        console.log("Form is ready!");

        $("#regexp_checker_button").click(() => {
            let element = $('#regexp_checker_final_result');

            // add some info over html element

            element.html("<p><strong>Update-> will be processed with the regular expression:</strong></p>")
            // for testing
            console.log("Update-> will be processed the regular expression:");
        });
    });
})(jQuery, Drupal);