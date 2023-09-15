<div class="form-order-docs screen">
    <div class="form-order-docs__bg">
        <div class="content">
            <div class="form-order-docs__content">
                <div class="form-order-docs__title">
                    @if('documents_order' == $orderFormType)
                        @d('order_form_header_documents')
                    @elseif('business_order' == $orderFormType)
                        @d('order_form_header_business')
                    @endif
                </div>
                <form method="post" action="{!! route('request.order') !!}" class="form order-form js-order-form"  data-send-form-event="send_order">
                    <input type="hidden" name="type" value="{{ $orderFormType }}">
                    <input type="hidden" name="form_url" value="{{ $url->full() }}">
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

                    @if('business_order' != $orderFormType)
                    <div class="form__row">
                        <div class="form-order-customer-header">@d('order_form_field_customer_type')</div>
                        <div class="form-field">
                            <div class="form-order-customer-type-wrapper">
                                <div class="choice-widget">
                                    <input type="radio" name="customer_type" value="legal_entity" id="id_legal_entity" class="js-form-order-customer-type"><label for="id_legal_entity">@d('order_form_field_customer_type_legal_entity')</label>
                                </div>
                            </div>
                            <div class="form-order-customer-type-wrapper">
                                <div class="choice-widget">
                                    <input type="radio" name="customer_type" value="private_individual" id="id_private_individual" class="js-form-order-customer-type"><label for="id_private_individual">@d('order_form_field_customer_type_private_individual')</label>
                                </div>
                            </div>
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    @else
                        <input type="hidden" name="customer_type" value="legal_entity" class="js-form-order-customer-type-hidden">
                    @endif


                    <div class="form__row hidden js-form-order-org">
                        <div class="form-field">
                            <input type="text" name="org" class="form-field__input" placeholder="{{ $dictionary['order_form_field_4'] }}" />
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <select  name="country_from" class="form-field__input js-order-select2" placeholder="{{ $dictionary['order_form_field_5'] }}" >
                                <option></option>
                                @foreach($countriesFrom as $country)
                                    <option value="{{ $country->jira_code }}">{{ $country->countryTexts[0]->value ?? $country->jira_code }}</option>
                                @endforeach
                            </select>
                            <div class="form-field__error-message">@d('order_form_required')</div>
                        </div>
                    </div>
                    @php
                        $templateGtm = [
                            'universal2.documents' => 'document_order_done'
                            ];
                        $buttonGtm = $templateGtm[$page->template] ?? '';
                    @endphp
                    <div class="form__row">
                        <div class="form-field">
                            <select  name="country_to" class="form-field__input js-order-select2" placeholder="{{ $dictionary['order_form_field_6'] }}" >
                                <option></option>
                            @foreach($countriesTo as $country)
                                <option value="{{ $country->jira_code }}">{{ $country->countryTexts[0]->value ?? $country->jira_code }}</option>
                            @endforeach
                            </select>
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
                        <input type="submit" value="{{ $dictionary['order_form_field_submit'] }}" class="primary-button primary-button_wide primary-button_submit gtm-click"
                               data-click="{{$buttonGtm}}"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal-container">
    <div class="modal" id="order-message-modal">
        <div class="modal__close"></div>

        <div class="modal__content modal__content_result js-modal-result-ok">
            <div>
                <div class="modal__result-icon modal__result-icon_ok"></div>
                <div class="modal__result-title">@d('order_result_success_1')</div>
                <div class="modal__result-text">@d('order_result_success_2')</div>
            </div>
        </div>

        <div class="modal__content modal__content_result js-modal-result-error">
            <div>
                <div class="modal__result-icon modal__result-icon_error"></div>
                <div class="modal__result-title">@d('order_result_error_1')</div>
                <div class="modal__result-text">@d('order_result_error_2')</div>
            </div>
        </div>
    </div>
</div>

