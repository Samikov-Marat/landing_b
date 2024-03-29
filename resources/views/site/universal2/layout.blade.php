<!DOCTYPE html>

@php
    if($language->rtl) {
        $dir='rtl';
    }
    else{
        $dir='ltr';
    }

@endphp

<html dir="{{ $dir }}" lang="{{ $language->language_code_iso }}">

<head>
    <meta charset="UTF-8">
    <title>{{ !empty($dictionary['seo_title']) ? $dictionary['seo_title'] : 'CDEK' }}</title>

    @php
    if(isset($dictionary['seo_description']) && !empty($dictionary['seo_description'])){
        $description =$dictionary['seo_description'];
    }
    elseif(isset($dictionary['seo_description_default']) && !empty($dictionary['seo_description_default'])){
        $description =$dictionary['seo_description_default'];
    }
    else{
        $description = 'CDEK express delivery company';
    }
    @endphp
    <meta name="description" content="{{ $description }}">
    <script>
        dataLayer = [];
    </script>

    @if($allowCookies)
        @include('site.universal2.gtm_block')
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <meta property="og:image" content="/request/images/index/poster-mobile-2x.jpg">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="664">

    @foreach($site->metaTags as $tag)
        <{{ $tag->name }} @foreach($tag->metaTagAttributes as $attribute) {{$attribute->name}}="{{ $attribute->value }}" @endforeach>
    @endforeach

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="/universal2/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css"/>

    <link href="/universal2/select2/css/select2.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ mix('universal2/app.css') }}">
    <link rel="stylesheet" href="{{ mix('universal2/info.css') }}">

    @if($uploadedCssIndexed->has('/theme.css'))
        <link rel="stylesheet" href="{!! route('request.images', ['imageUrl' => 'theme.css', 'hash' => $uploadedCssIndexed->get('/theme.css')->hash ]) !!}">
    @endif
    @if($uploadedCssIndexed->has('/' . $language->uri . '.css'))
        <link rel="stylesheet" href="{!! route('request.images', ['imageUrl' => $language->uri . '.css', 'hash' => $uploadedCssIndexed->get('/'.$language->uri.'.css')->hash ]) !!}">
    @endif
    <link rel="stylesheet" href="{{ mix('universal2/custom.css') }}">

    @include('site.universal2.head_tags', ['tags' => $headTags['canonical'] ?? []])
    @include('site.universal2.head_tags', ['tags' => $headTags['alternate'] ?? []])
    @include('site.universal2.head_tags', ['tags' => $headTags['meta'] ?? []])
    <link rel="canonical" href="{!! url()->current() !!}"/>
</head>
<body class="site-theme">

@if($allowCookies)
    @include('site.universal2.gtm_block_noscript')
@endif
@php

    $templateHref = [
        'universal2.index' => '#calculator',
        'universal2.e_commerce' => '#calculator',
        'universal2.business' => '#calculator',
        ];
    $calculatorHeaderAnchorHref = $templateHref[$page->template] ?? (route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => '/']) . '#calculator');

    $trackinghref = route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => '/']) . '#tracking';


    $templateGtm = [
        'universal2.index' => 'rassitat_header',
        'universal2.e_commerce' => 'rassitat_header_im',
        'universal2.business' => 'rassitat_header_b2b',
        ];
    $calculatorHeaderAnchorGtm = $templateGtm[$page->template] ?? '';
@endphp

