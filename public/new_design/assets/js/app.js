window.dataLayer = window.dataLayer || [];

$(document).ready(function () {
    sliders();
    menu();

    demoFormProcessing();

    initLanguageList();
});


function initLanguageList(){
    $('.js-open-language-list').click(function(){
        $(this).closest('.header-container__language-selector').find('.header-container__language-list').toggle();
    });
}


function getEmptyFormFields($form){
    var emptyFormFields = [];
    $form.find('.js-required').each(function(){
        if($(this).val() === ''){
            emptyFormFields.push($(this).closest('.form-field'));
        }
    });
    return emptyFormFields;
}

function clearError($form){
    $form.find('.js-required').each(function(){
        $(this).closest('.form-field').removeClass('form-field_error');
    });
}

function setError(emptyFormFields){
    $.each(emptyFormFields, function(index, formField){
        formField.addClass('form-field_error')
    });
}



function demoFormProcessing() {

    $('.js-required').on('focus', function (){
        $(this).closest('.form-field').removeClass('form-field_error');
    });

    $(".js-form").on('submit', function () {
        var $form = $(this);
        clearError($form);
        var emptyFormFields = getEmptyFormFields($form);
        if(0 != emptyFormFields.length){
            setError(emptyFormFields);
            return false;
        }


        $form.hide();
        $('.js-preloader').show();
        $.ajax({
            method: $form.prop('method'),
            url: $form.prop('action'),
            data: $form.serialize()
        }).done(function () {
            $('.js-preloader').hide();
            $(".js-form-result").show();
            $(".js-form-result .form-result_result_success").show();
            dataLayer.push({'event': 'webinar_form_send'});
        }).fail(function () {
            $('.js-preloader').hide();
            $(".js-form-result").show();
            $(".js-form-result .form-result_result_error").show();
            $(".js-form-result .form-result_result_error").one('click', function (){
                $(this).hide();
                $form.show();
            });
        });
        return false;
    })
}


var activatedClass = 'activated';

function activateSlider(sliderDiv, sliderOptions) {
    if (sliderDiv.hasClass(activatedClass)) {
        return;
    }
    sliderDiv.addClass(activatedClass);

    // start slider after some timeout to stabilize div width after resize
    setTimeout(function () {
        sliderDiv.owlCarousel(sliderOptions);
    }, 100);
}

function destroySlider(sliderDiv) {
    if (!sliderDiv.hasClass(activatedClass)) {
        return;
    }
    sliderDiv.removeClass(activatedClass);
    sliderDiv.trigger('destroy.owl.carousel');
}

function sliders() {
    var whoAreWeSlider = $('.js-who-are-we-slider');
    var whoAreWeSliderOptions = {
        nav: true,
        dots: true,
        items: 1,
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        margin: 0,
    };

    $(window).resize(function () {
        processOnResize()
    });

    $(window).trigger('resize');

    function processOnResize() {
        if (isWider1199()) {
            destroySlider(whoAreWeSlider);
        } else {
            activateSlider(whoAreWeSlider, whoAreWeSliderOptions);
        }

    }

    function isWider1199() {
        if (window.innerWidth >= 1200) {
            return true;
        } else {
            return false;
        }
    }
}

function menu() {
    $('.js-menu-open-button').click(function () {
        $('.js-webinar-menu-container').addClass('opened');
        $('.js-fade_background').addClass('opened');
        return false;
    });

    $('.js-menu-close-button').click(function () {
        closeMenu();
        return false;
    });

    $('.menu-container a').click(function () {
        closeMenu();
        return true;
    });

    $('.js-fade_background').click(function () {
        closeMenu();
        return false;
    });

    function closeMenu() {
        $('.js-webinar-menu-container').removeClass('opened');
        $('.js-fade_background').removeClass('opened');
    }
}
