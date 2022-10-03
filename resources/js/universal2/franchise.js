function universal2FranchiseForm($form) {
    this.$form = $form;
    this.recaptchaToken = '';

    this.submit = function () {

        if (this.hasError()) {
            return;
        }

        $('body').trigger('gtm:event', [$form.data('sendFormEvent')]);

        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('universal2/franchise');

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

        if ('new' == state) {
            this.$form[0].reset();
            this.$form.removeClass('preloader_loading');

            this.$form.show();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-success').hide();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-error').hide();


            return;
        }
        if ('retry' == state) {
            this.$form.show();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-success').hide();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-error').hide();
            return;
        }

        if ('loading' == state) {
            this.$form.addClass('preloader_loading');
            return;
        }
        if ('success' == state) {
            this.$form.removeClass('preloader_loading');
            this.$form.hide();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-success').show();
            return;
        }

        if ('error' == state) {
            this.$form.removeClass('preloader_loading');
            this.$form.hide();
            this.$form.closest('.js-franchise-form-wrapper').find('.js-franchise-error').show();
            return;
        }
    }
}


$(function () {
    $('.js-franchise-form').submit(function () {
        let $form = $(this);
        let feedbackForm = new universal2FranchiseForm($form);
        feedbackForm.submit();
        return false;
    });
});


$(function () {
    $('.js-franchise-format-handler').click(function () {

        $(this).addClass('submenu__item_active');
        $('.js-franchise-format-handler').not(this).removeClass('submenu__item_active');

        let format = $(this).data('format');
        $('.js-franchise-format').each(function (i, v) {
            if ($(v).data('format') == format) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
        return false;
    });
});

$(function (){
    $('.js-franchise-new-answer').click(function (){
        let $form = $('.js-franchise-form');
        let feedbackForm = new universal2FranchiseForm($form);
        feedbackForm.setState('new');
        return false;
    });
});

$(function (){
    $('.js-franchise-retry').click(function (){
        let $form = $('.js-franchise-form');
        let feedbackForm = new universal2FranchiseForm($form);
        feedbackForm.setState('retry');
        return false;
    });
});

$(function (){
    $('.franchise-focus-reset-error').on('focus click change', function (){
        $(this).closest('.form-field, .form__row').removeClass('form-field_error');
    });
});
