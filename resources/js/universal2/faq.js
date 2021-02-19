$(function () {
    $('.js-faq-tab').click(function () {
        $('.js-faq-tab').removeClass('submenu__item_active');
        $(this).addClass('submenu__item_active');

        let forTab = $(this).data('for');

        $('.faq__faq-list').addClass('hidden');
        $(forTab).removeClass('hidden');

        let forButton = $(this).data('for2');

        $('.js-faq_button').addClass('hidden');
        $(forButton).removeClass('hidden');
        return false;
    });

    $('.faq-list__faq-question').click(function () {
        $(this).closest('.faq-list__faq').toggleClass('faq-list__faq_opened');
    });
});


