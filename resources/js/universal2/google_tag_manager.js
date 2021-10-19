$(function () {
    $('.gtm-click').click(function () {
        let eventName = $(this).data('click');
        if(undefined === eventName){
            return;
        }
        if('' !== eventName){
            console.log($(this).data('click'));
            dataLayer.push({'event': eventName});
        }
    });

    $('body').on('gtm:event', function (e, targetName){
        console.log(targetName);
        dataLayer.push({'event': targetName});
    });

});
