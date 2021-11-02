$(function () {
    $('.gtm-click').click(function () {
        let eventName = $(this).data('click');
        if (undefined === eventName) {
            return;
        }
        if ('' !== eventName) {
            dataLayer.push({'event': eventName});
        }
    });

    $('body').on('gtm:event', function (e, targetName) {
        dataLayer.push({'event': targetName});
    });

});
