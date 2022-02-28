$(function () {
    $('.js-cookies-confirm').click(function () {
        $.post({
            url: $(this).data('url')
        }).done(function (gtmCode) {
            $('.cookie-confirm').hide();
            $('body').append($(gtmCode));
        });
    });

    $('.cookie-confirm__close').click(function () {
        $('.cookie-confirm').hide();
    });
});
