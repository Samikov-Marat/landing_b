<div class="form-order-docs form-order-docs_feedback support-page__form">
    <div class="form-order-docs__content form-order-docs__content__vietnam_ form-order-docs__content_feedback preloader">
        <div class="feedback__heading feedback__heading_mb40">@d('support_new_form_header')</div>
        <form class="form js-support-form js-support-form-wrapper"  method="post" action="{{ route('request.support') }}">
            <input type="hidden" name="language_code_iso" value="{{ $language->language_code_iso }}">
            <div class="form__row">
                <div class="form-field">
                    <input type="text" name="name" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_name'] }}" />
                </div>
            </div>
            <div class="form__row">
                <div class="form-field">
                    <input type="text" name="email" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_email'] }}" />
                </div>
            </div>
            <div class="form__row form__row_support_radio">
                <div class="form-field">
                    <div class="form-field__label">@d('support_new_have_invoice')</div>
                    <div class="form-field__choices">
                        <div class="choice-widget form-field__choices-choice">
                            <input type="radio" name="have_invoice" value="1" id="invoice-1" class="js-support-have-invoice support-focus-reset-error" /><label for="invoice-1">@d('support_new_have_invoice_yes')</label>
                        </div>
                        <div class="choice-widget form-field__choices-choice">
                            <input type="radio" name="have_invoice" value="0" id="invoice-0" class="js-support-have-invoice support-focus-reset-error" /><label for="invoice-0">@d('support_new_have_invoice_no')</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__row js-support-invoice-number-row" style="display: none;">
                <div class="form-field">
                    <input type="text" name="invoice_number" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_invoice_number'] }}" />
                </div>
            </div>
            <div class="form__row">
                <div class="form-field">
                    <select class="form-field__input js-support-select2 support-focus-reset-error" name="summary" placeholder="{{ $dictionary['support_form_theme'] }}">
                        <option></option>
                        @foreach($supportContainer->tree as $category)
                            <option>{{ $category->supportCategoryTexts[0]->name ?? 'error' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form__row">
                <div class="form-field">
                    <textarea name="question" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_custom_question'] }}"></textarea>
                </div>
            </div>
            <input type="hidden" name="url" value="{{ $url->full() }}">
            <div class="form-field">
                <input type="submit" value="{{ $dictionary['support_send'] }}" class="primary-button primary-button_submit" />
            </div>
        </form>

        <div class="form-order-docs__result js-support-result-ok-wrapper" style="display: none;">
            <div class="form-order-docs__result-icon form-order-docs__result-icon_ok"></div>
            <div class="feedback__heading">
                @d('support_success_header')
            </div>
            <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">@d('support_success_text')</div>
            <a href="#" class="alternative-button js-support-new-answer">@d('support_new_more')</a>
        </div>

        <div class="form-order-docs__result js-feedback-result-error-wrapper" style="display: none;">
            <div class="form-order-docs__result-icon form-order-docs__result-icon_error"></div>
            <div class="feedback__heading">
                @d('support_error_header')
            </div>
            <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">
                @d('support_error_text')
            </div>
            <a href="#" class="alternative-button js-support-retry">@d('support_new_retry')</a>
        </div>
    </div>
</div>
