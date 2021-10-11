$(function () {
    $('.gtm-click').click(function () {
        dataLayer.push({'event': $(this).data('click')});
    });
});
