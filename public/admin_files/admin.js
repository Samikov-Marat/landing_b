$(function () {


    $('body').on('click', '.js-delete-confirm', function () {
        let $modal = $('.js-delete-confirm-modal');

        $modal.find('.js-delete-confirm-form').prop('action', $(this).data('action'))

        $modal.find('.js-delete-confirm-id').val($(this).data('id'));
        $modal.find('.js-delete-confirm-text').html($(this).data('text'));

        $modal.modal('show');
    });

    $('.js-admin-role-permission-block').on('change', function () {
        var $blockCheckbox = $(this);
        $(this).closest('form').find('.js-admin-role-permission').each(function () {
            console.log($blockCheckbox.data('block'), $(this).data('block'));
            if ($blockCheckbox.data('block') == $(this).data('block')) {
                $(this).prop('checked', $blockCheckbox.prop('checked'))
            }
        });
    });

});

