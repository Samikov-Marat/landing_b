$(document).ready(function () {
    sliders();
    menu();

    //console.log('hello');

    //demoFormProcessing
    $(".js-form").on('submit', function () {
        $(this).hide();
        $(".js-form-result").show();
        return false;
    })

    $('.calculator__content_step1 .primary-button_submit').click(function () {
        $('.calculator__content').has(this).addClass('calculator__content_loading');
        setTimeout(function () {
            $('.calculator__content_step1').hide();
            $('.calculator__content_step2')
                .removeClass('calculator__content_loading')
                .show()
            ;
        }, 3000);
        return false;
    });

    $('.calculator__content_step2 .calculator__step-link_back').click(function () {
        $('.calculator__content_step2').hide();
        $('.calculator__content_step1')
            .removeClass('calculator__content_loading')
            .show()
        ;
        return false;
    });

    $('.calculator__content_step2 input[type=radio]').change(function () {
        $('.calculator__content').has(this).addClass('calculator__content_loading');
        setTimeout(function () {
            $('.calculator__content_step2').hide();
            $('.calculator__content_step3')
                .removeClass('calculator__content_loading')
                .show()
            ;
        }, 1000);
        return false;
    });

    $('.calculator__content_step3 .calculator__step-link_back').click(function () {
        $('.calculator__content_step3').hide();
        $('.calculator__content_step2')
            .removeClass('calculator__content_loading')
            .show()
        ;
        return false;
    });

    $('.calculator__content .calculator__step-link_repeat').click(function () {
        $('.calculator__content')
            .css('display', 'none')
        ;
        $('.calculator__content_step1')
            .removeClass('calculator__content_loading')
            .show()
        ;
        return false;
    });

    $('.calculator__content_step3 .primary-button_submit').click(function () {
        var calculatorContent = $('.calculator__content').has(this);
        calculatorContent.addClass('calculator__content_loading');
        setTimeout(function () {
            $('.calculator__content_step3').hide();
            $('.js-calculator__content_step-result-ok')
                .css('height', calculatorContent.css('height'))
                .removeClass('calculator__content_loading')
                .show()
            ;
        }, 3000);
        return false;
    });

    var cities = [
        {value: 'Москва', data: 1},
        {value: 'Магнитогорск', data: 2},
        {value: 'Магадан', data: 3},
        {value: 'Майкоп', data: 4},
        {value: 'Миасс', data: 5},
    ];

    $('.form-field__input[name=from]')
        .autocomplete({
            //serviceUrl: '',
            lookup: cities,
            noCache: true,
            onSelect: function (suggestion) {
                $(this).val(suggestion.value);
            },
        })
    ;

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

    $('.js-partner-show-more').click(function () {
        $('.partner__item_hidden').fadeIn({
            duration: 700,
        });
        $(this).parent().hide();
        return false;
    });

    $('.office-page-feedback .primary-button').click(function () {
        var $content = $('.office-page-feedback__content').has(this);
        $content.addClass('office-page-feedback__content_loading');
        setTimeout(function () {
            $content.removeClass('office-page-feedback__content_loading');
            $content.find('.js-result-hide').hide();
            $content.find('.js-result-ok').show();
        }, 1500);
    });

    $('.office-page-wrapper .news a').click(function () {
        modalOpen($('#news-modal'));
        return false;
    });

    $('.news-modal__close').click(function () {
        modalClose($('#news-modal'));
        return false;
    });

    $('.office-page-reviews__review').click(function () {
        modalOpen($('#review-modal'));
        return false;
    });

    $('.review-modal__close').click(function () {
        modalClose($('#review-modal'));
        return false;
    });

    $('.office-page-presentation__download').click(function () {
        modalOpen($('#presentation-modal'));
        return false;
    });

    $('.presentation-modal__close').click(function () {
        modalClose($('#presentation-modal'));
        return false;
    });

    $('#presentation-modal .primary-button').click(function () {
        var $content = $('#presentation-modal');
        $content.addClass('presentation-modal_loading');
        setTimeout(function () {
            $content.removeClass('presentation-modal_loading');
            $content.find('.presentation-modal__form').hide();
            $content.find('.js-modal-result-ok').show();
        }, 1500);
    });

    $('.cookie-confirm__close').click(function () {
        $('.cookie-confirm').hide();
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

        var officePageSlider = $('.office-page-services__main');
        var officePageOptions = {
            nav: false,
            dots: true,
            items: 1,
            loop: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            margin: 0,
            autoHeight: true,
        };

        var officePageTeamSlider = $('.office-page-team__content');
        var officePageTeamOptions = {
            nav: false,
            dots: true,
            items: 1,
            loop: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            margin: 0,
            autoHeight: true,
        };

        var officePageReviewSlider = $('.office-page-reviews__content');
        var officePageReviewOptions = {
            nav: true,
            dots: false,
            loop: true,
            margin: 24,
            autoWidth: true,
        };

        activateSlider($('.office-page-offices__photos'), {
            nav: true,
            dots: false,
            loop: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            margin: 24,
            autoHeight: true,
            autoWidth: true,
        });

        $(window).resize(function () {
            processOnResize()
        });

        $(window).trigger('resize');

        function processOnResize() {
            if (isWider480()) {
                destroySlider(companyAdvantagesSlider);
                destroySlider(officePageSlider);
                destroySlider(officePageTeamSlider);
            } else {
                activateSlider(companyAdvantagesSlider, companyAdvantagesOptions);
                activateSlider(officePageSlider, officePageOptions);
                activateSlider(officePageTeamSlider, officePageTeamOptions);
            }

            if (isWider1200()) {
                activateSlider(officePageReviewSlider, officePageReviewOptions);
            } else {
                destroySlider(officePageReviewSlider);
            }
        }

        function isWider480() {
            if (window.innerWidth >= 481) {
                return true;
            } else {
                return false;
            }
        }

        function isWider1200() {
            if (window.innerWidth >= 1200) {
                return true;
            } else {
                return false;
            }
        }

    };

})(window, jQuery);


$(function () {

    let trackingApiClass = function () {
        this.url = 'https://webproxy.cdek.ru/track';
        this.getSettings = function (serviceParameters) {
            return {
                method: 'post',
                url: this.url,
                headers: {
                    'access-control-allow-origin': '*',
                    'accept': 'application/json, text/plain, */*',
                    "content-type": "application/json;charset=UTF-8"
                },
                data: JSON.stringify(serviceParameters),
                xhrFields: {
                    withCredentials: true
                }
            }
        }
    };

    let trackingApi = new trackingApiClass();

    $('.js-tracking-form').submit(function () {

        let orderParameters = {
            'enableTrace': true,
            'lang': $(this).find('[name=lang]').val(),
            'orderNumber': $(this).find('[name=order]').val(),
        };

        let $phone = $(this).find('[name=phone]');
        if(!$phone.prop('disabled')){
            orderParameters["numbersReceiverPhone"] = $phone.val();
        }



        console.log(orderParameters);

        $.post(trackingApi.getSettings(orderParameters))
            .done(function (response) {
                console.log(response);
            });


        return false;
    });

});
