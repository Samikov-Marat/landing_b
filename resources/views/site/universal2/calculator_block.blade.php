<!-- calculator -->
<div id="calculator" class="calculator">

    @php
        $templateGtm = [
            'universal2.index' => 'rassitat_form',
            'universal2.e_commerce' => 'rassitat_form_im',
            'universal2.business' => 'rassitat_form_b2b',
            'universal2.documents' => 'document_rassitat_form',
            'personal.index' => 'rassitat_form',
            ];
        $showTariffGtm = $templateGtm[$page->template] ?? '';
    @endphp

    @php
    if($dictionary['calculator_show_period'] == '+'){
        $showPeriod = 1;
    }
    else{
        $showPeriod = 0;
    }
    @endphp
    <form action="{!! route('request.send') !!}" method="post" class="js-calculator-form"
          data-calculate-url="{!! route('request.calculate') !!}"
          data-language="{{ $dictionary['calculator_language'] }}"
          data-currency-code="{{ $currency->code ?? 3 }}"
          data-currency-name="{{ $currency->symbol ?? '$' }}"
          data-show-tariffs-event="{{ $showTariffGtm }}"
          data-show-period="{{ $showPeriod }}">

        <input type="hidden" class="form-field__input" name="page" value="{{ $page->url }}">

        @if(!empty($customer_type))
            <input type="hidden" name="customer_type" class="form-field__input" value="{{ $customer_type }}">
        @endif
        @if(!empty($receiver_type))
            <input type="hidden" name="receiver_type" class="form-field__input" value="{{ $receiver_type }}">
        @endif

        <div class="screen-content">
            <div class="calculator__content calculator__content_step1">
                <h2 class="typo-h2 calculator__title">@d('calculator_header')</h2>
                <div class="form calculator_form">
                    @if(!empty($dictionary['calculator_sender_type']))
                        <div class="form__row">
                            <div class="form-order-customer-header">@d('feedback_form_field_customer_type')</div>
                            <div class="form-field">
                                <div class="form-field form-order-customer-type-wrapper">
                                    <div class="choice-widget">
                                        <input type="radio" name="customer_type" value="B" id="id_calculator_legal_entity" class="form-field__input"><label for="id_calculator_legal_entity">@d('feedback_form_field_customer_type_legal_entity')</label>
                                    </div>
                                </div>
                                <div class="form-order-customer-type-wrapper">
                                    <div class="choice-widget">
                                        <input type="radio" name="customer_type" value="C" id="id_calculator_private_individual" class="form-field__input"><label for="id_calculator_private_individual">@d('feedback_form_field_customer_type_private_individual')</label>
                                    </div>
                                </div>
                                <div class="form-field__error-message">@d('feedback_form_customer_type_required')</div>
                            </div>
                        </div>
                    @endif
                    <div class="form__row">
                        <div class="form-field form-field_has_icon form-field_icon_from">
                            <input type="hidden" name="from_id" value="" class="js-calculator-from-id">
                            <input type="text" name="from" class="form-field__input" value=""
                                   data-for=".js-calculator-from-id"
                                   placeholder="{{ $dictionary['calculator_from'] }}" autocomplete="off"/>
                            <div class="form-field__error-message">@d('calculator_from_error')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field form-field_has_icon form-field_icon_to">
                            <input type="hidden" name="to_id" value="" class="js-calculator-to-id">
                            <input type="text" name="to" class="form-field__input" value=""
                                   data-for=".js-calculator-to-id"
                                   placeholder="{{ $dictionary['calculator_to'] }}" autocomplete="off"/>
                            <div class="form-field__error-message">@d('calculator_to_error')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field form-field_has_icon form-field_icon_weight">
                            <input type="text" name="mass" class="form-field__input" value=""
                                   placeholder="{{ $dictionary['calculator_mass'] }}" autocomplete="off"/>
                            <div class="form-field__error-message">@d('calculator_mass_error')</div>
                        </div>
                    </div>
                    <div class="form__three-fields form__row_last">
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="length" class="form-field__input" value=""
                                       placeholder="{{ $dictionary['calculator_length'] }}" autocomplete="off"/>
                                <div class="form-field__error-message">@d('calculator_length_error')</div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="width" class="form-field__input" value=""
                                       placeholder="{{ $dictionary['calculator_width'] }}" autocomplete="off"/>
                                <div class="form-field__error-message">@d('calculator_width_error')</div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="height" class="form-field__input" value=""
                                       placeholder="{{ $dictionary['calculator_height'] }}" autocomplete="off"/>
                                <div class="form-field__error-message">@d('calculator_height_error')</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-field">
                        <input type="button" value="{{ $dictionary['calculator_calculate'] }}"
                               class="primary-button primary-button_wide primary-button_submit js-calculator-step1-button"/>
                    </div>

                </div>
                <div class="calculator__description">
                    @d('calculator_description')
                </div>
            </div>
            <div class="calculator__content calculator__content_step2" style="display: none;">
                <div class="calculator__step-container">
                    <a href="#" class="calculator__step-link calculator__step-link_back">@d('calculator_change_condition')</a>
                </div>
                <div class="calculator__tariff-used">
                    <div>
                        <span class="js-calculator-header-from">откуда</span> <span
                            class="typo-colored typo-colored_color_green">—</span> <span
                            class="js-calculator-header-to">куда</span><br/>
                        @d('calculator_parcel_total') <span class="js-calculator-header-mass">???</span>
                        @d('calculator_parcel_kg'), <span class="js-calculator-header-volume">???</span>
                        @d('calculator_parcel_m')<sup>3</sup>
                    </div>
                </div>
                <h2 class="typo-h2 calculator__title">@d('calculator_tariff_list_header')</h2>

                <div class="hidden js-calculator-tariff-template">
                    <div class="calculator__tariff-item">
                        <div>
                            <div class="calculator__tariff-item-title">
                                <div class="choice-widget">
                                    <input type="radio" name="tariff" value="1" id="tariff-0"
                                           class="calculator__tariff-item-input"/><label
                                        class="calculator__tariff-item-label" for="tariff-0">Название тарифа</label>
                                </div>
                            </div>
                            <div class="calculator__tariff-item-info">
                                <div class="calculator__tariff-item-description">
                                    Описание тарифа
                                </div>
                                <div class="calculator__tariff-item-type">Дверь-дверь</div>

                                <div class="calculator__tariff-item-period-prefix" style="display: none;">@d('calculator_period_definition')</div>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-price calculator_currency_sign">Цена ₽</div>
                    </div>
                </div>

                <div class="calculator__tariff-list"></div>
                <input type="button" value="{{ $dictionary['calculator_choose_tariff_button'] ?? 'Choose a tariff' }}"
                       class="primary-button primary-button_wide primary-button_submit js-calculator-step2-button"/>
            </div>
            <div class="calculator__content calculator__content_step3" style="display: none;">
                <div class="calculator__step-container">
                    <a href="#" class="calculator__step-link calculator__step-link_back">@d('calculator_change_condition')</a>
                    <a href="#" class="calculator__step-link calculator__step-link_repeat">@d('calculator_reset')</a>
                </div>
                <div class="calculator__tariff-used">
                    <div>
                        <span class="js-calculator-header-from">из города</span> <span
                            class="typo-colored typo-colored_color_green">—</span> <span
                            class="js-calculator-header-to">в город</span><br/>
                        @d('calculator_parcel_total') <span class="js-calculator-header-mass">вес</span>
                        @d('calculator_parcel_kg'), <span class="js-calculator-header-volume">объём</span>
                        @d('calculator_parcel_m')<sup>3</sup>
                    </div>
                    <div class="calculator__tariff-used-price js-calculator-header-price calculator_currency_sign">0.00
                        ₽
                    </div>
                </div>
                <div class="calculator__contact-title">@d('calculator_contacts_title')</div>
                <div class="calculator__contact-description">
                    @d('calculator_contacts_description')
                </div>
                <div class="form calculator_form">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="name" class="form-field__input"
                                   placeholder="{{ $dictionary['calculator_contacts_name'] }}"/>
                            <div class="form-field__error-message">@d('calculator_contacts_name_error')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="phone" class="form-field__input"
                                   placeholder="{{ $dictionary['calculator_contacts_phone'] }}"/>
                            <div class="form-field__error-message">@d('calculator_contacts_phone_error')</div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="email" class="form-field__input"
                                   placeholder="{{ $dictionary['calculator_contacts_email'] }}"/>
                            <div class="form-field__error-message">@d('calculator_contacts_email_error')</div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form-order-customer-header">@d('calculator_form_field_customer_type')</div>
                        <div class="form-field">

                            <div class="form-order-customer-type-wrapper">
                                <div class="choice-widget">
                                    <input type="radio" name="customer_type" value="legal_entity"
                                           id="id_calculator_legal_entity" class="js-form-order-customer-type"><label
                                        for="id_calculator_legal_entity">@d('calculator_form_field_customer_type_legal_entity')</label>
                                </div>
                            </div>
                            <div class="form-order-customer-type-wrapper">
                                <div class="choice-widget">
                                    <input type="radio" name="customer_type" value="private_individual"
                                           id="id_calculator_private_individual"
                                           class="js-form-order-customer-type"><label
                                        for="id_calculator_private_individual">@d('calculator_form_field_customer_type_private_individual')</label>
                                </div>
                            </div>
                            <div class="form-field__error-message">@d('calculator_form_customer_type_required')</div>
                        </div>
                    </div>

                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" value="да" id="agree"/><label for="agree"><span>@d('calculator_contacts_confirm_1')

                                        <a
                                            class="checkbox-widget__link"
                                            href="{!! privacy_policy($dictionary, $language) !!}"
                                            target="_blank">@d('calculator_contacts_confirm_2')</a>

                                </span></label>
                        </div>
                        <div class="form-field__error-message">@d('calculator_contacts_agree_error')</div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="{{ $dictionary['calculator_contacts_submit'] }}"
                               class="primary-button primary-button_wide primary-button_submit"/>
                    </div>
                </div>
                <div class="calculator__description">
                    This site is protected by reCAPTCHA and the Google<br>
                    <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                    <a href="https://policies.google.com/terms">Terms of Service</a> apply.
                </div>

            </div>
            <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-ok"
                 style="display: none;">
                <div>
                    <div class="calculator__result-icon calculator__result-icon_ok"></div>
                    <div class="calculator__result-title">@d('calculator_contacts_success_title')</div>
                    <div class="calculator__result-text">@d('calculator_contacts_success_description')</div>
                    <div class="calculator__step-container calculator__step-container_single">
                        <a href="#"
                           class="calculator__step-link calculator__step-link_repeat">@d('calculator_reset')</a>
                    </div>
                </div>
            </div>
            <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-error"
                 style="display: none;">
                <div>
                    <div class="calculator__result-icon calculator__result-icon_error"></div>
                    <div class="calculator__result-title">@d('calculator_contacts_error_title')</div>
                    <div class="calculator__result-text">@d('calculator_contacts_error_description')</div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /calculator -->
