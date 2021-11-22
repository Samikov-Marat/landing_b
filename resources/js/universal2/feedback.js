$(function () {

    $('.js-feedback-open').click(function () {
        $('.js-modal-result-ok').hide();
        $('.js-modal-result-error').hide();
        $('.modal__content_form').removeClass('modal__content_loading').show();
        $('.modal__content_form').find('textarea[name=message]').val('');

        modalOpen($('#feedback-modal'));
        return false;
    });

    function sendFeedback($form, token) {

        let hasError = false;
        let $formElement = $form.find('input[name=name]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=phone]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=email]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=agree]');
        if (!$formElement.prop('checked')) {
            $formElement.closest('.form__row').addClass('form-field_error');
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

        var modalContent = $form.closest('.modal__content');
        modalContent.addClass('modal__content_loading');

        $.post(request).done(function () {
            modalContent.hide();
            $('.js-modal-result-ok')
                .css('height', modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
        }).fail(function () {
            modalContent.hide();
            $('.js-modal-result-error')
                .css('height', modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
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
