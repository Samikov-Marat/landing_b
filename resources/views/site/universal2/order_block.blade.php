<div class="form-order-docs screen">
    <div class="form-order-docs__bg">
        <div class="content">
            <div class="form-order-docs__content">
                <div class="form-order-docs__title">
                    @d('order_form_header')
                </div>
                <form method="post" action="{!! route('request.order') !!}" class="form order-form js-order-form">
                    <input type="hidden" name="type" value="{{ $orderFormType }}">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="name" class="form-field__input" placeholder="{{ $dictionary['order_form_field_1'] }}"/>
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="phone" class="form-field__input" placeholder="{{ $dictionary['order_form_field_2'] }}"/>
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="email" class="form-field__input" placeholder="{{ $dictionary['order_form_field_3'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="org" class="form-field__input" placeholder="{{ $dictionary['order_form_field_4'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_from" class="form-field__input" placeholder="{{ $dictionary['order_form_field_5'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_to" class="form-field__input" placeholder="{{ $dictionary['order_form_field_6'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_to_string" class="form-field__input" placeholder="{{ $dictionary['order_form_field_7'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <textarea name="items_description" class="form-field__input" placeholder="{{ $dictionary['order_form_field_8'] }}"></textarea>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="items_link" class="form-field__input" placeholder="{{ $dictionary['order_form_field_9'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="items_cost" class="form-field__input" placeholder="{{ $dictionary['order_form_field_10'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" id="order-agree" /><label for="order-agree"><span>@d('order_form_field_agree_1') <a class="checkbox-widget__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}" target="_blank">@d('order_form_field_agree_2')</a></span></label>
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="{{ $dictionary['order_form_field_submit'] }}" class="primary-button primary-button_wide primary-button_submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
