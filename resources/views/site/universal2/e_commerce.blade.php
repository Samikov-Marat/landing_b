@extends('site.universal2.layout')

@section('content')


    <div class="e-commerce-page">
        <div class="main-poster e-commerce-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading e-commerce-page__heading">
                    <h1 class="typo-h1">@d('delivery_header')</h1>
                </div>
                <div class="circle-icon-list main-poster__icons">
                    <div class="circle-icon circle-icon_icon_courier circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_ru circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_calendar circle-icon-list__icon"></div>
                </div>
                <div class="main-poster__text">
                    @d('delivery_list')
                </div>
                <a href="#" class="primary-button primary-button_with_arrow">@d('delivery_button')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>
        <div class="company-advantages screen-content">
            <h2 class="typo-h2 company-advantages__heading e-commerce-page__company-adv-heading">@d('tariff_header_black') <span class="typo-colored_color_green">@d('tariff_header_green')</span></h2>
            <div class="company-advantages__description e-commerce-page__company-adv-description">
                @d('tariff_description')
            </div>
            <div class="two-icons e-commerce-page__company-adv-icons">
                <div class="two-icons__item">
                    <div class="two-icons__icon"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">@d('tariff_min_mass_05')</span> @d('tariff_min_from_05') <span class="two-icons__text-big">@d('tariff_min_price_05')</span></div>
                </div>
                <div class="two-icons__item">
                    <div class="two-icons__icon two-icons__icon_icon_second"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">@d('tariff_min_mass_1')</span> @d('tariff_min_from_1') <span class="two-icons__text-big">@d('tariff_min_price_1')</span></div>
                </div>
            </div>
            <div class="square-cards js-company-advantages owl-carousel">
                <div class="square-card square-card_size_big square-card_big-icon_packages">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('tariff_slider_header_1')</div>
                    <div class="square-card__description">
                        @d('tariff_slider_text_1')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_contract">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('tariff_slider_header_2')</div>
                    <div class="square-card__description">
                        @d('tariff_slider_text_2')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_mail">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('tariff_slider_header_3')</div>
                    <div class="square-card__description">
                        @d('tariff_slider_text_3')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_integration">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('tariff_slider_header_4')</div>
                    <div class="square-card__description">
                        @d('tariff_slider_text_4')
                    </div>
                </div>
            </div>
        </div>
        <div class="ecom-solution screen">
            <div class="content">
                <div class="ecom-solution__content">

                    <div class="ecom-solution__title">@d('solution_header')</div>
                    <div class="ecom-solution__desc">@d('solution_description')</div>
                    <div class="ecom-solution__list">
                        <div class="ecom-solution__item ecom-solution__item_icon_1">@d('solution_slider_1')</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_2">@d('solution_slider_2')</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_3">@d('solution_slider_3')</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_4">@d('solution_slider_4')</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_5">@d('solution_slider_5')</div>
                    </div>
                </div>
                <div class="ecom-solution__promo">
                    <div class="ecom-solution__promo-title">@d('solution_header_2')</div>
                    <div class="ecom-solution__promo-list">
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_heart">
                            <div class="ecom-solution__promo-list-num">@d('solution_number_1')</div>
                            <div class="ecom-solution__promo-list-text">@d('solution_text_1')</div>
                        </div>
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_eye">
                            <div class="ecom-solution__promo-list-num">@d('solution_number_2')</div>
                            <div class="ecom-solution__promo-list-text">@d('solution_text_2')</div>
                        </div>
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_mail">
                            <div class="ecom-solution__promo-list-num">@d('solution_number_3')</div>
                            <div class="ecom-solution__promo-list-text">@d('solution_text_3')</div>
                        </div>
                    </div>
                    <a href="#" class="ecom-solution__link">@d('solution_download')</a>
                </div>
            </div>
        </div>
        <div class="calculator">
    <div class="screen-content">
        <div class="calculator__content calculator__content_step1">
            <h2 class="typo-h2 calculator__title">@d('why_calculator_header')</h2>
            <div class="form calculator_form">
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_from">
                        <input type="text" name="from" class="form-field__input" placeholder="{{ $dictionary['why_calculator_from'] }}" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_to">
                        <input type="text" name="to" class="form-field__input" placeholder="{{ $dictionary['why_calculator_to'] }}" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_weight">
                        <input type="text" name="weight" class="form-field__input" placeholder="{{ $dictionary['why_calculator_mass'] }}" />
                    </div>
                </div>
                <div class="form__three-fields form__row_last">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="length" class="form-field__input" placeholder="{{ $dictionary['why_calculator_length'] }}" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="width" class="form-field__input" placeholder="{{ $dictionary['why_calculator_width'] }}" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="height" class="form-field__input" placeholder="{{ $dictionary['why_calculator_height'] }}" />
                        </div>
                    </div>
                </div>
                <div class="form-field">
                    <input type="submit" value="{{ $dictionary['why_calculator_calculate'] }}" class="primary-button primary-button_wide primary-button_submit" />
                </div>
            </div>
            <div class="calculator__description">
                @d('why_calculator_description')
            </div>
        </div>
        <div class="calculator__content calculator__content_step2" style="display: none;">
            <div class="calculator__step-container">
                <a href="#" class="calculator__step-link calculator__step-link_back">@d('why_calculator_change_condition')</a>
            </div>
            <div class="calculator__tariff-used">
                <div>
                    Деланко, Нью-Джерси <span class="typo-colored typo-colored_color_green">—</span> Москва<br />
                    @d('why_calculator_parcel_total') 1 @d('why_calculator_parcel_kg'), 0.01 @d('why_calculator_parcel_m')3
                </div>
            </div>
            <h2 class="typo-h2 calculator__title">@d('why_calculator_tariff_list_header')</h2>
            <div class="calculator__tariff-list">
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="1" id="tariff-1" /><label for="tariff-1">Международный экспресс документы</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка документов для бизнеса и частных лиц</div>
                            <div class="calculator__tariff-item-type">Дверь-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">7 360 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="2" id="tariff-2" /><label for="tariff-2">Международный экспресс грузы</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка образцов и другой продукции для бизнеса</div>
                            <div class="calculator__tariff-item-type">Дверь-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">8 100 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="3" id="tariff-3" /><label for="tariff-3">CDEK-Express</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка только от интернет-магазинов клиентам</div>
                            <div class="calculator__tariff-item-type">Cклад-склад</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">983.72 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="3" id="tariff-4" /><label for="tariff-4">CDEK-Express</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка только от интернет-магазинов клиентам</div>
                            <div class="calculator__tariff-item-type">Cклад-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">1 102.72 ₽</div>
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step3" style="display: none;">
            <div class="calculator__step-container">
                <a href="#" class="calculator__step-link calculator__step-link_back">@d('why_calculator_change_condition')</a>
                <a href="#" class="calculator__step-link calculator__step-link_repeat">@d('why_calculator_reset')</a>
            </div>
            <div class="calculator__tariff-used">
                <div>
                    Деланко, Нью-Джерси <span class="typo-colored typo-colored_color_green">—</span> Москва<br />
                    Посылка 1кг, 0.01 м3
                </div>
                <div class="calculator__tariff-used-price">983.72 ₽</div>
            </div>
            <div class="calculator__contact-title">@d('why_calculator_contacts_title')</div>
            <div class="calculator__contact-description">
                @d('why_calculator_contacts_description')
            </div>
            <div class="form calculator_form">
                <div class="form__row">
                    <div class="form-field">
                        <input type="text" name="name" class="form-field__input" placeholder="{{ $dictionary['why_calculator_contacts_name'] }}" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_error">
                        <input type="text" name="phone" class="form-field__input" placeholder="{{ $dictionary['why_calculator_contacts_phone'] }}" />
                        <div class="form-field__error-message">@d('why_calculator_contacts_phone_error')</div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_error">
                        <input type="text" name="email" class="form-field__input" placeholder="{{ $dictionary['why_calculator_contacts_email'] }}" />
                        <div class="form-field__error-message">@d('why_calculator_contacts_email_error')</div>
                    </div>
                </div>
                <div class="form__row form__row_no-input">
                    <div class="checkbox-widget">
                        <input type="checkbox" name="agree" id="agree" /><label for="agree"><span>@d('why_calculator_contacts_confirm_1') <a class="checkbox-widget__link" href="#">@d('why_calculator_contacts_confirm_2')</a></span></label>
                    </div>
                </div>
                <div class="form-field">
                    <input type="submit" value="{{ $dictionary['why_calculator_contacts_submit'] }}" class="primary-button primary-button_wide primary-button_submit" />
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-ok" style="display: none;">
            <div>
                <div class="calculator__result-icon calculator__result-icon_ok"></div>
                <div class="calculator__result-title">@d('why_calculator_contacts_success_title')</div>
                <div class="calculator__result-text">@d('why_calculator_contacts_success_description')</div>
                <div class="calculator__step-container calculator__step-container_single">
                    <a href="#" class="calculator__step-link calculator__step-link_repeat">@d('why_calculator_reset')</a>
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-error" style="display: none;">
            <div>
                <div class="calculator__result-icon calculator__result-icon_error"></div>
                <div class="calculator__result-title">@d('why_calculator_contacts_error_title')</div>
                <div class="calculator__result-text">@d('why_calculator_contacts_error_description')</div>
            </div>
        </div>
    </div>
