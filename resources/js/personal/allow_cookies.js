$(function () {
    $('.js-cookies-confirm').click(function () {

        $.post({
            url: $(this).data('url')
        }).done(function (){
            $('.cookie-confirm').hide();
        });
    });
});
