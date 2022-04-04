<!DOCTYPE html>
<html @if($language->rtl) dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <title>@d('title')</title>

    <script>
        dataLayer = [];
    </script>

    @if($allowCookies)
        @include('site.universal2.gtm_block')
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="/universal2/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ mix('universal2/app.css') }}">
    <link rel="stylesheet" href="{{ mix('universal2/info.css') }}">
    <link rel="stylesheet" href="/request/images/theme.css">
    <link rel="stylesheet" href="{{ mix('universal2/custom.css') }}">
</head>
<body class="site-theme">

@php

    $templateHref = [
        'universal2.index' => '#calculator',
        'universal2.e_commerce' => '#calculator',
        'universal2.business' => '#calculator',
        'universal2.contacts' => '/#calculator',
        ];
    $calculatorHeaderAnchorHref = $templateHref[$page->template] ?? '/#calculator';


    $templateGtm = [
        'universal2.index' => 'rassitat_header',
        'universal2.e_commerce' => 'rassitat_header_im',
        'universal2.business' => 'rassitat_header_b2b',
        ];
    $calculatorHeaderAnchorGtm = $templateGtm[$page->template] ?? '';
@endphp


<div class="fixed-buttons">
    <a href="{!! $calculatorHeaderAnchorHref !!}" class="fixed-button fixed-button_calc fixed-buttons__button">Рассчитать</a>
    <a href="#" class="fixed-button fixed-button_track fixed-buttons__button">Отследить</a>
</div>

<div class="body-wrapper js-body_wrapper ">
    <div class="fullscreen-modal-background js-fade_background "></div>
    <header class="header-shadow">
        <div class="header header_menu_size_l">
            <div class="header__content">
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}" class="logo-cdek header__logo"></a>
                <div class="main-menu header__menu">
                    <ul class="main-menu__list">

                        {{-- Главная --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link current" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}">@d('menu_delivery')</a>
                        </li>
                        {{-- Интернет-Магазинам --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'e-commerce']) !!}">@d('menu_e_commerce')</a>
                        </li>
                        {{-- Документы --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'documents']) !!}">@d('menu_documents')</a>
                        </li>
                        {{-- Бизнесу --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'business']) !!}">@d('menu_business')</a>
                        </li>
                        {{-- Контакты --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
                        @if (isset($dictionary['menu_to_kazakhstan']))
                            @include('site.universal2.to_kazakhstan')
                        @endif
                    </ul>
                </div>
                <div class="header__right">
                    <a href="{{ $calculatorHeaderAnchorHref }}" class="header__button gtm-click"
                       data-click="{{ $calculatorHeaderAnchorGtm }}">@d('header_button')</a>
                    @foreach($site->languages as $languageItem)
                        @if($language->id != $languageItem->id)
                            <div><a class="header__language-selector" href="{!! route('site.show_page', ['languageUrl' => $languageItem->uri, 'pageUrl' => $page->url]) !!}">{{ \Str::upper($languageItem->shortname) }}</a></div>

                        @endif
                    @endforeach
                    <div class="header-contact">
                        <div class="header-contact__content">
                            <a class="header-contact__phone"
                               href="tel:@d('header_phone')">@d('header_phone_formatted')</a>
                        </div>
                    </div>
                </div>
                <div class="menu-mobile js-menu-open-button"></div>
            </div>
        </div>
        <div class="fullscreen-modal-background js-fade_background "></div>
        <div class="header-mobile-open-wrapper">
            <div class="header-mobile-open js-menu-container transition_slide-right ">
                <div class="header-mobile-open__close js-menu-close-button"></div>
                <div class="logo-cdek logo-cdek_size_s header-mobile-open__logo"></div>
                <div class="main-menu">
                    <ul class="main-menu__list">
                        <li class="main-menu__item">
                            <a class="main-menu__link current" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}">@d('menu_delivery')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'e-commerce']) !!}">@d('menu_e_commerce')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'documents']) !!}">@d('menu_documents')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'business']) !!}">@d('menu_business')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
                        @if (isset($dictionary['menu_to_kazakhstan']))
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'to-kazakhstan']) !!}">@d('menu_to_kazakhstan')</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="footer__content">
            <div class="footer__left">
                <a class="footer__footer-logo footer-logo" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}"></a>
                <div class="footer__link-social-item">
                    <a class="footer__link footer__link-mr-social {{ $dictionary['footer_facebook']?'':'hidden' }}" href="{!! $dictionary['footer_facebook'] !!}" target="_blank">Facebook</a>
                    <a class="footer__link footer__link-mr-social {{ $dictionary['footer_instagram']?'':'hidden' }}" href="{!! $dictionary['footer_instagram'] !!}" target="_blank">Instagram</a>
                    @if($dictionary['footer_ukraine_reglament'] != '-')
                        <a class="footer__link footer__link-mr-social" href="{!! $dictionary['footer_ukraine_reglament'] !!}">@d('footer_ukraine_reglament_text')</a>
                    @endif
                    @if($dictionary['footer_fulfilment'] != '-')
                        <a class="footer__link footer__link-mr-social" href="{!! $dictionary['footer_fulfilment'] !!}" target="_blank">@d('footer_fulfilment_text')</a>
                    @endif
                </div>

                <div class="footer__link-policy-item">
                    <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                    @if($dictionary['footer_has_privacy_policy_page'] != '-')
                        <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}">@d('footer_policy')</a>
                    @else
                        <a class="footer__link footer__link-mr-policy" target="_blank" href="/storage/Privacy_Policy.pdf">@d('footer_policy')</a>
                    @endif
                    @if($dictionary['footer_has_legal_page'] != '-')
                        <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'legal']) !!}">@d('footer_legal_info')</a>
                    @endif
                    @if($dictionary['footer_has_impressum'] != '-')
                        <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'impressum']) !!}">@d('footer_impressum_text')</a>
                    @endif
                </div>
            </div>
            <div class="footer__right">
                <div class="footer__right-img"></div>
                <div class="footer__right-text">
                    <div class="footer__contacts">
                        @if($site->localOffices->count() == 1)
                        @foreach($site->localOffices as $localOffice)
{{--                            <small>{{ $localOffice->localOfficetexts[0]->name }}</small>--}}
                            @foreach($localOffice->localOfficePhones as $localOfficePhone)
                            <div class="footer__phone-item">
                                <a class="footer__phone" href="tel:{{ $localOfficePhone->phone_value }}">{{ $localOfficePhone->phone_text }}</a>
                            </div>
                                @break(1)
                            @endforeach
                            @break(1)
                        @endforeach
                        @endif
                    </div>
                    @if($site->localOffices->count() == 1)
                        @foreach($site->localOffices as $localOffice)
                            @foreach($localOffice->localOfficeEmails as $localOfficeEmails)
                            <a class="footer__email footer-email" href="mailto:{!! $localOfficeEmails->email !!}">{!! $localOfficeEmails->email !!}</a>
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </footer>

    @include('site.universal2.feedback_block')

</div>
<script id="recaptcha_script" data-key="{{ config('app.recapcha3_key') }}" src="https://www.google.com/recaptcha/api.js?render={{ config('app.recapcha3_key') }}"></script>

<script src="{{ mix('universal2/new.js') }}" defer></script>
@include('site.universal2.binotel')
@include('site.universal2.jivosite')
@include('site.universal2.tawk_block')
@include('site.universal2.allow_cookies')
</body>
</html>
