$(function () {
    $('.js-how-it-works-tab').click(function () {
        $('.js-how-it-works-tab').removeClass('submenu__item_active');
        $(this).addClass('submenu__item_active');
        let tab = $(this).data('for');
        $('.js-how-it-works-content').each(function () {
            if ($(this).data('for') == tab) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });

    });
});
