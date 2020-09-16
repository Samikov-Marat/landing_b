module.exports = function(){

    $('.js-animate-hide-toggle-button').click(function () {
        var wrapperElementWithIsOpenedClass = $(this).closest('.js-animate-hide-container');
        var elementToCollapse = wrapperElementWithIsOpenedClass.find('.js-animate-hide-block-to-hide');
        var isOpenedClass = 'opened';
        toggleSection(elementToCollapse, wrapperElementWithIsOpenedClass, isOpenedClass);
        return false;
    });

    $('.js-show_more_button').click(function() {
        $(this).closest(".js-show_more_container").toggleClass('opened');
        return false;
    });


    function toggleSection(element, wrapperElementWithIsOpenedClass, isOpenedClass) {
        // get Dom object from jQuery object
        element = element[0];
        // get the height of the element's inner content, regardless of its actual size
        var sectionHeight = element.scrollHeight;
        element.style.height = sectionHeight + 'px';

        ["transitionend", "webkitTransitionEnd", "mozTransitionEnd"].forEach(function(transition) {
            element.addEventListener(transition, function (e) {
                // remove this event listener so it only gets triggered once
                element.removeEventListener(transition, arguments.callee);

                // remove "height" from the element's inline styles, so it can return to its initial value
                element.style.height = null;
            });
        });

        setTimeout(function() {
            wrapperElementWithIsOpenedClass.toggleClass(isOpenedClass);
        }, 50);
    }

};

