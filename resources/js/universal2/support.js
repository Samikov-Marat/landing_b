function universal2SupportForm($form) {
    this.$form = $form;
    this.recaptchaToken = '';

    this.submit = function () {

        if (this.hasError()) {
            return;
        }

        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('universal2/support');

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
        $formElement = this.$form.find('input[name=invoice_number]');
        if (! /\d{10}/.test($formElement.val())) {
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

        if ('loading' == state) {
            let $preloader = this.$form.closest('.preloader')
            $preloader.addClass('preloader_loading');
            return;
        }
        if ('success' == state) {
            let $preloader = this.$form.closest('.preloader');
            $preloader.removeClass('preloader_loading');
            $('.js-support-form-wrapper').hide();
            $('.js-support-result-ok-wrapper').show();
            return;
        }

        if ('error' == state) {
            let $preloader = this.$form.closest('.preloader');
            $preloader.removeClass('preloader_loading');
            $('.js-support-form-wrapper').hide();
            $('.js-feedback-result-error-wrapper').show();
            return;
        }
    }
}


$(function () {
    $('.js-support-form').submit(function () {
        let $form = $(this);
        let feedbackForm = new universal2SupportForm($form);
        feedbackForm.submit();
        return false;
    });
});
