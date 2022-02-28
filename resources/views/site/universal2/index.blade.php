@extends('site.universal2.layout')

@section('content')
    <div class="index-page">
        <div class="main-poster index-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading index-page__poster-heading">
                    <h1 class="typo-h1">@d('delivery_from')</h1> <span class="main-poster__heading-added typo-h1">@d('delivery_from_price')</span>
                </div>
                <div class="circle-icon-list main-poster__icons">
                    <div class="circle-icon circle-icon_icon_cart circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_business circle-icon-list__icon"></div>
                </div>
                <div class="main-poster__text">
                    @d('delivery_list')
                </div>
                <a href="#calculator" class="primary-button primary-button_with_arrow gtm-click"
                   data-click="rassitat">@d('delivery_calculate')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
            <picture  class="index-page__poster-image-wrapper">
                <source srcset="/request/images/index/poster-mobile.jpg, /request/images/index/poster-mobile-2x.jpg 2x">
                <img src="/request/images/index/poster-mobile.jpg" alt="" class="index-page__poster-image">
            </picture>
        </div>
        <div class="company-advantages screen-content">
    <h2 class="typo-h2 company-advantages__heading">@d('why_header')</h2>
    <div class="company-advantages__description">
        @d('why_description')
    </div>
    <div class="square-cards js-company-advantages owl-carousel">
        <div class="square-card square-card_icon_customs">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('why_simple_header')</div>
            <div class="square-card__description">
                @d('why_simple_text1') <span class="typo-bold">@d('why_simple_text2')</span> @d('why_simple_text3');
            </div>
        </div>
        <div class="square-card square-card_icon_settings">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('why_profitably_header')</div>
            <div class="square-card__description">
                @d('why_profitably_text1') <span class="typo-bold">@d('why_profitably_text2')</span>@d('why_profitably_text3')
            </div>
        </div>
        <div class="square-card square-card_icon_protect">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('why_trusty_header')</div>
            <div class="square-card__description">
                @d('why_trusty_text1') <span class="typo-bold">@d('why_trusty_text2')</span>
            </div>
        </div>
        <div class="square-card square-card_icon_lorry">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('why_available_header')</div>
            <div class="square-card__description">
                @d('why_available_text1') <span class="typo-bold">@d('why_available_text2')</span>
            </div>
        </div>
        <div class="square-card square-card_icon_parcels">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('why_comfortably_header')</div>
            <div class="square-card__description">
                @d('why_comfortably_text1') <span class="typo-bold">@d('why_comfortably_text2') </span>@d('why_comfortably_text3') <span class="typo-bold"> @d('why_comfortably_text4')</span>
            </div>
        </div>
    </div>
</div>

        @include('site.universal2.calculator_block')


        <div class="index-special-conditions screen-content">
            <h2 class="typo-h2 index-special-conditions__title">@d('special_conditions_title')</h2>
            <div class="index-special-conditions__content">
                <div class="index-special-conditions__dots-left background-dots background-dots_size_3x4"></div>
                <div class="index-special-conditions__dots-right background-dots"></div>
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'e-commerce']) !!}"
                   class="index-special-conditions__card index-special-conditions__card_yellow gtm-click"
                   data-click="perehod_im">
                    <div class="index-special-conditions__card-text">@d('special_conditions_tab_shop')</div>
                    <div class="index-special-conditions__arrow"></div>
                </a>
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'business']) !!}"
                   class="index-special-conditions__card gtm-click"
                   data-click="perehod_b2b">
                    <div class="index-special-conditions__card-text">@d('special_conditions_tab_business')</div>
                    <div class="index-special-conditions__arrow"></div>
                </a>
            </div>
        </div>

        @if(isset($dictionary['personal_tracking_2']))
            @include('site.personal.tracking')
        @endif

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')

        @include('site.universal2.faq_block')


        <div class="index-big-company">
            <div class="content">
                <div class="index-big-company__content">
                    <div class="index-big-company__dots-top background-dots background-dots_size_3x8"></div>
                    <h2 class="typo-h2 index-big-company__title">@d('big_header')</h2>
                    <div class="divider index-big-company__divider"></div>
                    <div class="index-big-company__text">
                        @d('big_text')
                    </div>
                    <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'company']) !!}" class="primary-button">@d('big_details')</a>
                </div>
            </div>
        </div>

        @include('site.universal2.partners_block')
        @include('site.universal2.any_questions_block')
    </div>
@endsection

