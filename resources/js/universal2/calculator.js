$(function () {
    $('.js-calculator-step1-button').click(function () {
        let $form = $(this).closest('form');
        let hasError = false;
        let $formElement = $form.find('input[name=from_id]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=to_id]');
        if ($formElement.val() === '') {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        $formElement = $form.find('input[name=mass]');
        if (isNaN($formElement.val()) || $formElement.val() <= 0) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=length]');
        if (isNaN($formElement.val()) || $formElement.val() <= 0) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=width]');
        if (isNaN($formElement.val()) || $formElement.val() <= 0) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=height]');
        if (isNaN($formElement.val()) || $formElement.val() <= 0) {
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        if (hasError) {
            return false;
        }
        $('.calculator__content_step1').addClass('calculator__content_loading');

        $('.js-calculator-header-from').html($form.find('input[name=from]').val());
        $('.js-calculator-header-to').html($form.find('input[name=to]').val());


        $('.js-calculator-header-mass').html($form.find('input[name=mass]').val());
        let volume = $form.find('input[name=length]').val() / 100 *
            $form.find('input[name=width]').val() / 100 *
            $form.find('input[name=height]').val() / 100;


        $('.js-calculator-header-volume').html(volume.toFixed(3));

        getTariffs();

        return false;
    });


    let calculatorClass = function (form) {
        this.form = form;

        this.step = 1;

        this.tariffsNotFound = false;

        this.getCalculateUrl = function () {
            return $('.js-calculator-form').data('calculate-url');
        }
        this.getTariffCodes = function () {
            return $('.js-calculator-form').data('tariff-ids');
        }

        this.getUsedCurrency = function () {
            return this.form.data('currencyCode');
        }

        this.getUsedCurrencyName = function () {
            return this.form.data('currencyName');
        }

        this.getCityCodeFrom = function () {
            return $('.js-calculator-from-id').val();
        }
        this.getCityCodeTo = function () {
            return $('.js-calculator-to-id').val();
        }

        this.getMass = function () {
            return $('.form-field__input[name=mass]').val();
        }

        this.getLength = function () {
            return $('.form-field__input[name=length]').val();
        }

        this.getWidth = function () {
            return $('.form-field__input[name=width]').val();
        }

        this.getHeight = function () {
            return $('.form-field__input[name=height]').val();
        }

        this.getLanguage = function () {
            return this.form.data('language');
        }

        this.getCustomerType = function () {
            return $('.form-field__input[name=customer_type]:checked').val() || $('.form-field__input[name=customer_type]').val();
        }

        this.getReceiverType = function () {
            return $('.form-field__input[name=receiver_type]').val();
        }

        this.getPageUri = function () {
            return $('.form-field__input[name=page]').val();
        }

        this.isShowPeriod = function () {
            return Boolean(this.form.data('showPeriod'));
        }

        this.getStep = function () {
            return this.step;
        }

        this.setStep = function (step) {
            this.step = step;
            return this;
        }

        this.sendForm = function(token){

            this.calculatorContent = this.form.find('.calculator__content');
            this.calculatorContent.addClass('calculator__content_loading');


            let formExtended = this.form.serializeArray();
            formExtended.push({name: 'recaptcha_token', value: token});
            formExtended.push({name: 'url', value: window.location.href});
            let request = {
                url: this.form.prop('action'),
                data: formExtended
            };

            let thisForCallback = this;
            $.post(request).done(function () {
                $('.calculator__content_step3').hide();
                $('.js-calculator__content_step-result-ok')
                    .css('height', thisForCallback.calculatorContent.css('height'))
                    .removeClass('calculator__content_loading')
                    .show();
            }).fail(function () {
                $('.calculator__content_step3').hide();
                $('.js-calculator__content_step-result-error')
                    .css('height', thisForCallback.calculatorContent.css('height'))
                    .removeClass('calculator__content_loading')
                    .show();
            });
        }
    };

    let calculator = new calculatorClass($('div.calculator form'));

    let tariffApiClass = function () {
        this.url = calculator.getCalculateUrl();
        this.getSettings = function (serviceParameters) {
            return {
                method: 'post',
                url: this.url,
                headers: {
                    'access-control-allow-origin': '*',
                    'accept': 'application/json, text/plain, */*',
                    'content-type': 'application/x-www-form-urlencoded'
                },
                data: {
                    json: JSON.stringify(serviceParameters)
                },
                xhrFields: {
                    withCredentials: true
                }
            }
        }
    };

    let tariffApi = new tariffApiClass();

    function getTariffs() {
        let finishedRequest = {count: 0};
        let tariffCodes = calculator.getTariffCodes();

        $.post(calculator.getCalculateUrl(), {
            "sender_city_uuid": calculator.getCityCodeFrom(),
            "receiver_city_uuid": calculator.getCityCodeTo(),
            "mass": calculator.getMass(),
            "height": calculator.getHeight(),
            "width": calculator.getWidth(),
            "length": calculator.getLength(),
            "language": calculator.getLanguage(),
            "idCurrency": calculator.getUsedCurrency(),
            "customer_type": calculator.getCustomerType(),
            "receiver_type": calculator.getReceiverType(),
            "page": calculator.getPageUri()
        }).done(function(tariffs){
            showTariffs(tariffs);
        });

        return;
    }

    function showTariffs(tariffs) {
        if (!tariffs.length) {
            calculator.tariffsNotFound = true;
            SelectTariff(false);
            return;
        }
        calculator.tariffsNotFound = false;

        let $template = $('.js-calculator-tariff-template').find('.calculator__tariff-item');
        let $list = $('.calculator__tariff-list');
        $list.empty();
        let showPeriod = calculator.isShowPeriod();
        $.each(tariffs, function (index, tariff) {
            if (tariff !== null) {
                let $tariffDiv = $template.clone();

                $tariffDiv.find('.calculator__tariff-item-input').attr('id', tariff.tariffEc4Id).prop('id', tariff.tariffEc4Id);
                $tariffDiv.find('.calculator__tariff-item-input').val(tariff.tariffEc4Id + ' (' + tariff.nameLocalized + ') ' + tariff.priceString + calculator.getUsedCurrencyName());
                $tariffDiv.find('.calculator__tariff-item-input').data('price', tariff.priceString);
                $tariffDiv.find('.calculator__tariff-item-input').data('uuid', tariff.tariffUuid);

                $tariffDiv.find('.calculator__tariff-item-label').html(tariff.nameLocalized).attr('for', tariff.tariffEc4Id).prop('for', tariff.tariffEc4Id);

                if(showPeriod){
                    $tariffDiv.find('.calculator__tariff-item-description').html($tariffDiv.find('.calculator__tariff-item-period-prefix').html()+ ' ' + tariff.durationMin);
                }
                else{
                    $tariffDiv.find('.calculator__tariff-item-description').html(tariff.descriptionLocalized);
                }

                $tariffDiv.find('.calculator__tariff-item-type').html(tariff.tariffTypeLocalized);
                $tariffDiv.find('.calculator__tariff-item-price').html('' + tariff.priceString + ' ' + calculator.getUsedCurrencyName());

                if (parcelTariffFilter(tariff.tariffUuid, tariff.tariffModeCode)) {
                    return;
                }
                $list.append($tariffDiv);
            }
        });

        $('.calculator__content_step1').hide();

        $('.calculator__content_step2')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(2);

        $('body').trigger('gtm:event', [$('.js-calculator-form').data('showTariffsEvent')]);
    }


    $('.calculator__content_step2 .calculator__step-link_back').click(function () {
        $('.calculator__content_step2').hide();
        $('.calculator__content_step1')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(1);
        return false;
    });


    function SelectTariff(haveOption, optionOrList) {
        $('.calculator__content').has(optionOrList).addClass('calculator__content_loading');

        if(haveOption) {
            $('.calculator__content_step2').hide();
            $('.js-calculator-header-price').html('' + $(optionOrList).data('price') + ' ' + calculator.getUsedCurrencyName());
        }
        else{
            $('.calculator__content_step1').hide();
            $('.js-calculator-header-price').html('');
        }

        $('.calculator__content_step3')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(3);
    }

    const specialTariff = (optionOrList) => {
        const uuid = $(optionOrList).data('uuid');

        if ('25052a3e-ee40-45b9-985b-259cf49f7947' === uuid) {
            const query_params = $.param({
                from: calculator.getCityCodeFrom(),
                to: calculator.getCityCodeTo(),
                weight: calculator.getMass(),
                length: calculator.getLength(),
                width: calculator.getWidth(),
                height: calculator.getHeight()
            });

            window.location.href = `/order?${query_params}`;
            return true;
        }
        return false;
    }


    $('.calculator__content_step2').on('click', '.js-calculator-step2-button', function () {
        const selectedTariff = $('.calculator__tariff-item-input:checked');
        if (!selectedTariff.val()) {
            return;
        }
        if(specialTariff(selectedTariff)) {
            return;
        }
        SelectTariff(true, selectedTariff);
    });


    $('.calculator__content_step3 .calculator__step-link_back').click(function () {
        $('.calculator__content_step3').hide();

        if (calculator.tariffsNotFound) {
            $('.calculator__content_step1')
                .removeClass('calculator__content_loading')
                .show();
            calculator.setStep(1);
            return false;
        }

        $('.calculator__content_step2')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(2);
        return false;
    });


    function ResetCalculatorForm() {
        ResetCity($('.js-calculator-form input[name=from]'));
        ResetCity($('.js-calculator-form input[name=to]'));

        $('.js-calculator-form input[name=mass]').val('');
        $('.js-calculator-form input[name=length]').val('');
        $('.js-calculator-form input[name=width]').val('');
        $('.js-calculator-form input[name=height]').val('');

        $('.calculator__content_step2 .calculator__tariff-item-input').prop('checked', false);

        calculator.setStep(1);
    }

    $('.calculator__content .calculator__step-link_repeat').click(function () {
        ResetCalculatorForm();
        $('.calculator__content')
            .css('display', 'none');
        $('.calculator__content_step1')
            .removeClass('calculator__content_loading')
            .show();
        return false;
    });

    $('.js-calculator-form').submit(function () {
        if (calculator.getStep() == 1) {
            $('.js-calculator-step1-button').trigger('click');
            return false;
        }
        if (calculator.getStep() == 2) {
            return false;
        }

        let $form = $(this);
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

        $formElement = $form.find('input[name=customer_type]');
        if ((!$formElement.hasClass('js-form-order-customer-type-hidden')) && ($formElement.filter(':checked').length === 0)) {
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



        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('calculator');
        recaptchaExt.execute(function (token) {
            calculator.sendForm(token);
        });


        return false;
    });


    $('.form-field__input[name=from],.form-field__input[name=to]')
        .autocomplete({
            noCache: true,
            minChars: 1,
            deferRequestBy: 0,
            serviceUrl: '/request/city',
            type: 'POST',
            dataType: 'json',
            autoSelectFirst: true,
            ajaxSettings: {
                contentType: "application/json; charset=utf-8",
                processData: false,
                beforeSend: function (jqXHR, settings) {
                    settings.data = JSON.stringify(settings.data);
                }
            },
            onSearchStart: function (params) {
                params['lang'] = calculator.getLanguage();
                params['query'] = $.trim(params['query']);
            },

            transformResult: function (response) {
                return {
                    suggestions: $.map(response, function (dataItem) {
                        return {value: dataItem.name, data: dataItem.uuid};
                    })
                };
            },

            onSelect: function (suggestion) {
                $(this).val(suggestion.value);
                let forId = $(this).data('for');
                $(forId).val(suggestion.data);
            },

            onInvalidateSelection: function () {
                let forId = $(this).data('for');
                $(forId).val('');
            }
        });

    $('.form-field__input[name=from],.form-field__input[name=to]').on('blur.autocomplete', function () {
        let forId = $(this).data('for');
        if ($(forId).val() === '') {
            $(this).val('');
        }
    });

    $('.js-calculator-form, .js-feedback-form').on('focus', 'input', function () {
        $(this).closest('.form-field').removeClass('form-field_error');
    });

    $('.js-calculator-form, .js-feedback-form').on('click', 'input', function () {
        $(this).closest('.form-field_error').removeClass('form-field_error');
    });

    function ResetCity($input) {
        $input.val('');
        $input.autocomplete('clear');
        let forId = $input.data('for');
        $(forId).val('');
    }
});

const parcelTariffFilter = (tariffId, modeCode) => {
    return tariffId === '25052a3e-ee40-45b9-985b-259cf49f7947' && (modeCode === '1' || modeCode === '2');
}
