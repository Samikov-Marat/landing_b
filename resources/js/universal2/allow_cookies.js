$(function () {
    $('.js-cookies-confirm-form').submit(function (){
        let formSerializedArray = $(this).serializeArray();
        formSerializedArray.push({"name":'preferred_response', "value": 'redirect' })
        $.post({
            url: $(this).prop('action'),
            data: formSerializedArray
        }).done(function (gtmCode) {
            $('.cookie-confirm').hide();
            $('head').append($(gtmCode));
        });
        return false;
    });

    $('.cookie-confirm__close').click(function () {
        $('.cookie-confirm').hide();
    });
});
