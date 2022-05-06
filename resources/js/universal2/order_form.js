function universal2OrderForm($form) {
    this.$form = $form;
    this.recaptchaToken = '';

    this.submit = function () {

        if (this.hasError()) {
            return;
        }

        $('body').trigger('gtm:event', [$form.data('sendFormEvent')]);

        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('universal2/feedback');


        this.setState('loading');
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
            return;
        }


        if ('loading' == state) {
            this.$form.addClass('calculator__content_loading');
            return;
        }
        if ('success' == state) {
            this.$form.removeClass('calculator__content_loading');
            this.$form[0].reset();
            return;
        }
        if ('error' == state) {
            this.$form.removeClass('calculator__content_loading');
            return;
        }
    }
}


$(function () {

    $('.js-order-form').submit(function () {
        let $form = $(this);
        let orderForm = new universal2OrderForm($form);
        orderForm.submit();
        return false;
    });

    $('.js-order-form').on('focus click', '.form-field_error input', function (){
        $(this).closest('.form-field_error').removeClass('form-field_error');
    });

});
