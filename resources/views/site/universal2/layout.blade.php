<!DOCTYPE html>
<html @if($language->rtl) dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <title>@d('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="/universal2/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ mix('universal2/app.css') }}">
    <link rel="stylesheet" href="/request/images/theme.css">
    <link rel="stylesheet" href="{{ mix('universal2/custom.css') }}">
</head>
<body class="site-theme">
<div class="body-wrapper js-body_wrapper ">
    <div class="fullscreen-modal-background js-fade_background "></div>
    <header class="header-shadow">
        <div class="header">
            <div class="header__content">
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}" class="logo-cdek header__logo"></a>
                <div class="main-menu header__menu">
                    <ul class="main-menu__list">
                        <li class="main-menu__item">
                            <a class="main-menu__link current" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}">@d('menu_delivery')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'company']) !!}">@d('menu_company')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
                        @if (!empty($dictionary['menu_to_kazakhstan']))
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'to-kazakhstan']) !!}</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="header__right">
                    <a href="/#calculator" class="header__button">@d('header_button')</a>
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
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'company']) !!}">@d('menu_company')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
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
                    <a class="footer__link footer__link-mr-social {{ $dictionary['footer_facebook']?'':'hidden' }}" href="{!! $dictionary['footer_facebook'] !!}">Facebook</a>
                    <a class="footer__link footer__link-mr-social {{ $dictionary['footer_instagram']?'':'hidden' }}" href="{!! $dictionary['footer_instagram'] !!}">Instagram</a>
                </div>
                <div class="footer__link-policy-item">
                    <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                    <a class="footer__link footer__link-mr-policy" target="_blank" href="/storage/Privacy_Policy.pdf">@d('footer_policy')</a>
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

@php
    $yandexParameters = [
        'apikey' => 'a3a191e8-8704-4696-964a-1dac59b0730b',
        'lang' => $dictionary['contacts_yandex_lang'],
    ];
@endphp

<script src="https://api-maps.yandex.ru/2.1/?{!! http_build_query($yandexParameters) !!}"
        type="text/javascript">
</script>

<script src="{{ mix('universal2/new.js') }}" defer></script>
@include('site.universal2.binotel')
@include('site.universal2.jivosite')
</body>
</html>
