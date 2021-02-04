<div class="calculator">
    <form action="{!! route('request.send') !!}" method="post" class="js-calculator-form">
        {!! csrf_field() !!}
    <div class="screen-content">
        <div class="calculator__content calculator__content_step1">
            <h2 class="typo-h2 calculator__title">@d('calculator_header')</h2>
            <div class="form calculator_form">
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
                    <span class="js-calculator-header-from">откуда</span> <span class="typo-colored typo-colored_color_green">—</span> <span class="js-calculator-header-to">куда</span><br/>
                    @d('calculator_parcel_total') <span class="js-calculator-header-mass">???</span> @d('calculator_parcel_kg'), <span class="js-calculator-header-volume">???</span>
                    @d('calculator_parcel_m')<sup>3</sup>
                </div>
            </div>
            <h2 class="typo-h2 calculator__title">@d('calculator_tariff_list_header')</h2>

            <div class="hidden js-calculator-tariff-template">
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="1" id="tariff-0"  class="calculator__tariff-item-input"/><label class="calculator__tariff-item-label" for="tariff-0">Название тарифа</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">
                                Описание тарифа
                            </div>
                            <div class="calculator__tariff-item-type">Дверь-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">Цена ₽</div>
                </div>
            </div>

            <div class="calculator__tariff-list">



            </div>
        </div>
        <div class="calculator__content calculator__content_step3" style="display: none;">
            <div class="calculator__step-container">
                <a href="#" class="calculator__step-link calculator__step-link_back">@d('calculator_change_condition')</a>
                <a href="#" class="calculator__step-link calculator__step-link_repeat">@d('calculator_reset')</a>
            </div>
            <div class="calculator__tariff-used">
                <div>
                    <span class="js-calculator-header-from">из города</span> <span class="typo-colored typo-colored_color_green">—</span> <span class="js-calculator-header-to">в город</span><br/>
                    @d('calculator_parcel_total') <span class="js-calculator-header-mass">вес</span> @d('calculator_parcel_kg'), <span class="js-calculator-header-volume">объём</span>
                    @d('calculator_parcel_m')<sup>3</sup>
                </div>
                <div class="calculator__tariff-used-price js-calculator-header-price">0.00 ₽</div>
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
                <div class="form__row form__row_no-input">
                    <div class="checkbox-widget">
                        <input type="checkbox" name="agree" value="да" id="agree"/><label for="agree"><span>@d('calculator_contacts_confirm_1') <a
                                    class="checkbox-widget__link"
                                    href="#">@d('calculator_contacts_confirm_2')</a></span></label>
                    </div>
                    <div class="form-field__error-message">@d('calculator_contacts_agree_error')</div>
                </div>
                <div class="form-field">
                    <input type="submit" value="{{ $dictionary['calculator_contacts_submit'] }}"
                           class="primary-button primary-button_wide primary-button_submit"/>
                </div>
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
