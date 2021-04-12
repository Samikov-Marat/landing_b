@extends('site.universal2.layout')

@section('content')

    <div class="business-page">
        <div class="main-poster business-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading business-page__heading">
                    <h1 class="typo-h1">@d('poster_header')</h1>
                </div>
                <div class="circle-icon-list main-poster__icons">
                    <div class="circle-icon circle-icon_icon_business circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_earth circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_calendar circle-icon-list__icon"></div>
                </div>
                <div class="main-poster__text">
                    @d('poster_list')
                </div>
                <a href="#calculator" class="primary-button primary-button_with_arrow">@d('poster_button')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>
        <div class="company-advantages screen-content">
            <h2 class="typo-h2 company-advantages__heading business-page__company-adv-heading">@d('advantages_header_1') <span class="typo-colored_color_green">@d('advantages_header_2')</span></h2>
            <div class="company-advantages__description business-page__company-adv-description">
                @d('advantages_text')
            </div>
            <div class="two-icons business-page__company-adv-icons">
                <div class="two-icons__item">
                    <div class="two-icons__icon"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">0,5 @d('advantages_kg')</span> @d('advantages_from') <span class="two-icons__text-big">69,98 £</span></div>
                </div>
                <div class="two-icons__item">
                    <div class="two-icons__icon two-icons__icon_icon_second"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">1 @d('advantages_kg')</span> @d('advantages_from') <span class="two-icons__text-big">76,52 £</span></div>
                </div>
            </div>
            <div class="square-cards js-company-advantages owl-carousel">
                <div class="square-card square-card_size_big square-card_big-icon_person">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('carousel_header_1')</div>
                    <div class="square-card__description">
                        @d('carousel_text_1')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_contract">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('carousel_header_2')</div>
                    <div class="square-card__description">
                        @d('carousel_text_2')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_mail">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('carousel_header_3')</div>
                    <div class="square-card__description">
                        @d('carousel_text_3')
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_courier">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">@d('carousel_header_4')</div>
                    <div class="square-card__description">
                        @d('carousel_text_4')
                    </div>
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
            <a href="#" class="primary-button js-feedback-open">@d('receive_button')</a>
        </div>
        <div class="package-russia__office">
            <div class="package-russia__office-num">@d('receive_office_count')</div>
            <div class="package-russia__office-text">@d('receive_country_count')</div>
        </div>
    </div>
</div>

        @include('site.universal2.faq_block')

        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>

@endsection
