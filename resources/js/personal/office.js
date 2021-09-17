$('.js-office-name').click(function(){
    let clickedId = $(this).data('id');

    $('.js-office-name').toggleClass('submenu__item_active', function (){
        return $(this).data('id') == clickedId;
    });



    $('.js-office-body').toggleClass('hidden', function (){
        return $(this).data('id') != clickedId;
    });

    return false;
});
