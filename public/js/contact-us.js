(function () {

    var validateFormFields = [
        '_token'
    ];

    $(document).ready(function() {



        // process the form
        $('form').submit(function(event) {


            var formData = {
                '_token': $('#contact-us-form input[name=_token]').val(),
                'full_name': $('#contact-us-full_name').val(),
                'email': $('#contact-us-email').val(),
                'phone': $('#contact-us-phone').val(),
                'message': $('#contact-us-message').val()
            };


            /*
                Reset the errors elements everytime we submit the form
             */
            clearErrors(formData);

            /*
                get the contact us from data
            */

            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'contact-us', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                .error(function(xhr, status, error) {

                    /*
                        422 status tells us there are validation errors from the server
                     */
                    if (xhr.status === 422) {
                        handleValidationError(formData, xhr);
                    } else {
                        handleServerError();
                    }
                })
                .done(function(data) {
                    $('#contact-us-content').addClass('hidden');
                    $('#contact-us-success').removeClass('hidden');
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });
    });

    /**
     * Handle the validation errors by setting the proper styles and error messages for
     * the user.
     * @param formData
     * @param xhr
     */
    function handleValidationError(formData, xhr) {

        const formFields = Object.keys(formData);
        const errors = xhr.responseJSON.errors;

        $('#contact-us-error-message').text('Please fix the issues and resubmit');

        /*
         Loop over all of the fields that were submitted to the server in the formData class
         */
        for (var i=0; i<formFields.length; i++) {

            /*
             Check to see if we should be concerned about validation for the form field
             */
            if (validateFormFields.indexOf(formFields[i])) {

                /*
                 Empty the form help element of any contents
                 */
                $('#contact-us-help-' + formFields[i]).empty();

                /*
                 Check to see if the field was returned in the errors obtained from the server
                 */
                if (errors.hasOwnProperty(formFields[i])) {
                    $('#contact-us-label-' + formFields[i]).addClass('text-danger');
                    $('#contact-us-help-' + formFields[i]).addClass('text-danger');
                    for (var j=0; j<errors[formFields[i]].length; j++) {
                        $('#contact-us-help-' + formFields[i]).append('<li>' + errors[formFields[i]][j] + '</li>');
                    }
                } else {
                    $('#contact-us-label-' + formFields[i]).removeClass('text-danger');
                    $('#contact-us-help-' + formFields[i]).removeClass('text-danger');
                }
            }
        }

        $('#contact-us-errors').removeClass('hidden');
    }

    /**
     * Handle all errors other than Validation Errors
     */
    function handleServerError() {
        $('#contact-us-error-message').text('We seem to have run into an issue receiving your message. Our developers have been notified and will look into the issue.');
        $('#contact-us-errors').removeClass('hidden');
    }

    /**
     * Clear all the errors on the contact us form
     */
    function clearErrors(formData) {

        const formFields = Object.keys(formData);

        $('#contact-us-errors').addClass('hidden');
        $('#contact-us-error-message').empty();

        /*
         Loop over all of the fields that were submitted to the server in the formData class
         */
        for (var i=0; i<formFields.length; i++) {

            /*
             Check to see if we should be concerned about validation for the form field
             */
            if (validateFormFields.indexOf(formFields[i])) {

                /*
                 Empty the form help element of any contents
                 */
                $('#contact-us-help-' + formFields[i]).empty().removeClass('text-danger');
                $('#contact-us-label-' + formFields[i]).removeClass('text-danger');
            }
        }
    }
})();
