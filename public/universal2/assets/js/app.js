$(document).ready(function () {
    let tariffNames = {
        "7": {
            "name": "Международный экспресс документы",
            "description": "доставка документов для бизнеса и частных лиц",
            "type": "дверь-дверь"
        },
        "181": {
            "name": "Международный экспресс документы",
            "description": "доставка документов для бизнеса и частных лиц",
            "type": "склад-склад"
        },
        "182": {
            "name": "Международный экспресс документы",
            "description": "доставка документов для бизнеса и частных лиц",
            "type": "склад-дверь"
        },
        "183": {
            "name": "Международный экспресс документы",
            "description": "доставка документов для бизнеса и частных лиц",
            "type": "дверь-склад"
        },
        "291": {
            "name": "CDEK-Express",
            "description": "доставка только от интернет-магазинов клиентам",
            "type": "склад-склад"
        },
        "293": {
            "name": "CDEK-Express",
            "description": "доставка только от интернет-магазинов клиентам",
            "type": "дверь-дверь"
        },
        "294": {
            "name": "CDEK-Express",
            "description": "доставка только от интернет-магазинов клиентам",
            "type": "склад-дверь"
        },
        "295": {
            "name": "CDEK-Express",
            "description": "доставка только от интернет-магазинов клиентам",
            "type": "дверь-склад"
        },
        "352": {
            "name": "CDEK-Express",
            "description": "доставка только от интернет-магазинов клиентам",
            "type": "терминал-терминал"
        },
        "342": {
            "name": "My Express",
            "description": "доставка только между частными лицами: подарки и личные вещи",
            "type": "дверь-дверь"
        },
        "343": {
            "name": "My Express",
            "description": "доставка только между частными лицами: подарки и личные вещи",
            "type": "дверь-склад"
        },
        "344": {
            "name": "My Express",
            "description": "доставка только между частными лицами: подарки и личные вещи",
            "type": "склад-дверь"
        },
        "345": {
            "name": "My Express",
            "description": "доставка только между частными лицами: подарки и личные вещи",
            "type": "склад-склад"
        },
        "8": {
            "name": "Международный экспресс грузы",
            "description": "доставка образцов и другой продукции для бизнеса",
            "type": "дверь-дверь"
        },
        "178": {
            "name": "Международный экспресс грузы",
            "description": "доставка образцов и другой продукции для бизнеса",
            "type": "склад-склад"
        },
        "179": {
            "name": "Международный экспресс грузы",
            "description": "доставка образцов и другой продукции для бизнеса",
            "type": "склад-дверь"
        },
        "180": {
            "name": "Международный экспресс грузы",
            "description": "доставка образцов и другой продукции для бизнеса",
            "type": "дверь-склад"
        }
    };


    sliders();
    menu();

    $(".js-form").on('submit', function () {
        $(this).hide();
        $(".js-form-result").show();
        return false;
    })



    $('.js-calculator-step1-button').click(function () {
        let $form = $(this).closest('form');
        let hasError = false;
        let $formElement = $form.find('input[name=from_id]');
        if($formElement.val() === ''){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=to_id]');
        if($formElement.val() === ''){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        $formElement = $form.find('input[name=mass]');
        if(isNaN($formElement.val()) || $formElement.val() <= 0){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=length]');
        if(isNaN($formElement.val()) || $formElement.val() <= 0){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=width]');
        if(isNaN($formElement.val()) || $formElement.val() <= 0){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=height]');
        if(isNaN($formElement.val()) || $formElement.val() <= 0){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        if(hasError){
            return false;
        }
        $('.calculator__content_step1').addClass('calculator__content_loading');

        $('.js-calculator-header-from').html($form.find('input[name=from]').val());
        $('.js-calculator-header-to').html($form.find('input[name=to]').val());


        $('.js-calculator-header-mass').html($form.find('input[name=mass]').val());
        let volume = $form.find('input[name=length]').val() / 100 *
            $form.find('input[name=width]').val() / 100 *
            $form.find('input[name=height]').val() / 100;


        $('.js-calculator-header-volume').html(volume);

        getTariffs();

        return false;
    });


    let calculatorClass = function (form) {
        this.form = form;

        this.step = 1;

        this.getTariffCodes = function () {
            return [7, 8, 291, 344, 345, 291, 293, 294, 295, 352];
        }

        this.getUsedCurrency = function () {
            return 1;
        }

        this.getUsedCurrencyName = function () {
            return '₽';
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
            return 'rus';
        }

        this.getStep = function () {
            return this.step;
        }

        this.setStep = function (step) {
            this.step = step;
            return this;
        }

    };

    let calculator = new calculatorClass('div.calculator');

    let tariffApiClass = function () {
        this.url = 'https://webproxy.cdek.ru/calculator';
        this.getSettings = function (serviceParameters) {
            return {
                method: 'post',
                url: this.url,
                headers: {
                    'access-control-allow-origin': '*',
                    "accept": "application/json, text/plain, */*",
                    "content-type": "application/x-www-form-urlencoded"
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
        let tariffs = [];
        tariffs.fill(null, 0, tariffCodes.length);
        let serviceParameters = {
            "orderType": 1,
            "senderCity": {"id": calculator.getCityCodeFrom()},
            "receiverCity": {"id": calculator.getCityCodeTo()},
            "idCurrency": calculator.getUsedCurrency(),
            "idInterface": 3,
            "idServiceType": 291,
            "goodsList": [{
                weight: calculator.getMass(),
                height: calculator.getHeight(),
                width: calculator.getWidth(),
                length: calculator.getLength()
            }],
            "lang": calculator.getLanguage(),
        };

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

        $.each(tariffs, function (index, tariff) {
            if (tariff !== null) {
                let $tariffDiv = $template.clone();
                let tariffName = tariffNames[tariff.id];

                $tariffDiv.find('.calculator__tariff-item-input').attr('id', tariff.id).prop('id', tariff.id);
                $tariffDiv.find('.calculator__tariff-item-input').val(tariff.id + ' (' + tariffName.name + ') ' + tariff.price + calculator.getUsedCurrencyName());
                $tariffDiv.find('.calculator__tariff-item-input').data('price', tariff.price);

                $tariffDiv.find('.calculator__tariff-item-label').html(tariffName.name).attr('for', tariff.id).prop('for', tariff.id);
                $tariffDiv.find('.calculator__tariff-item-description').html(tariffName.description);
                $tariffDiv.find('.calculator__tariff-item-type').html(tariffName.type);
                $tariffDiv.find('.calculator__tariff-item-price').html(tariff.price);
                $('.calculator__tariff-list').append($tariffDiv);
            }
        });

        $('.calculator__content_step1').hide();
        $('.calculator__content_step2')
            .removeClass('calculator__content_loading')
            .show();
        calculator.setStep(2);
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
        if(calculator.getStep() == 1){
            $('.js-calculator-step1-button').trigger('click');
            return false;
        }
        if(calculator.getStep() == 2){
            return false;
        }

        let $form = $(this);
        let hasError = false;
        let $formElement = $form.find('input[name=name]');
        if($formElement.val() === ''){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=phone]');
        if($formElement.val() === ''){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        $formElement = $form.find('input[name=email]');
        if($formElement.val() === ''){
            $formElement.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }

        if(hasError){
            return false;
        }


        var calculatorContent = $('.calculator__content').has(this);
        calculatorContent.addClass('calculator__content_loading');

        let request = {
            url: $form.prop('action'),
            data: $(this).closest('form').serialize()
        };

        $.post(request).done(function () {
            $('.calculator__content_step3').hide();
            $('.js-calculator__content_step-result-ok')
                .css('height', calculatorContent.css('height'))
                .removeClass('calculator__content_loading')
                .show();
        }).fail(function () {
            $('.calculator__content_step3').hide();
            $('.js-calculator__content_step-result-error')
                .css('height', calculatorContent.css('height'))
                .removeClass('calculator__content_loading')
                .show();
        });

        return false;
    });


    $('.form-field__input[name=from],.form-field__input[name=to]')
        .autocomplete({
            minChars: 1,
            deferRequestBy: 0,
            serviceUrl: 'https://webproxy.cdek.ru/city',
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
                params['limit'] = 5;
                params['field'] = 'term';
                params['value'] = $.trim(params['query']) + '%';
                params['lang'] = 'rus';
            },

            transformResult: function (response) {
                return {
                    suggestions: $.map(response.items, function (dataItem) {
                        return {value: dataItem.name, data: dataItem.code};
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

    $('.js-calculator-form').on('focus', 'input', function(){
        $(this).closest('.form-field').removeClass('form-field_error');
    });

    function ResetCity($input){
        $input.val('');
        $input.autocomplete('clear');
        let forId = $input.data('for');
        $(forId).val('');
    }


    modalOpen = function (jsel) {
        if ($('.modal-opened').length) {
            modalClose($('.modal-opened'));
        }

        if ($('.modal-bg').length == 0) {
            $('<div></div>')
                .addClass('modal-bg')
                .css('width', $(document).width())
                .css('height', $(document).height())
                .prependTo('body')
            ;
        }

        var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
        $('.modal-container').has(jsel).css('display', 'flex').css('padding-top', vscroll + 'px');
        jsel.addClass('modal-opened').css('display', 'block');

        if ($(window).width() <= 480) {
            $('body')
                .css('height', '100vh')
                .css('position', 'relative')
                .css('overflow', 'hidden');
        }
    };

    modalClose = function (jsel) {
        jsel.removeClass('modal-opened').css('display', 'none');
        $('.modal-container').has(jsel).css('display', 'none').css('padding-top', 0);
        $('.modal-bg').remove();
        $('body')
            .css('height', 'auto')
            .css('overflow', 'auto');
    };

    $('.js-feedback-open').click(function () {
        modalOpen($('#feedback-modal'));
        return false;
    });

    $('.modal__close').click(function () {
        modalClose($('.modal').has(this));
    });

    $('#feedback-modal .primary-button_submit').click(function () {
        var modalContent = $('.modal__content').has(this);
        modalContent.addClass('modal__content_loading');
        setTimeout(function () {
            modalContent.hide();
            $('.js-modal-result-ok')
                .css('height', modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show()
            ;
        }, 2000);
        return false;
    });
});


(function (window, $) {

    window.menu = function () {
        $('.js-menu-open-button').click(function () {
            $('.js-menu-container').addClass('opened');
            $('.js-fade_background').addClass('opened');
            return false;
        });

        $('.js-menu-close-button').click(function () {
            closeMenu();
            return false;
        });

        $('.js-fade_background').click(function () {
            closeMenu();
            return false;
        });
    }

    function closeMenu() {
        $('.js-menu-container').removeClass('opened');
        $('.js-fade_background').removeClass('opened');
    }

})(window, jQuery);


(function (window, $) {

    var activatedClass = 'activated';

    window.activateSlider = function (sliderDiv, sliderOptions) {
        if (sliderDiv.hasClass(activatedClass)) {
            return;
        }
        sliderDiv.addClass(activatedClass);

        // start slider after some timeout to stabilize div width after resize
        setTimeout(function () {
            sliderDiv.owlCarousel(sliderOptions);
        }, 100);
    }

    window.destroySlider = function (sliderDiv) {
        if (!sliderDiv.hasClass(activatedClass)) {
            return;
        }
        sliderDiv.removeClass(activatedClass);
        sliderDiv.trigger('destroy.owl.carousel');
        // sliderDiv.find('.owl-stage-outer').children(':eq(0)').unwrap();
    }

})(window, jQuery);


(function (window, $) {

    window.sliders = function () {

        var companyAdvantagesSlider = $('.js-company-advantages');
        var companyAdvantagesOptions = {
            nav: true,
            dots: true,
            items: 1,
            loop: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            margin: 0,
            autoHeight: true,
        };

        $(window).resize(function () {
            processOnResize()
        });

        $(window).trigger('resize');

        function processOnResize() {
            if (isWider480()) {
                destroySlider(companyAdvantagesSlider);
            } else {
                activateSlider(companyAdvantagesSlider, companyAdvantagesOptions);
            }

        }

        function isWider480() {
            if (window.innerWidth >= 481) {
                return true;
            } else {
                return false;
            }
        }

    };

})(window, jQuery);


$(function () {
    $('.js-faq-tab').click(function () {
        $('.submenu__item').removeClass('submenu__item_active');
        $(this).addClass('submenu__item_active');

        let forTab = $(this).data('for');

        $('.faq__faq-list').addClass('hidden');
        $(forTab).removeClass('hidden');
        return false;
    });

    $('.faq-list__faq-question').click(function () {
        $(this).closest('.faq-list__faq').toggleClass('faq-list__faq_opened');
    });

});


