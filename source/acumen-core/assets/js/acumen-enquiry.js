/**
 * Acumen RFQ Form AJAX Handler
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        var $form = $('#acumen-rfq-form');
        if (!$form.length) {
            return;
        }

        var $submitBtn = $('#acumen-rfq-submit-btn');
        var $btnText   = $submitBtn.find('span');
        var $feedback  = $('#acumen-rfq-feedback');

        $form.on('submit', function(e) {
            e.preventDefault();

            // Clear previous alerts
            $feedback.removeClass('success error').hide().empty();

            // Client-side validation
            var fullName = $.trim($('#rfq_full_name').val());
            var email    = $.trim($('#rfq_email').val());
            var phone    = $.trim($('#rfq_phone').val());
            var message  = $.trim($('#rfq_message').val());

            if (!fullName || !email || !phone || !message) {
                $feedback.addClass('error').text('Please fill in all required fields.').fadeIn();
                return;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $feedback.addClass('error').text('Please enter a valid email address.').fadeIn();
                return;
            }

            // Prepare Payload
            var originalBtnText = $btnText.text();
            $btnText.text(acumenEnquiryData.messages.submitting || 'Submitting...');
            $submitBtn.prop('disabled', true);

            var formData = $form.serializeArray();
            formData.push({ name: 'action', value: 'acumen_submit_rfq' });
            formData.push({ name: 'security', value: acumenEnquiryData.nonce });

            $.ajax({
                url: acumenEnquiryData.ajax_url,
                type: 'POST',
                data: $.param(formData),
                dataType: 'json'
            })
            .done(function(response) {
                if (response.success) {
                    $feedback.addClass('success').text(response.data.message).fadeIn();
                    $form[0].reset();
                } else {
                    var errorMsg = response.data && response.data.message ? response.data.message : acumenEnquiryData.messages.error;
                    $feedback.addClass('error').text(errorMsg).fadeIn();
                }
            })
            .fail(function() {
                $feedback.addClass('error').text(acumenEnquiryData.messages.error).fadeIn();
            })
            .always(function() {
                $btnText.text(originalBtnText);
                $submitBtn.prop('disabled', false);
            });
        });
    });
})(jQuery);
