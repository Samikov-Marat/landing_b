@extends('site.universal2.layout')

@section('content')
    <div class="index-page">

        @include('site.universal2.index_poster_block')
        @include('site.universal2.franchisee_news')


        <div class="company-advantages screen">
            <div class="content">
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
</div>

        @if(isset($dictionary['banner_forward_header']))
            @include('site.universal2.banner_forward')
        @endif

        @include('site.universal2.calculator_block', ['customer_type' => 'C', 'receiver_type' => 'C'])


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
            <div id="tracking" style="padding-bottom: 80px;">
                @include('site.personal.tracking')
            </div>
        @endif

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')

        @include('site.universal2.faq_block')

{{--        @include('site.universal2.big_company')--}}

        @include('site.universal2.partners_block')
        @include('site.universal2.any_questions_block')
    </div>
@endsection

