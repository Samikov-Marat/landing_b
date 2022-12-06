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

        this.getStep = function () {
            return this.step;
        }

        this.setStep = function (step) {
            this.step = step;
            return this;
        }

        this.getTariffDescriptionParameters = function (code) {
            return tariffNames[code];
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
        }).done(function(tariffs){
            showTariffs(tariffs);
        });

        return;


        let tariffs = [];
        for (let position in tariffCodes) {
            tariffs[position] = null;
        }
        for (let position in tariffCodes) {
            serviceParameters.idServiceType = tariffCodes[position];
            getTariff(position, serviceParameters, tariffs, finishedRequest);
        }
    }

    function getTariff(position, serviceParameters, tariffs, finishedRequest) {
        let tariffCodes = calculator.getTariffCodes();
        $.ajax(tariffApi.getSettings(serviceParameters)).done(function (responseData) {
            if (!responseData.result.hasOwnProperty("error")) {
                tariffs[position] = {
                    id: tariffCodes[position],
                    price: responseData.result.price
                }
            }
        }).always(function () {
            finishedRequest.count++;
            if (finishedRequest.count == tariffCodes.length) {
                showTariffs(tariffs);
            }
        });
    }


    function showTariffs(tariffs) {
        let $template = $('.js-calculator-tariff-template').find('.calculator__tariff-item');
        let $list = $('.calculator__tariff-list');
        $list.empty();
        $.each(tariffs, function (index, tariff) {
            if (tariff !== null) {
                let $tariffDiv = $template.clone();
                let tariffDescriptionParameters = calculator.getTariffDescriptionParameters(tariff.id)

                $tariffDiv.find('.calculator__tariff-item-input').attr('id', tariff.tariffEc4Id).prop('id', tariff.tariffEc4Id);
                $tariffDiv.find('.calculator__tariff-item-input').val(tariff.tariffEc4Id + ' (' + tariffDescriptionParameters.name + ') ' + tariff.price + calculator.getUsedCurrencyName());
                $tariffDiv.find('.calculator__tariff-item-input').data('price', tariff.priceString);

                $tariffDiv.find('.calculator__tariff-item-label').html(tariffDescriptionParameters.name).attr('for', tariff.tariffEc4Id).prop('for', tariff.tariffEc4Id);
                $tariffDiv.find('.calculator__tariff-item-description').html(tariffDescriptionParameters.description);
                $tariffDiv.find('.calculator__tariff-item-type').html(tariffDescriptionParameters.type);
                $tariffDiv.find('.calculator__tariff-item-price').html('' + tariff.priceString + ' ' + calculator.getUsedCurrencyName());
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


    function SelectTariff(option) {
        $('.calculator__content').has(option).addClass('calculator__content_loading');
        $('.calculator__content_step2').hide();

        $('.js-calculator-header-price').html('' + $(option).data('price') + ' ' + calculator.getUsedCurrencyName());

        $('.calculator__content_step3')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(3);

    }


    $('.calculator__content_step2').on('change', '.calculator__tariff-item-input', function () {
        SelectTariff(this);
        return false;
    });

    $('.calculator__content_step2').on('click', '.calculator__tariff-item-input:checked', function () {
        SelectTariff(this);
    });


    $('.calculator__content_step3 .calculator__step-link_back').click(function () {
        $('.calculator__content_step3').hide();
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
