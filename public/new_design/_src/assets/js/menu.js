const bodyScrollLock = require('body-scroll-lock');
const clearAllBodyScrollLocks = bodyScrollLock.clearAllBodyScrollLocks;


export default function() {
    const menuScrollBlock = $(".js-webinar-menu-container");
    const briefScrollBlock = $(".js-landing-brief-container");
    const headerMenuButton = $(".js-header-button-menu");

    $(document).scroll(function(){
        const y = window.scrollY;
        if (y > 150) {
            headerMenuButton.addClass('active');
        } else {
            headerMenuButton.removeClass('active');
        }
    })

    $(document).trigger('scroll');

    // Smooth scroll to anchor
    menuScrollBlock.on('click', '[href*="#"]', function(e){
        var target = $(this.hash);
        if (target.length === 0) {
            return;
        }
        e.preventDefault();
        target[0].scrollIntoView({
            behavior: 'smooth'
        });

        // set anchor in addressbar
        var anchorHref = this.href;
        setTimeout(function(){
            location = anchorHref;
        }, 600);
    });

    $('.js-menu-open-button').click(function(){
        $('.js-webinar-menu-container').addClass('opened');
        $('.js-fade_background').addClass('opened');
        myDisableBodyScroll(menuScrollBlock);
        return false;
    });
    $('.js-menu-close-button').click(function(){
        closeMenu();
        return false;
    });

    $('.js-brief-open-button').click(function(){
        $('.js-webinar-menu-container').removeClass('opened');
        $('.js-landing-brief-container').addClass('opened');
        $('.js-fade_background').addClass('opened');
        showRecaptchaBadge();
        myDisableBodyScroll(briefScrollBlock);
        return false;
    });
    $(document).on('click', '.js-brief-close-button', function(){
        $('.js-landing-brief-container').removeClass('opened');
        $('.js-fade_background').removeClass('opened');
        $('.grecaptcha-badge').css('visibility','hidden');
        myClearAllBodyScrollLocks();
        return false;
    });

    $('.js-fade_background').click(function(){
        $('.js-landing-brief-container').removeClass('opened');
        $('.grecaptcha-badge').css('visibility','hidden');
        closeMenu();
        return false;
    });

    $('.js-landing-menu-item').click(function () {
        closeMenu();
    });

    function closeMenu() {
        $('.js-webinar-menu-container').removeClass('opened');
        $('.js-fade_background').removeClass('opened');
        myClearAllBodyScrollLocks();
    }


    function myDisableBodyScroll(scrolledElement) {
        var options = {};

        if ( isElementScrolledNow(scrolledElement)) {
            options = {
                allowTouchMove: el => {
                    while (el && el !== document.body) {
                        if (el.getAttribute('body-scroll-lock-ignore') !== null) {
                            return true;
                        }
                        el = el.parentNode;
                    }
                    return false;
                }
            };
        }

        options.reserveScrollBarGap = true;
        correctScrollGapPosition(headerMenuButton);

        bodyScrollLock.disableBodyScroll(scrolledElement, options);
    }

    function isElementScrolledNow(scrolledElement) {
        return (scrolledElement[0].scrollHeight > scrolledElement[0].clientHeight);
    }

    function correctScrollGapPosition(block)
    {
        var originalLeftOffset = block.offset().left;
        block.css('left', originalLeftOffset + 'px');
    }

    function restoreScrollGapPosition(block)
    {
        setTimeout(function() {
            block.css('left', '');
        }, 500);
    }

    function myClearAllBodyScrollLocks(){
        restoreScrollGapPosition(headerMenuButton);
        clearAllBodyScrollLocks();
    }

    function showRecaptchaBadge(){
        setTimeout(function() {
            $('.grecaptcha-badge').css('visibility','visible');
        }, 500);
    }

};

