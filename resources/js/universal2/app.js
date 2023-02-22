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


    $('.modal__close').click(function () {
        modalClose($('.modal').has(this));
    });

    $('.modal-container').click(function () {
        modalClose($('.modal-opened'));
    })
    $('.modal').click(function (e) {
        e.stopPropagation();
    })



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

    $('.js-support-select2').each(function (){
        $(this).select2({
            placeholder: $(this).attr('placeholder'),
            allowClear: false,
            dropdownCssClass: 'support-select2-dropdown',
            selectionCssClass: 'support-select2-selection',
            width: '100%',
            minimumResultsForSearch: 20
        });

    });

    $('.js-order-select2').each(function (){
        $(this).select2({
            placeholder: $(this).attr('placeholder'),
            allowClear: false,
            dropdownCssClass: 'support-select2-dropdown',
            selectionCssClass: 'support-select2-selection',
            width: '100%',
            minimumResultsForSearch: 20
        });

    });

});

$(function (){
    if ($('#antifraud').length > 0) {
        modalOpen($('#antifraud'));
    }
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


    let restoreAnswerState = function () {
        $('.js-feedback-post-control').show();
        $('.js-feedback-glad-to-help').hide();
        $('.js-feedback-form-container').hide();
        $('.js-feedback-form-wrapper').show();
        $('.js-feedback-result-ok-wrapper').hide();
    }

    let loadWithPreloader = function (self, load, timeout = 1000) {
        let $preloader = $('.preloader').has(self);
        $preloader.addClass('preloader_loading');
        setTimeout(function () {
            load();
            $preloader.removeClass('preloader_loading');
        }, timeout);
    }

    $('.support-page .js-answer-button-yes').click(function (){
        $('.js-feedback-post-control').hide();
        $('.js-feedback-glad-to-help').show();
        return false;
    });

    $('.support-page .js-answer-button-no').click(function (){
        $('.js-feedback-post-control').hide();
        $('.js-feedback-form-container').show();
        return false;
    });

    // $('.support-page .js-feedback-form-container .primary-button_submit').click(function () {
    //     loadWithPreloader(this, function (){
    //         $('.js-feedback-form-wrapper').hide();
    //         $('.js-feedback-result-error-wrapper').show();
    //     });
    //     return false;
    // });

    // $('.support-page .bm-breadcrumbs__item').click(function (){
    //     restoreAnswerState();
    // });

    // $('.support-page__content_step4 .feedback__back-link').click(function (){
    //     restoreAnswerState();
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step4').hide();
    //         $('.support-page__content_step3').show();
    //     });
    //     return false;
    // });

    // $('.support-page__content_step3 .feedback__back-link').click(function (){
    //     restoreAnswerState();
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step3').hide();
    //         $('.support-page__content_step2').show();
    //     });
    //     return false;
    // });

    // $('.support-page__content_step2 .feedback__back-link').click(function (){
    //     restoreAnswerState();
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step2').hide();
    //         $('.support-page__content_step1').show();
    //     });
    //     return false;
    // });

    // $('.support-page .support-page__content_step1 .feedback__category_root').click(function (){
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step1').hide();
    //         $('.support-page__content_step2').show();
    //     });
    //     return false;
    // });
    //
    // $('.support-page .support-page__content_step2 .feedback__category').click(function () {
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step2').hide();
    //         $('.support-page__content_step3').show();
    //     });
    //     return false;
    // });

    // $('.feedback__question-outer').click(function (){
    //     loadWithPreloader(this, function (){
    //         $('.support-page__content_step3').hide();
    //         $('.support-page__content_step4').show();
    //     });
    //     return false;
    // });

    // $('.bm-breadcrumbs__item').click(function (){
    //     $('.support-page__content').hide();
    //     $('.support-page__content_step1').show();
    //     return false;
    // });
    //
    if ($('#warningScamModal').length > 0) {
        modalOpen('#warningScamModal');
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
