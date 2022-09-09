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
        $formElement = this.$form.find('input[name=have_invoice]');
        if ($formElement.length && $formElement.filter(':checked').length == 0) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('input[name=invoice_number]');
        let $hasInvoice = this.$form.find('.js-support-have-invoice:checked');
        if ($hasInvoice.length && ($hasInvoice.val() == '1') && !/\d{10}/.test($formElement.val())) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('select[name=summary]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = this.$form.find('textarea[name=question]');
        if ($formElement.val() === '') {
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

        if ('new' == state) {
            this.$form[0].reset();
            let $preloader = this.$form.closest('.preloader');
            $preloader.removeClass('preloader_loading');
            $('.js-support-form-wrapper').show();
            $('.js-support-result-ok-wrapper').hide();
            $('.js-feedback-result-error-wrapper').hide();
            $('.js-support-invoice-number-row').hide();
            $('.js-support-have-invoice').prop('checked', false);
            return;
        }
        if ('retry' == state) {
            let $preloader = this.$form.closest('.preloader');
            $preloader.removeClass('preloader_loading');
            $('.js-support-form-wrapper').show();
            $('.js-support-result-ok-wrapper').hide();
            $('.js-feedback-result-error-wrapper').hide();
            return;
        }

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


$(function (){
    $('.js-support-have-invoice').on('change', function (){
        if($(this).prop('checked') && ($(this).val() == '1')){
            $('.js-support-invoice-number-row').show();
        }
        else{
            $('.js-support-invoice-number-row').hide();
        }
    });
});


$(function (){
    $('.js-support-new-answer').click(function (){
        let $form = $('.js-support-form');
        let feedbackForm = new universal2SupportForm($form);
        feedbackForm.setState('new');
        return false;
    });
});

$(function (){
    $('.js-support-retry').click(function (){
        let $form = $('.js-support-form');
        let feedbackForm = new universal2SupportForm($form);
        feedbackForm.setState('retry');
        return false;
    });
});

$(function (){
    $('.support-focus-reset-error').on('focus select2:opening click', function (){
        $(this).closest('.form-field').removeClass('form-field_error');
    });
});
