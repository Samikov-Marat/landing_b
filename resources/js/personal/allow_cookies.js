$(function () {
    $('.js-cookies-confirm').click(function () {
        $.post({
            url: $(this).data('url')
        }).done(function () {
            $('.cookie-confirm').hide();
        });
    });

    $('.cookie-confirm__close').click(function () {
        $('.cookie-confirm').hide();
    });

});
