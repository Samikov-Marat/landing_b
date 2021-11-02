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
                <a href="#calculator" class="primary-button primary-button_with_arrow gtm-click"
                    data-click="rassitat_b2b">@d('poster_button')</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>

        @if(isset($dictionary['advantages_header_1']))
            @include('site.universal2.international_express_block')
        @endif

        @include('site.universal2.calculator_block')

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')

        @include('site.universal2.faq_block')

        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>

@endsection
