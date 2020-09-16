var activatedClass = 'activated';

export function activateSlider(sliderDiv, sliderOptions){
    if (sliderDiv.hasClass(activatedClass)) {
        return;
    }
    sliderDiv.addClass(activatedClass);

    // start slider after some timeout to stabilize div width after resize
    setTimeout(function () {
        sliderDiv.owlCarousel(sliderOptions);
    }, 100);
}

export function destroySlider(sliderDiv) {
    if (!sliderDiv.hasClass(activatedClass)) {
        return;
    }
    sliderDiv.removeClass(activatedClass);
    sliderDiv.trigger('destroy.owl.carousel');
    // sliderDiv.find('.owl-stage-outer').children(':eq(0)').unwrap();
}
