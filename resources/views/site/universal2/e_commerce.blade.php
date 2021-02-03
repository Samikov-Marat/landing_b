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


        @include('site.universal2.calculator_block')

        @include('site.universal2.how_it_works_block')


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
