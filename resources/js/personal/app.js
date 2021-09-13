$(document).ready(function() {
    sliders();
    menu();

    //demoFormProcessing
    $(".js-form").on('submit', function() {
        $(this).hide();
        $(".js-form-result").show();
        return false;
    });

    modalOpen = function(jsel)
    {
        if ($('.modal-opened').length) {
            modalClose($('.modal-opened'));
        }

        if ($('.modal-bg').length == 0) {
            $('<div></div>')
                .addClass('modal-bg')
                .css('width',$(document).width())
                .css('height',$(document).height())
                .prependTo('body')
            ;
        }

        var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
        $('.modal-container').has(jsel).css('display', 'flex').css('padding-top', vscroll + 'px');
        jsel.addClass('modal-opened').css('display','block');

        if ($(window).width() <= 480) {
            $('body')
                .css('height', '100vh')
                .css('position', 'relative')
                .css('overflow', 'hidden');
        }
    };

    modalClose = function(jsel)
    {
        jsel.removeClass('modal-opened').css('display','none');
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

    $('.js-partner-show-more').click(function (){
        $('.partner__item_hidden').fadeIn({
            duration: 700,
        });
        $(this).parent().hide();
        return false;
    });

    $('.office-page-feedback .primary-button').click(function (){
        var $content = $('.office-page-feedback__content').has(this);
        $content.addClass('office-page-feedback__content_loading');
        setTimeout(function (){
            $content.removeClass('office-page-feedback__content_loading');
            $content.find('.js-result-hide').hide();
            $content.find('.js-result-ok').show();
        }, 1500);
    });

    $('.office-page-wrapper .news a').click(function (){
        let $modal = $('#news-modal');
        let newsItem = $(this).closest('.news').data('item');

        $modal.find('.news-modal__date').html(newsItem.publication_date_text);
        $modal.find('.news-modal__title').html(newsItem.header);
        $modal.find('.news-modal__text .news-modal__paragraph').html(newsItem.text.split('\n').join('<br>'));
        $modal.find('.news-modal__image').prop('src', '/storage/news_images/' + newsItem.image);

        $modal.find('.news-modal__img source:eq(1)').prop('srcset',
            '/storage/news_images/' + newsItem.image +', ' + '/storage/news_images/' + newsItem.image + ' 2x');

        $modal.find('.news-modal__img source:eq(2)').prop('srcset',
            '/storage/news_images/' + newsItem.image +', ' + '/storage/news_images/' + newsItem.image + ' 2x');




        modalOpen($('#news-modal'));
        return false;
    });

    $('.news-modal__close').click(function (){
        modalClose($('#news-modal'));
        return false;
    });

    $('.office-page-reviews').on('click', '.office-page-reviews__review', function () {
        let $modal = $('#review-modal');
        $modal.find('.review-modal__title').html($(this).data('header'));
        $modal.find('.review-modal__text').html($(this).data('text'));
        modalOpen($modal);
        return false;
    });

    $('.review-modal__close').click(function (){
        modalClose($('#review-modal'));
        return false;
    });

    $('.office-page-presentation__download').click(function (){
        modalOpen($('#presentation-modal'));
        return false;
    });

    $('.presentation-modal__close').click(function (){
        modalClose($('#presentation-modal'));
        return false;
    });

    $('.js-presentation-form').submit(function (){
        let $content = $('#presentation-modal');
        $content.addClass('presentation-modal_loading');

        $.post({
            url: $(this).prop('action'),
            data: $(this).serialize()
        }).always(function (){
            setTimeout(function (){
                $content.removeClass('presentation-modal_loading');
                $content.find('.presentation-modal__form').hide();
                $content.find('.js-modal-result-ok').show();
            }, 1500);
        });
        return false;
    });


    $('.js-review-add-open').click(function () {
        modalOpen($('#review-add-modal'));
        return false;
    });

    // $('#review-add-modal .primary-button').click(function (){
    //     var $modal = $('.review-add-modal').has(this);
    //     $modal.addClass('review-add-modal_loading');
    //     setTimeout(function (){
    //         $modal.removeClass('review-add-modal_loading');
    //         $modal.find('.js-modal-result-hide').hide();
    //         $modal.find('.js-modal-result-ok').show();
    //     }, 1000);
    //     return false;
    // });

    $('.review-add-modal__close').click(function (){
        modalClose($('#review-modal'));
        return false;
    });
});


(function(window, $) {

    window.menu = function() {
        $('.js-menu-open-button').click(function(){
            $('.js-menu-container').addClass('opened');
            $('.js-fade_background').addClass('opened');
            return false;
        });

        $('.js-menu-close-button').click(function(){
            closeMenu();
            return false;
        });

        $('.js-fade_background').click(function(){
            closeMenu();
            return false;
        });
    }

    function closeMenu() {
        $('.js-menu-container').removeClass('opened');
        $('.js-fade_background').removeClass('opened');
    }

})(window, jQuery);



(function(window, $) {

    var activatedClass = 'activated';

    window.activateSlider = function(sliderDiv, sliderOptions){
        if (sliderDiv.hasClass(activatedClass)) {
            return;
        }
        sliderDiv.addClass(activatedClass);

        // start slider after some timeout to stabilize div width after resize
        setTimeout(function () {
            sliderDiv.owlCarousel(sliderOptions);
        }, 100);
    }

    window.destroySlider = function(sliderDiv) {
        if (!sliderDiv.hasClass(activatedClass)) {
            return;
        }
        sliderDiv.removeClass(activatedClass);
        sliderDiv.trigger('destroy.owl.carousel');
        // sliderDiv.find('.owl-stage-outer').children(':eq(0)').unwrap();
    }

})(window, jQuery);



(function(window, $) {

    window.sliders = function() {

        var companyAdvantagesSlider = $('.js-company-advantages');
        var companyAdvantagesOptions  = {};

        if ($('html').attr('dir') === 'rtl') {
            // RTL slider options
            companyAdvantagesOptions  = {
                rtl:true,
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
        } else {
            // Default slider options
            companyAdvantagesOptions  = {
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
        }

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

        $(window).resize(function() {
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
            if(window.innerWidth >= 481) {
                return true;
            } else {
                return false;
            }
        }

        function isWider1200() {
            if(window.innerWidth >= 1200) {
                return true;
            } else {
                return false;
            }
        }

    };

})(window, jQuery);


