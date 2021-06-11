$(function () {

    $('body').on('click', '.js-delete-confirm', function () {
        let $modal = $('.js-delete-confirm-modal');

        $modal.find('.js-delete-confirm-form').prop('action', $(this).data('action'))

        $modal.find('.js-delete-confirm-id').val($(this).data('id'));
        $modal.find('.js-delete-confirm-text').html($(this).data('text'));

        $modal.modal('show');
    });

});

