$(function () {

    $('body').on('click', '.js-delete-confirm', function () {
        let $modal = $('.js-delete-confirm-modal');

        $modal.find('.js-delete-confirm-form').prop('action', $(this).data('action'))

        $modal.find('.js-delete-confirm-id').val($(this).data('id'));
        $modal.find('.js-delete-confirm-text').html($(this).data('text'));
        $modal.find('input[name="_method"]').val($(this).data('method') || 'post');

        $modal.modal('show');
    });

});

$(function () {
    $('body').on('click', '.js-delete-country', function () {
        let $modal = $('.js-delete-confirm-modal');

        $modal.find('.js-delete-confirm-form').prop('action', $(this).find('.btn').data('action'));
        $modal.find("input[name='_method']").val('delete');

        $modal.find('.js-delete-confirm-text').html($(this).data('text'));
        $modal.modal('show');
    });
})