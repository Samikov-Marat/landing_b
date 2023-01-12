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
                <a href="#calculator" class="primary-button primary-button_with_arrow gtm-click"
                   data-click="rassitat_im">@d('delivery_button')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>
        <div class="company-advantages screen">
            <div class="content">
                <h2 class="typo-h2 company-advantages__heading e-commerce-page__company-adv-heading">@d('tariff_header_black') <span class="typo-colored_color_green">@d('tariff_header_green')</span></h2>
                <div class="company-advantages__description e-commerce-page__company-adv-description">
                    @d('tariff_description')
                </div>
                <div class="two-icons e-commerce-page__company-adv-icons">
                    @if ($dictionary['tariff_min_mass_05'])
                        <div class="two-icons__item">
                            <div class="two-icons__icon"></div>
                            <div class="two-icons__text"><span class="two-icons__text-big">@d('tariff_min_mass_05')</span> @d('tariff_min_from_05') <span class="two-icons__text-big">@d('tariff_min_price_05')</span></div>
                        </div>
                    @endif

                    @if ($dictionary['tariff_min_mass_1'])
                        <div class="two-icons__item">
                            <div class="two-icons__icon two-icons__icon_icon_second"></div>
                            <div class="two-icons__text"><span class="two-icons__text-big">@d('tariff_min_mass_1')</span> @d('tariff_min_from_1') <span class="two-icons__text-big">@d('tariff_min_price_1')</span></div>
                        </div>
                    @endif
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
                    <a href="{!!route('request.images','presentation.pdf')!!}" target="_blank" class="ecom-solution__link">@d('solution_download')</a>
                </div>
            </div>
        </div>


        @include('site.universal2.calculator_block')

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')

        @include('site.universal2.faq_block')


        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>
@endsection
