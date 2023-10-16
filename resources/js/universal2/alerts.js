$(function () {
    $('.alert__personal-information').on('click', function () {
        const faq_tab = $('.tab-alert__personal-information');
        if (!faq_tab.length) {
            location.href = $(this).data('href');
            return false;
        }
        if (!faq_tab.hasClass('faq-list__faq_opened')) {
            faq_tab.addClass('faq-list__faq_opened');
        }
        faq_tab.get(0).scrollIntoView();
    })
});

$(function () {
    if ('#personal-information' == location.hash) {
        const faq_tab = $('.tab-alert__personal-information');
        if (!faq_tab.hasClass('faq-list__faq_opened')) {
            faq_tab.addClass('faq-list__faq_opened');
        }
        faq_tab.get(0).scrollIntoView();
    }
});
