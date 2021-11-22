$(function () {

    function sendFeedback($form, token) {

        let hasError = false;
        let $formElement = $form.find('input[name=name]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=email]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        if (hasError) {
            return false;
        }

        $('body').trigger('gtm:event', [$form.data('sendFormEvent')]);

        let formExtended = $form.serializeArray();
        formExtended.push({name: 'recaptcha_token', value: token});
        let request = {
            url: $form.prop('action'),
            data: formExtended
        };

        var $content = $form.closest('.office-page-feedback__content');
        $content.addClass('office-page-feedback__content_loading');

        $.post(request).done(function () {
            setTimeout(function () {
                $content.removeClass('office-page-feedback__content_loading');
                $content.find('.js-result-hide').hide();
                $content.find('.js-result-ok').show();
            }, 1500);
        }).fail(function () {
            setTimeout(function () {
                $content.removeClass('office-page-feedback__content_loading');
                $content.find('.js-result-hide').hide();
                $content.find('.js-result-failed').show();
            }, 1500);
        });

        return false;
    }

    function recaptcha(sendform) {
        grecaptcha.ready(function () {
            let key = $('#recaptcha_script').data('key');
            grecaptcha.execute(key, {action: 'submit'})
                .then(function (token) {
                    sendform(token);
                });
        });
    }



    $('.js-feedback-form').submit(function () {
        let $form = $(this);
        recaptcha(function (token) {
            sendFeedback($form, token);
        });
        return false;
    });



});



