<div class="modal-container">
    <div class="modal" id="order-message-modal">
        <div class="modal__close"></div>

        <div class="modal__content modal__content_result js-modal-result-ok" style="display: none;">
            <div>
                <div class="modal__result-icon modal__result-icon_ok"></div>
                <div class="modal__result-title">@d('feedback_result_success_1')</div>
                <div class="modal__result-text">@d('feedback_result_success_2')</div>
            </div>
        </div>

        <div class="modal__content modal__content_result js-modal-result-error" style="display: none;">
            <div>
                <div class="modal__result-icon modal__result-icon_error"></div>
                <div class="modal__result-title">@d('feedback_result_error_1')</div>
                <div class="modal__result-text">@d('feedback_result_error_2')</div>
            </div>
        </div>
    </div>
</div>
