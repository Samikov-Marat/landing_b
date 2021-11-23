function FeedbackReviewClass($form){
    this.$form = $form;

    this.send = function(token){
        let $modal = $('.review-add-modal').has(this.$form);
        $modal.addClass('review-add-modal_loading');

        let formExtended = this.$form.serializeArray();
        formExtended.push({name: 'recaptcha_token', value: token});
        let request = {
            url: this.$form.prop('action'),
            data: formExtended
        };

        $.post(request).done(function () {
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
    }
}


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

        let feedbackReview = new FeedbackReviewClass($(this));

        let recaptchaExt = new RecaptchaExt();
        recaptchaExt.setRecaptchaAction('feedback.review');
        recaptchaExt.execute(function (token) {
            feedbackReview.send(token);
        });

        return false;
    });
});
