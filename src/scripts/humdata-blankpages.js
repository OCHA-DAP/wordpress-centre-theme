(function ($) {

    $(document).ready(function () {
        var $registrationForm = $('#hdf2024 #registration-form').first();
        var $submitBtn = $registrationForm.find('.btn');
        var $consentCheckbox = $registrationForm.find('#consent');
        var $confirmationMessage = $('#hdf2024 #registration-submitted');

        $consentCheckbox.on('change', function () {
            if (this.checked) {
                $submitBtn.removeAttr('disabled');
            } else {
                $submitBtn.attr('disabled', 'disabled');
            }
        });

        $registrationForm.on('submit', function (e) {
            $submitBtn.attr('disabled', 'disabled');
            e.preventDefault();
            let requestBody = new FormData(this);
            requestBody.append('source_url', window.location.href);
            $.ajax({
                url: 'https://script.google.com/macros/s/AKfycbzl2sSg0qMQ_zKEKLCO6Ic9bpZf4GNUMJtYJgVBul7ZtPXuP47_gG6OEiWFlipXqOs/exec',
                method: 'POST',
                data: requestBody,
                processData: false,
                contentType: false,
                success: function (response) {
                    $registrationForm.addClass('d-none');
                    $confirmationMessage.removeClass('d-none');
                },
                error: function (xhr, status, error) {
                    $submitBtn.removeAttr('disabled');
                    alert(error);
                    console.log(xhr);
                    console.log(status);
                }
            });
        });
    });

})(jQuery);
