$(document).ready(function () {
    sliders();
    menu();

    $(".js-form").on('submit', function () {
        $(this).hide();
        $(".js-form-result").show();
        return false;
    })

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
        $('.js-modal-result-ok').hide();
        $('.js-modal-result-error').hide();
        $('.modal__content_form').removeClass('modal__content_loading').show();
        $('.modal__content_form').find('textarea[name=message]').val('');

        modalOpen($('#feedback-modal'));
        return false;
    });

    $('.modal__close').click(function () {
        modalClose($('.modal').has(this));
    });

    $('.modal-container').click(function () {
        modalClose($(this).find('.modal'));
    })
    $('.modal').click(function (e) {
        e.stopPropagation();
    })

    $('.js-feedback-form').submit(function () {

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
        $formElement = $form.find('input[name=agree]');
        if (!$formElement.prop('checked')) {
            $formElement.closest('.form__row').addClass('form-field_error');
            hasError = true;
        }

        if (hasError) {
            return false;
        }

        let request = {
            url: $form.prop('action'),
            data: $form.serialize()
        };

        var modalContent = $('.modal__content').has(this);
        modalContent.addClass('modal__content_loading');

        $.post(request).done(function () {
            modalContent.hide();
            $('.js-modal-result-ok')
                .css('height', modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
        }).fail(function () {
            modalContent.hide();
            $('.js-modal-result-error')
                .css('height', modalContent.css('height'))
                .removeClass('modal__content_loading')
                .show();
        });

        return false;
    });

    $('.js-partners-more').click(function () {
        $('.js-parners-other').show(400);
        $(this).closest('.js-partners-more-block').hide();
        return false;
    });

    $('.js-partner-show-more').click(function (e){
        $('.partner__item_hidden').fadeIn({
            duration: 700,
        });
        $(this).parent().hide();
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

