$('.js-office-name').click(function () {
    let clickedId = $(this).data('id');

    $('.js-office-name').each(function () {
        $(this).toggleClass('submenu__item_active', $(this).data('id') == clickedId);
    });

    $('.js-office-body').each(function () {
        $(this).toggleClass('hidden', $(this).data('id') != clickedId);
    })

    return false;
});