</div>
        <div class="how-it-works">
            <h2 class="typo-h2 how-it-works__title">@d('how_title')</h2>
            <div class="submenu submenu_centered how-it-works__submenu">
                <div class="submenu__content">
                    <div class="submenu__item submenu__item_active">@d('how_tab_shop')</div>
                    <a href="#" class="submenu__item">@d('how_tab_business')</a>
                </div>
            </div>
            <div class="content">
                <div class="how-it-works__content index-page__how-it-works-content">
                    <div class="index-page__how-it-works-dots background-dots"></div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_contract"></div>
                        </div>
                        <div class="how-it-works__item-num">1.</div>
                        <div class="how-it-works__item-text">@d('how_text_1')</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_lorry"></div>
                        </div>
                        <div class="how-it-works__item-num">2.</div>
                        <div class="how-it-works__item-text">@d('how_text_2')</div>
                    </div>
                    <div class="how-it-works__item how-it-works__item_no-margin">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_stock"></div>
                        </div>
                        <div class="how-it-works__item-num">3.</div>
                        <div class="how-it-works__item-text">@d('how_text_3')</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_phone"></div>
                        </div>
                        <div class="how-it-works__item-num">4.</div>
                        <div class="how-it-works__item-text">@d('how_text_4')</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_got"></div>
                        </div>
                        <div class="how-it-works__item-num">5.</div>
                        <div class="how-it-works__item-text">@d('how_text_5')</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="package-russia screen">
    <div class="package-russia__content content">
        <div class="package-russia__text">
            <h2 class="typo-h2 package-russia__title">@d('receive_title')</h2>
            <div class="package-russia__ways">
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_map"></div>
                    <div class="package-russia__way-text">@d('receive_text_1')</div>
                </div>
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_hand-box"></div>
                    <div class="package-russia__way-text">@d('receive_text_2')</div>
                </div>
            </div>
            <div class="divider package-russia__divider"></div>
            <div class="package-russia__know-more">@d('receive_more')</div>
            <a href="#" class="primary-button">@d('receive_button')</a>
        </div>
        <div class="package-russia__office">
            <div class="package-russia__office-num">@d('receive_office_count')</div>
            <div class="package-russia__office-text">@d('receive_country_count')</div>
        </div>
    </div>
