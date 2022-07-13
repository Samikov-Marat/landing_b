<div class="modal-container">
    <div class="modal" id="feedback-modal">
        <div class="modal__close"></div>
        <div class="modal__content modal__content_form">
            <div class="modal__heading">@d('feedback_header')</div>

            @php
                $templateGtm = [
                    'universal2.index' => 'send_form',
                    'universal2.e_commerce' => 'send_form_im',
                    'universal2.business' => 'send_form_b2b',
                    ];
                $formGtm = $templateGtm[$page->template] ?? '';
            @endphp

            @php
                $pageFormPlace = [
                    'universal2.index' => 'Главная',
                    'universal2.e_commerce' => 'B2C',
                    'universal2.business' => 'B2B',
                    'universal2.documents' => 'Документы',
                    ];
                $formPlace = $pageFormPlace[$page->template] ?? 'Неизвестно';
            @endphp

            <form method="post" action="{!! route('request.feedback') !!}"
                  class="form calculator_form js-feedback-form"
                  data-send-form-event="{{ $formGtm }}">
                <input type="hidden" name="form_place" value="{{ $formPlace }}">
                <div class="form__row">
                    <div class="form-field">
                        <input type="text" name="name" class="form-field__input"
                               placeholder="{{ $dictionary['feedback_name'] }}"/>
                        <div class="form-field__error-message">@d('feedback_error_name')</div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field">
                        <input type="text" name="phone" class="form-field__input"
                               placeholder="{{ $dictionary['feedback_phone'] }}"/>
                        <div class="form-field__error-message">@d('feedback_error_phone')</div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field">
                        <input type="text" name="email" class="form-field__input"
                               placeholder="{{ $dictionary['feedback_email'] }}"/>
                        <div class="form-field__error-message">@d('feedback_error_email')</div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field">
                        <textarea name="message" class="form-field__input"
                                  placeholder="{{ $dictionary['feedback_text'] }}"></textarea>
                    </div>
                </div>
                <div class="form__row form__row_no-input">
                    <div class="checkbox-widget">
                        <input type="checkbox" name="agree" value="да" id="modal-agree"/><label for="modal-agree"><span>@d('footer_feedback_agree_1') <a
                                    class="checkbox-widget__link"
                                    href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}"
                                    target="_blank"
                                >@d('footer_feedback_agree_2')</a></span></label>
                    </div>
                    <div class="form-field__error-message">@d('feedback_agree_error')</div>
                </div>
                <div class="form-field">
                    <button type="submit" class="primary-button primary-button_wide primary-button_submit">
                        @d('feedback_submit')
                    </button>

                    <div class="calculator__description" style="margin-top: 25px;">
                        This site is protected by reCAPTCHA and the Google<br>
                        <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                        <a href="https://policies.google.com/terms">Terms of Service</a> apply.
                    </div>

                </div>
            </form>
        </div>
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
