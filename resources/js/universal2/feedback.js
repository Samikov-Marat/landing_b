function universal2FeedbackForm($form) {
    this.$form = $form;
    this.$modalContent = this.$form.closest('.modal__content');
    this.recaptchaToken = '';

    this.submit = function () {

        if (this.hasError()) {
            return;
        }

        $('body').trigger('gtm:event', [$form.data('sendFormEvent')]);

        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('universal2/feedback');

        let thisForCallback = this;
        recaptchaExt.execute(function (token) {
            thisForCallback.setRecaptchaToken(token).send();
        });

    }

    this.hasError = function () {
        let hasError = false;
        let $formElement = this.$form.find('input[name=name]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('input[name=phone]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('input[name=email]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('input[name=agree]');
        if (!$formElement.prop('checked')) {
            $formElement.closest('.form__row').addClass('form-field_error');
            hasError = true;
        }

        $formElement = this.$form.find('input[name=customer_type]');
        if ((!$formElement.hasClass('js-form-order-customer-type-hidden')) && ($formElement.filter(':checked').length === 0)) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        return hasError;
    }

    this.setRecaptchaToken = function (recaptchaToken) {
        this.recaptchaToken = recaptchaToken;
        return this;
    }

    this.send = function () {
        let formExtended = this.$form.serializeArray();
        formExtended.push({name: 'recaptcha_token', value: this.recaptchaToken});
        formExtended.push({name: 'url', value: window.location.href});
        let request = {
            url: this.$form.prop('action'),
            data: formExtended
        };

        let thisForCallback = this;
        thisForCallback.setState('loading');
        $.post(request).done(function () {
            thisForCallback.setState('success');
        }).fail(function () {
            thisForCallback.setState('error');
        });
    }

    this.setState = function (state) {
        if ('open' == state) {
            $('.js-modal-result-ok').hide();
            $('.js-modal-result-error').hide();
            this.$modalContent.removeClass('modal__content_loading').show();
            this.$modalContent.find('textarea[name=message]').val('');
            return;
        }


        if ('loading' == state) {
            this.$modalContent.addClass('modal__content_loading');
            return;
        }
        if ('success' == state) {
            this.$modalContent.hide();
            $('.js-modal-result-ok')
                .css('height', this.$modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
            return;
        }
        if ('error' == state) {
            this.$modalContent.hide();
            $('.js-modal-result-error')
                .css('height', this.$modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
            return;
        }
    }
}


$(function () {
    $('.js-feedback-open').click(function () {

        let eventAttr = $(this).data('send-form-event');
        if ((eventAttr !== undefined) && (eventAttr !== '')) {
            $('.js-feedback-form').data('data-send-form-event', eventAttr);
        }

        let feedbackForm = new universal2FeedbackForm($('.js-feedback-form'));
        feedbackForm.setState('open');
        modalOpen($('#feedback-modal'));
        return false;
    });

    $('.js-feedback-form').submit(function () {
        let $form = $(this);
        let feedbackForm = new universal2FeedbackForm($form);
        feedbackForm.submit();
        return false;
    });
});

$(function () {
    $('.js-feedback-open').click(function () {

    });
});