</div>

        @include('site.universal2.faq_block')

        <div class="partner">
    <div class="content">
        <h2 class="typo-h2 partner__title">@d('partners_header')</h2>
        <div class="partner__list">
            <div class="partner__item partner__item_asos"></div>
            <div class="partner__item partner__item_ebay"></div>
            <div class="partner__item partner__item_aliexpress"></div>
            <div class="partner__item partner__item_ozon"></div>
            <div class="partner__item partner__item_yves-rocher"></div>
            <div class="partner__item partner__item_loreal"></div>
            <div class="partner__item partner__item_oriflame"></div>
            <div class="partner__item partner__item_avon"></div>
            <div class="partner__item partner__item_mary-key"></div>
            <div class="partner__item partner__item_rebound"></div>
        </div>
        <div class="partner__more-container">
            <a href="#" class="partner__more">@d('partners_details')</a>
        </div>
    </div>
</div>
        <div class="question">
    <div class="question__content">
        <div class="question__icon-1">
            <div class="question__icon-2">
                <div class="question__icon-3">?</div>
            </div>
        </div>
        <div class="question__title">@d('any_question_text_1')</div>
        <div class="question__desc">@d('any_question_text_2')</div>
        <div class="question__desc-2">@d('any_question_text_3')</div>
        <a href="#" class="primary-button js-feedback-open">@d('any_question_text_4')</a>
    </div>
</div>
    </div>
@endsection
