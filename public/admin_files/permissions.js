$(function () {

    $('.js-admin-role-permission-block').on('click', function () {
        let $blockCheckbox = $(this);
        let checked = $(this).data('action') == 'on' ? true : false;
        $(this).closest('form').find('.js-admin-role-permission').each(function () {
            if ($blockCheckbox.data('block') == $(this).data('block')) {
                $(this).prop('checked', checked)
            }
        });
    });

});

