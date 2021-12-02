$(function () {
    $('.js-contact-tab').click(function () {
        $('.js-contact-tab').removeClass('submenu__item_active');
        $(this).addClass('submenu__item_active');

        $('.js-contacts-tab-content-1').addClass('hidden');
        $('.js-contacts-tab-content-2').addClass('hidden');
        $('.js-contacts-tab-content-3').addClass('hidden');
        let contentCssClass = $(this).data('content');
        $(contentCssClass).removeClass('hidden');

    });
});
