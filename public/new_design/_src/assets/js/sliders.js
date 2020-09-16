import {activateSlider, destroySlider} from './sliderDinamicCreationAndDestroy';

export default function() {

    var whoAreWeSlider = $('.js-who-are-we-slider');
    var whoAreWeSliderOptions  = {
        nav: true,
        dots: true,
        items: 1,
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        margin: 0,
    };

    $(window).resize(function() {
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
        if(window.innerWidth >= 1200) {
            return true;
        } else {
            return false;
        }
    }

};