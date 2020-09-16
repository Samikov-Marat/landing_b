<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вебинар Великобритания</title>

@verbatim
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TBCPRBN');</script>
    <!-- End Google Tag Manager -->
@endverbatim


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,500,700&display=swap" rel="stylesheet">

    <link href="/new_design/assets/css_libs/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
    <link href="/new_design/assets/css/app.css?20200911_03" rel="stylesheet" type="text/css"/>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBCPRBN"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="body-wrapper js-body_wrapper ">
    <div class="fullscreen-modal-background js-fade_background "></div>
    <header class="header-shadow">
        <div class="content-width">
            <div class="header-container">
                <div class="logo-uk header-container__logo  logo-uk-{{ \Str::lower($language->shortname) }}"></div>
                <div class="menu-container header-container__menu">
                    <ul class="menu-container__item-ul">
                        <li class="menu-container__item-li">
                            <a class="menu-container__item current" href="#sale">
                                @d('webinar_menu_how_buy')
                            </a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#program">@d('webinar_menu_program')</a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#whoweare">@d('webinar_menu_who_we_are')</a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#join">@d('webinar_menu_join')</a>
                        </li>
                    </ul>
                </div>
                <a href="#register" class="header-container__button">@d('webinar_menu_register')</a>
                <div class="header-container__language-selector" style="position: relative"><span
                        class="js-open-language-list">{{ \Str::upper($language->shortname) }}</span>

                    <div class="header-container__language-list" style="display: none;">
                        @foreach ($site->languages as $availableLanguage)
                            @if($availableLanguage->id != $language->id)
                                <div class="header-container__language-item"><a
                                        href="/{{ \Str::lower($availableLanguage->shortname) }}/webinar">{{ \Str::upper($availableLanguage->shortname) }}</a>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="webinar-phone-container header-container__webinar-phone-container">
                    <div class="webinar-phone-container__phone-block">
                        <a class="webinar-phone-container__phone" href="tel:@d('webinar_menu_phone_value')">@d('webinar_menu_phone_formatted')</a>
                        <div class="webinar-phone-container__name">@d('webinar_menu_ipswich')</div>
                    </div>
                </div>
                <div class="menu-mobile js-menu-open-button"></div>
            </div>
        </div>
        <div class="fullscreen-modal-background js-fade_background "></div>
        <div class="header-container-mobile-open-wrapper">
            <div class="header-container-mobile-open js-webinar-menu-container transition_slide-right ">
                <div class="header-container-mobile-open__close js-menu-close-button"></div>
                <div
                    class="logo-uk header-container-mobile-open__logo logo-uk-{{ \Str::lower($language->shortname) }}"></div>
                <div class="menu-container header-container-mobile-open__menu-container">
                    <ul class="menu-container__item-ul">
                        <li class="menu-container__item-li">
                            <a class="menu-container__item current" href="#sale">
                                @d('webinar_menu_how_buy')
                            </a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#program">@d('webinar_menu_program')</a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#whoweare">@d('webinar_menu_who_we_are')</a>
                        </li>
                        <li class="menu-container__item-li">
                            <a class="menu-container__item" href="#join">@d('webinar_menu_join')</a>
                        </li>
                    </ul>
                    <a href="#register" class="header-container-mobile-open__button">@d('webinar_menu_register')</a>
                </div>
            </div>
        </div>
    </header>
    <div class="webinar-page">
        <div class="poster-container">
            <div class="content-width poster-container__content">
                <div class="poster-container__text-block">
                    <div class="poster-container__webinar-experts-text">@d('webinar_increase_expert')</div>
                    <div class="poster-container__heading-wrapper">
                        <div class="poster-container__heading-img"></div>
                        <h1 class="webinar-page__heading1 poster-container__heading1">
                            @d('webinar_increase_how')
                        </h1>
                    </div>
                    <div class="poster-container__line"></div>
                    <div class="poster-container__sales-geography-text">
                        @d('webinar_increase_geo')
                    </div>
                    <div class="webinar-zoom-container poster-container__webinar-zoom-container">
                        <div class="webinar-zoom-container__text-block">
                            <div class="webinar-zoom-container__system-text">@d('webinar_increase_zoom')</div>
                            <div class="webinar-zoom-container__date">@d('webinar_increase_date')</div>
                        </div>
                        <a href="#register" class="webinar-zoom-container__button">@d('webinar_increase_register')</a>
                    </div>
                </div>
                <div class="poster-container__pack-poster"></div>
            </div>
        </div>
        <div class="webinar-screen-advantages">
            <div class="content-width">
                <div class="webinar-benefits-container">
                    <div
                        class="background-dots background-dots_color_green webinar-benefits-container__background-dots-left"></div>
                    <div
                        class="background-dots background-dots_color_black webinar-benefits-container__background-dots-right"></div>
                    <h2 class="webinar-benefits-container__heading2 webinar-page__heading2">
                        @d('webinar_useful_for')
                    </h2>
                    <div class="webinar-benefits-container__text">
                        @d('webinar_useful_shops')
                    </div>
                    <div class="webinar-benefits-container__advantages-content">
                        <div class="webinar-benefits-container__advantages-block">
                            <div class="webinar-benefits-container__advantages-block-img">1</div>
                            <div class="webinar-benefits-container__advantages-block-text">
                                @d('webinar_useful_shops_item_1')
                            </div>
                        </div>
                        <div class="webinar-benefits-container__advantages-block">
                            <div class="webinar-benefits-container__advantages-block-img">2</div>
                            <div class="webinar-benefits-container__advantages-block-text">
                                @d('webinar_useful_shops_item_2')
                            </div>
                        </div>
                        <div class="webinar-benefits-container__advantages-block">
                            <div class="webinar-benefits-container__advantages-block-img">3</div>
                            <div class="webinar-benefits-container__advantages-block-text">
                                @d('webinar_useful_shops_item_3')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="interesting-market-container" id="sale">
                    <h2 class="interesting-market-container__heading2 webinar-page__heading2">
                        @d('webinar_useful_why')
                    </h2>
                    <div class="interesting-market-container__content">
                        <div class="interesting-market-container__block">
                            <div
                                class="interesting-market-container__block-img interesting-market-container__cart"></div>
                            <div class="interesting-market-container__text">
                                @d('webinar_useful_why_item_1_1')<br>
                                @d('webinar_useful_why_item_1_2')
                            </div>
                        </div>
                        <div class="interesting-market-container__block">
                            <div
                                class="interesting-market-container__block-img interesting-market-container__growth"></div>
                            <div class="interesting-market-container__text">
                                @d('webinar_useful_why_item_2_2')<br>
                                @d('webinar_useful_why_item_2_3')
                            </div>
                        </div>
                        <div class="interesting-market-container__block">
                            <div
                                class="interesting-market-container__block-img interesting-market-container__asos"></div>
                            <div class="interesting-market-container__text">
                                @d('webinar_useful_why_item_3')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="company-turnover-container">
            <div class="content-width">
                <div class="company-turnover-container__text-content">
                    <h2 class="company-turnover-container__heading2">@d('webinar_megavalue_value')</h2>
                    <div class="company-turnover-container__line"></div>
                    <div class="company-turnover-container__text">
                        @d('webinar_megavalue_description')
                    </div>
                    <div class="company-turnover-container__white-circle"></div>
                </div>
            </div>
        </div>
        <div class="e-commerce-container" id="program">
            <div class="content-width">
                <h2 class="e-commerce-container__heading2 webinar-page__heading2">
                    @d('webinar_six_advantages')
                </h2>
                <div class="e-commerce-container__items-container">
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">@d('webinar_six_advantages_item_1')</div>
                        <div class="e-commerce-container__item-number">1</div>
                    </div>
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">
                            @d('webinar_six_advantages_item_2')
                        </div>
                        <div class="e-commerce-container__item-number">2</div>
                    </div>
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">@d('webinar_six_advantages_item_3')</div>
                        <div class="e-commerce-container__item-number">3</div>
                    </div>
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">@d('webinar_six_advantages_item_4')</div>
                        <div class="e-commerce-container__item-number">4</div>
                    </div>
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">@d('webinar_six_advantages_item_5')</div>
                        <div class="e-commerce-container__item-number">5</div>
                    </div>
                    <div class="e-commerce-container__item">
                        <div class="e-commerce-container__item-text">
                            @d('webinar_six_advantages_item_6')
                        </div>
                        <div class="e-commerce-container__item-number">6</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="who-are-we-container" id="whoweare">
            <div class="content-width">
                <h2 class="who-are-we-container__heading2">@d('webinar_who_caption')</h2>
                <div class="who-are-we-container__text">
                    @d('webinar_who_expert')
                </div>
                <div class="who-are-we-container__circle-content js-who-are-we-slider owl-carousel">
                    <div class="who-are-we-container__circle-block">
                        <div class="who-are-we-container__circle-cdek who-are-we-container__circle"></div>
                        <div class="who-are-we-container__circle-number">@d('webinar_who_item_1_caption')</div>
                        <div class="who-are-we-container__circle-text">
                            @d('webinar_who_item_1_text')
                        </div>
                    </div>
                    <div class="who-are-we-container__circle-block">
                        <div class="who-are-we-container__circle-car who-are-we-container__circle"></div>
                        <div class="who-are-we-container__circle-number">@d('webinar_who_item_2_caption')</div>
                        <div class="who-are-we-container__circle-text">
                            @d('webinar_who_item_2_text')
                        </div>
                    </div>
                    <div class="who-are-we-container__circle-block">
                        <div class="who-are-we-container__circle-location who-are-we-container__circle"></div>
                        <div class="who-are-we-container__circle-number">@d('webinar_who_item_3_caption')</div>
                        <div class="who-are-we-container__circle-text">
                            @d('webinar_who_item_3_text')
                        </div>
                    </div>
                    <div class="who-are-we-container__circle-block">
                        <div class="who-are-we-container__circle-package who-are-we-container__circle"></div>
                        <div class="who-are-we-container__circle-number">@d('webinar_who_item_4_caption')</div>
                        <div class="who-are-we-container__circle-text">
                            @d('webinar_who_item_4_text')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="webinar-screen-participation" id="join">
            <div class="content-width">
                <div class="free-webinar-container">
                    <div
                        class="background-dots background-dots_color_black free-webinar-container__background-dots"></div>
                    <h2 class="webinar-screen-participation__heading2 webinar-page__heading2">
                        @d('webinar_join_how')
                    </h2>
                    <div class="free-webinar-container__content">
                        <div class="free-webinar-container__block free-webinar-container__step1">
                            <div class="free-webinar-container__text-block">
                                <div class="free-webinar-container__number">1.</div>
                                <div class="free-webinar-container__text">
                                    @d('webinar_join_item_1')
                                </div>
                            </div>
                        </div>
                        <div class="free-webinar-container__block free-webinar-container__step2">
                            <div class="free-webinar-container__text-block">
                                <div class="free-webinar-container__number">2.</div>
                                <div class="free-webinar-container__text">
                                    @d('webinar_join_item_2')
                                </div>
                            </div>
                        </div>
                        <div class="free-webinar-container__block free-webinar-container__step3">
                            <div class="free-webinar-container__text-block">
                                <div class="free-webinar-container__number">3.</div>
                                <div class="free-webinar-container__text">
                                    @d('webinar_join_item_3')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gift-webinar-participants free-webinar-container__gift-webinar-participants">
                        <div class="gift-webinar-participants__square">@d('webinar_join_all')</div>
                        <div class="gift-webinar-participants__text">@d('webinar_join_manual')</div>
                        <div class="gift-webinar-participants__title">
                            &laquo;@d('webinar_join_manual_name')&raquo;
                        </div>
                    </div>
                </div>
                <div class="application-participation-container" id="register">
                    <div
                        class="background-dots background-dots_color_green application-participation-container__background-dots"></div>
                    <div class="application-form">
                        <form method="post" action="/send-webinar-request" class="js-form" autocomplete="off">
                            <input type="hidden" name="url" value="{{ $pageUrl }}">
                            <div>
                                <div class="application-form__title">@d('webinar_form_caption')</div>
                                <div class="application-form__description">
                                    <div class="form-field application-form__field">
                                        <input type="text" name="Name" placeholder="@d('webinar_form_field_name')"
                                               autocomplete="off" class="form-field__input js-required">
                                        <div class="form-field__error-message">@d('webinar_form_required')</div>
                                    </div>
                                    <div class="form-field application-form__field">
                                        <input type="text" name="Phone" placeholder="@d('webinar_form_field_phone')"
                                               autocomplete="off" class="form-field__input js-required">
                                        <div class="form-field__error-message">@d('webinar_form_required')</div>
                                    </div>
                                    <div class="form-field application-form__field">
                                        <input type="text" name="Email" placeholder="@d('webinar_form_field_email')"
                                               autocomplete="off" class="form-field__input js-required">
                                        <div class="form-field__error-message">@d('webinar_form_required')</div>
                                    </div>
                                    <div class="form-field application-form__field">
                                        <input type="text" name="Company" placeholder="@d('webinar_form_field_company')"
                                               autocomplete="off" class="form-field__input js-required">
                                        <div class="form-field__error-message">@d('webinar_form_required')</div>
                                    </div>
                                    <div class="application-form__fields-row">
                                        <div class="form-field application-form__field-small">
                                            <input type="text" name="City" placeholder="@d('webinar_form_field_town')"
                                                   class="form-field__input js-required">
                                            <div class="form-field__error-message">@d('webinar_form_required')</div>
                                        </div>
                                        <div class="form-field application-form__field-small">
                                            <input type="text" name="Scope"
                                                   placeholder="@d('webinar_form_field_sphere')" autocomplete="off"
                                                   class="form-field__input js-required">
                                            <div class="form-field__error-message">@d('webinar_form_required')</div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="application-form__button">@d('webinar_form_register')
                                </button>
                                <div class="application-form__text-block">
                                    <p class="application-form__text">@d('webinar_form_agree')</p>
                                    <p class="application-form__text">@d('webinar_form_no_spam')</p>
                                </div>
                            </div>
                        </form>

                        <div class="preloader js-preloader" style="display: none;">
                            <img src="/webinar/img/preloader.gif">
                        </div>
                        <div class="application-form__result-wrapper js-form-result" style="display: none;">
                            <div class="form-result form-result_result_success" style="display: none;">
                                <div class="form-result__img"></div>
                                <div class="form-result__title">@d('webinar_form_response_ok_text_1')</div>
                                <div class="form-result__text">@d('webinar_form_response_ok_text_2')<br>
                                    @d('webinar_form_response_ok_text_3')
                                </div>
                            </div>
                            <div class="form-result form-result_result_error" style="display: none;">
                                <div class="form-result__img"></div>
                                <div class="form-result__title">@d('webinar_form_response_error_text_1')</div>
                                <div class="form-result__text">@d('webinar_form_response_error_text_2')<br>
                                    @d('webinar_form_response_error_text_3')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="our-clients-container">
            <div class="content-width">
                <h2 class="our-clients-container__heading2 webinar-page__heading2">
                    @d('webinar_footer_clients')
                </h2>
                <div class="our-clients-blocks">
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i1"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i2"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i3"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i4"></div>

                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i6"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i7"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i8"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i9"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i10"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i11"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i12"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i13"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i14"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i15"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i16"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i17"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i18"></div>
                    <div class="our-clients-blocks__block our-clients-blocks__our-img-i19"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-container">
        <div class="content-width">
            <div class="footer-container__content">
                <div class="footer-container__left">
                    <a class="footer-container__footer-logo footer-logo footer-logo-{{ \Str::lower($language->shortname) }}"
                       href=""></a>
                    <div class="footer-container__link-block-social">
                        <a href="@d('webinar_footer_facebook_href')"
                           target="_blank" class="footer-container__link footer-container__link-mr-social">
                            @d('webinar_footer_facebook')
                        </a>
                        <a href="@d('webinar_footer_instagram_href')"
                           target="_blank" class="footer-container__link footer-container__link-mr-social">
                            @d('webinar_footer_instagram')
                        </a>
                    </div>
                    <div class="footer-container__link-block-policy">
                        <a class="footer-container__link footer-container__link-mr-policy" href="https://cdek.ru"
                           target="_blank">
                            @d('webinar_footer_cdek'), © {{ '2000-' . date('Y') }}
                        </a>
                        <a href="@d('webinar_footer_policy_href')" target="_blank"
                           class="footer-container__link footer-container__link-mr-policy">
                            @d('webinar_footer_policy')
                        </a>
                    </div>
                </div>
                <div class="footer-container__right">
                    <div class="footer-container__right-img"></div>
                    <div class="footer-container__right-text-block">
                        <div class="footer-container__contacts">
                            <div class="footer-container__phone-block">
                                <a class="footer-container__phone" href="tel:@d('webinar_footer_phone_value')">@d('webinar_footer_phone_formatted')</a>
                                <div class="footer-container__name">@d('webinar_footer_ipswich')</div>
                            </div>
                        </div>
                        <a class="footer-container__email footer-email" href="mailto:@d('webinar_footer_email')">@d('webinar_footer_email')</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="/new_design/assets/js_libs/owl.carousel.min.js"></script>
<script src="/new_design/assets/js/app.js?20200910_01"></script>
</body>
</html>
