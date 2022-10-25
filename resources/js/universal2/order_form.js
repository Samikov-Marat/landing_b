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
        $formElement = this.$form.find('input[name=customer_type]');
        if ((!$formElement.hasClass('js-form-order-customer-type-hidden')) && ($formElement.filter(':checked').length === 0)) {
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

        if ('loading' == state) {
            this.$form.addClass('calculator__content_loading');
            return;
        }
        if ('success' == state) {
            this.$form.removeClass('calculator__content_loading');

            var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
            $('#order-message-modal').closest('.modal-container').css('display', 'flex').css('padding-top', vscroll + 'px');
            $('#order-message-modal').addClass('modal-opened').css('display', 'block');
            $('#order-message-modal').find('.js-modal-result-ok').show();
            $('#order-message-modal').find('.js-modal-result-error').hide();

            this.$form[0].reset();
            return;
        }
        if ('error' == state) {
            this.$form.removeClass('calculator__content_loading');

            var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
            $('#order-message-modal').closest('.modal-container').css('display', 'flex').css('padding-top', vscroll + 'px');
            $('#order-message-modal').addClass('modal-opened').css('display', 'block');
            $('#order-message-modal').find('.js-modal-result-ok').hide();
            $('#order-message-modal').find('.js-modal-result-error').show();


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

    $('.js-order-form').on('focus click', '.form-field_error input', function () {
        $(this).closest('.form-field_error').removeClass('form-field_error');
    });

    $('.js-form-order-customer-type').on('change', function () {
        if ($(this).val() == 'legal_entity') {
            $('.js-form-order-org').removeClass('hidden');
        } else {
            $('.js-form-order-org').addClass('hidden');
        }
    });
});
