$(function () {
    $('.news a').click(function () {
        let id = $(this).closest('.js-news-item').data('id');
        let $modal = $('.js-news-modal').filter(function () {
            return $(this).data('id') == id
        });
        modalOpen($modal);
        return false;
    });

    $('.news-modal__close').click(function () {
        let $modal = $(this).closest('.js-news-modal');
        modalClose($modal);
        return false;
    });
});