<div class="body-wrapper js-body_wrapper ">
    @if(isset($dictionary['antifraud_phone_1_value']))
        @include('site.universal2.antifraud_block')
    @endif

    @if($showFastAnswer && isset($dictionary['fast_answer_content']))
        @include('site.universal2.fast_answer')
    @endif

    @if($dictionary['yellow_alert'])
        @include('site.universal2.yellow_alert')
    @endif

    <div class="fullscreen-modal-background js-fade_background "></div>
    <header class="header-shadow">
        <div class="header header_menu_size_l">
            <div class="header__content">
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}" class="logo-cdek header__logo"></a>
                <div class="main-menu header__menu">
                    <ul class="main-menu__list">

                        @if (!empty($dictionary['menu_delivery']))
                            {{-- Главная --}}
                            <li class="main-menu__item">
                                <a class="main-menu__link current" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}">@d('menu_delivery')</a>
                            </li>
                        @endif
                        @if (!empty($dictionary['menu_ff']))
                            {{-- Фулфилмент --}}
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! $dictionary['menu_ff_link'] !!}" target="_blank">@d('menu_ff')</a>
                            </li>
                        @endif

                        {{-- Интернет-Магазинам --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'e-commerce']) !!}">@d('menu_e_commerce')</a>
                        </li>

                        @if (!empty($dictionary['menu_documents']))
                        {{-- Документы --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'documents']) !!}">@d('menu_documents')</a>
                        </li>
                        @endif

                        @if (!empty($dictionary['menu_business']))
                        {{-- Бизнесу --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'business']) !!}">@d('menu_business')</a>
                        </li>
                        @endif
                        @if (isset($dictionary['menu_to_kazakhstan']))
                            {{-- Доставка в Казахстан (из Германии) --}}
                            @include('site.universal2.to_kazakhstan')
                        @endif
                        @if (!empty($dictionary['menu_franchise']))
                            {{-- Страница франшизы --}}
                            <li class="main-menu__item">
                                    @include('site.universal2.menu_item_franchise')
                            </li>
                        @endif
                        @if (!empty($dictionary['menu_forward']))
                            {{-- Страница выкупа --}}
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! $dictionary['menu_forward_link'] !!}" target="_blank">@d('menu_forward')</a>
                            </li>
                        @endif
                        {{-- Контакты --}}
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
                    </ul>
                </div>
                <div class="header__right">
                    <a href="{{ $calculatorHeaderAnchorHref }}" class="header__button gtm-click"
                       data-click="{{ $calculatorHeaderAnchorGtm }}">@d('header_button')</a>
                    @foreach($site->enabledLanguages as $languageItem)
                        @if($language->id != $languageItem->id)
                            <div><a class="header__language-selector" href="{!! route('site.show_page', ['languageUrl' => $languageItem->uri, 'pageUrl' => $page->url]) !!}">{{ \Str::upper($languageItem->shortname) }}</a></div>
                        @endif
                    @endforeach
                    <div class="header-contact">
                        <div class="header-contact__content">
                            @if($dictionary['tg_bot'])
                                <a href="{!! $dictionary['tg_bot'] !!}" target="_blank" class="header-contact__phone">
                                    <img src="/universal2/img/tg.webp" width="45" height="45">
                                </a>
                            @elseif(isset($subdomain) && $subdomain->hasSubdomain())
                                @if(($site->localOffices->count() > 0)&&($site->localOffices->first()->localOfficePhones->count() > 0))
                                <a class="header-contact__phone"
                                   href="tel:{{ $site->localOffices->first()->localOfficePhones[0]->phone_value }}">{{ $site->localOffices->first()->localOfficePhones[0]->phone_text }}</a>
                                @endif
                            @elseif($dictionary['header_phone'])
                            <a class="header-contact__phone"
                               href="tel:{{ $dictionary['header_phone'] }}">@d('header_phone_formatted')</a>
                            @endif
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
                        @if (!empty($dictionary['menu_delivery']))
                            <li class="main-menu__item">
                                <a class="main-menu__link current" href="{!! route('site.show_page', ['languageUrl' => $language->uri]) !!}">@d('menu_delivery')</a>
                            </li>
                        @endif
                        @if (!empty($dictionary['menu_ff']))
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! $dictionary['menu_ff_link'] !!}" target="_blank">@d('menu_ff')</a>
                            </li>
                        @endif
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'e-commerce']) !!}">@d('menu_e_commerce')</a>
                        </li>
                        @if (!empty($dictionary['menu_documents']))
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'documents']) !!}">@d('menu_documents')</a>
                            </li>
                        @endif
                        @if (!empty($dictionary['menu_business']))
                            {{-- Бизнесу --}}
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'business']) !!}">@d('menu_business')</a>
                            </li>
                        @endif
                        @if (isset($dictionary['menu_to_kazakhstan']))
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'to-kazakhstan']) !!}">@d('menu_to_kazakhstan')</a>
                            </li>
                        @endif
                        @if (!empty($dictionary['menu_franchise']))
                            <li class="main-menu__item">
                                @include('site.universal2.menu_item_franchise')
                            </li>
                        @endif

                        @if (!empty($dictionary['menu_forward']))
                            {{-- Страница выкупа --}}
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! $dictionary['menu_forward_link'] !!}" target="_blank">@d('menu_forward')</a>
                            </li>
                        @endif

                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! $calculatorHeaderAnchorHref !!}">@d('header_fixbutton_calculator')</a>
                        </li>
                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! $trackinghref !!}">@d('header_fixbutton_tracking')</a>
                        </li>
                        @if('' != $dictionary['header_fixbutton_support'])
                            <li class="main-menu__item">
                                <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'support']) !!}">@d('header_fixbutton_support')</a>
                            </li>
                        @endif


                        <li class="main-menu__item">
                            <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>



    <div class="container">
        <div class="fixed-buttons_container">
            <div class="fixed-buttons @if($language->rtl) fixed-buttons_rightside @endif">
                <a href="{!! $calculatorHeaderAnchorHref !!}" class="fixed-button fixed-button_calc fixed-buttons__button">@d('header_fixbutton_calculator')</a>
                <a href="{!! $trackinghref !!}" class="fixed-button fixed-button_track fixed-buttons__button">@d('header_fixbutton_tracking')</a>
                @if('' != $dictionary['header_fixbutton_support'])
                    <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'support']) !!}" class="fixed-button fixed-button_support fixed-buttons__button">@d('header_fixbutton_support')</a>
                @endif
            </div>
        </div>
        <div class="page-content">
            @include('site.universal2.alert_personal_information')
            @yield('content')
        </div>
    </div>

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
                    @if($dictionary['footer_sanctions'] != '-')
                        <a class="footer__link footer__link-mr-social" href="{!! $dictionary['footer_sanctions'] !!}" target="_blank">@d('footer_sanctions_text')</a>
                    @endif
                </div>

                <div class="footer__link-policy-item">
                    <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
                    <a class="footer__link footer__link-mr-policy" target="_blank" href="{!! privacy_policy($dictionary, $language) !!}">@d('footer_policy')</a>
                    @if($dictionary['footer_has_legal_page'] != '-')
                        <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'legal']) !!}">@d('footer_legal_info')</a>
                    @endif
                    @if($dictionary['footer_has_impressum'] != '-')
                        <a class="footer__link footer__link-mr-policy" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'impressum']) !!}">@d('footer_impressum_text')</a>
                    @endif
                    @if(isset($dictionary['contractdocs_button_title']))
                        <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contractdocs']) !!}"
                           class="footer__link footer__link-mr-policy"
                           target="_blank">
                            {{ $dictionary['contractdocs_button_title'] }}
                        </a>
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

                    @if($dictionary['footer_email'])
                        <br>
                        @d('footer_support_text')
                        <a class="footer__email footer-email" style="background:none; padding-left:1em;" href="tel:{{ $dictionary['footer_support_phone'] }}">@d('footer_support_phone')</a>
                        <br>
                        <a class="footer__email footer-email" href="mailto:{{ $dictionary['footer_email'] }}">@d('footer_email')</a>
                    @endif

                    @if($dictionary['turkey_support'])
                        <br>
                        @d('turkey_support')<br>
                        @d('turkey_support_time')<br>
                        <a class="footer__email footer-email" style="background:none; padding-left:1em;" href="tel:{{ $dictionary['turkey_support_phone'] }}">@d('turkey_support_phone')</a>
                    @endif

                    @if($site->localOffices->count() > 1)
                        @include('site.universal2.layout.contacts_footer_component')
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
@include('site.universal2.tiktok')
@include('site.universal2.meta_counter')
@include('site.universal2.amo_button')
</body>
</html>
