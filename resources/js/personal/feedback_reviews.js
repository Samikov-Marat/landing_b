$(function () {

    $('.js-feedback-review-form').submit(function () {
        let $name = $(this).find('.js-feedback-review-name');
        let $email = $(this).find('.js-feedback-review-email');
        let $text = $(this).find('.js-feedback-review-text');
        let $checkbox = $(this).find('.js-feedback-review-checkbox');
        let hasError = false;
        if ('' == $.trim($name.val())) {
            $name.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        if ('' == $.trim($email.val())) {
            $email.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        if ('' == $.trim($text.val())) {
            $text.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        if (!$checkbox.prop('checked')) {
            $checkbox.closest('.form-field').addClass('form-field_error');
            hasError = true;
        }
        if (hasError) {
            return false;
        }

        var $modal = $('.review-add-modal').has(this);
        $modal.addClass('review-add-modal_loading');
        $.post({
            url: $(this).prop('action'),
            data: $(this).serialize()
        }).done(function () {

            setTimeout(function () {
                $modal.removeClass('review-add-modal_loading');
                $modal.find('.js-modal-result-hide').hide();
                $modal.find('.js-modal-result-ok').show();
            }, 1000);

        }).fail(function () {
            setTimeout(function () {
                $modal.removeClass('review-add-modal_loading');
                $modal.find('.js-modal-result-hide').hide();
                $modal.find('.js-modal-result-error').show();
            }, 1000);
        });
        return false;
    });
});
