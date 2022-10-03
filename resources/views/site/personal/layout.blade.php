<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@d('personal_1')</title>

    <script>
        dataLayer = [];
    </script>

    @if($allowCookies)
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
            })(window, document, 'script', 'dataLayer', 'GTM-T5FMSQB');</script>
        <!-- End Google Tag Manager -->
    @endif


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap"
          rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <link href="/personal/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/personal/assets/css/app.css?cssv7">
    <link rel="stylesheet" href="{{ mix('personal/info.css') }}">
    <link rel="stylesheet" href="/universal2/custom.css?v=2">

</head>
<body class="site-theme">
<div class="body-wrapper js-body_wrapper office-page-wrapper ">
    <div class="fullscreen-modal-background js-fade_background "></div>
    <header class="header-shadow">
        <div class="header office-page-header">
            <div class="header__content">
                <a href="/" class="logo-cdek header__logo office-page-header__logo"></a>
                <div class="office-page-header__office">
                    <div>@d('personal_2')</div>
                    <div class="office-page-header__office-city">@d('personal_3')</div>
                </div>
                <div class="office-page-header__left">
                    @foreach($site->enabledLanguages as $languageItem)
                        @if($language->id != $languageItem->id)
                            <div><a class="header__language-selector"
                                    href="{!! route('site.show_page', ['languageUrl' => $languageItem->uri, 'pageUrl' => $page->url]) !!}">{{ \Str::upper($languageItem->shortname) }}</a>
                            </div>
                        @endif
                    @endforeach

                    <a href="{{ route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => '/']) . '#calculator' }}"
                       class="office-page-button office-page-header__button_fc office-page-button_type_calculate office-page-header__button gtm-click"
                       data-click="rassitat_header">@d('personal_5')</a>
                    <a href="{{ route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => '/']) . '#tracking' }}"
                       class="office-page-button office-page-button_type_search office-page-header__button gtm-click"
                       data-click="track_header">@d('personal_6')</a>
                </div>
                <div class="header__right">
                    <div class="header-contact">
                        <div class="header-contact__content office-page-header__phone">
                            <a class="header-contact__phone" href="tel:{{ $dictionary['personal_phone_value'] }}">@d('personal_7')</a>
                        </div>
                    </div>
                    <a href="{{ route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => '/']) . '#feedback' }}" class="office-page-header__contact">@d('personal_8')</a>
                </div>
                <div class="menu-mobile js-menu-open-button"></div>
            </div>
        </div>
        <div class="fullscreen-modal-background js-fade_background "></div>
        <div class="header-mobile-open-wrapper">
            <div class="header-mobile-open office-page-mobile-menu js-menu-container transition_slide-right ">
                <div class="header-mobile-open__close js-menu-close-button"></div>
                <div class="header__language-selector office-page-mobile-menu__lang">@d('personal_9')</div>
                <div class="office-page-mobile-menu__buttons">
                    <a href="#calculator"
                       class="office-page-button office-page-button_type_calculate office-page-mobile-menu__button">@d('personal_10')</a>
                    <a href="#tracking"
                       class="office-page-button office-page-button_type_search office-page-mobile-menu__button">@d('personal_11')</a>
                </div>
                <div class="office-page-mobile-menu__text">
                    @d('personal_12')<br/>
                    @d('personal_13')
                </div>
                <a href="#" class="office-page-mobile-menu__phone">@d('personal_14')</a>
                <div class="office-page-mobile-menu__email-container">
                    <a href="#" class="office-page-mobile-menu__email">@d('personal_15')</a>
                </div>
                <a href="#" class="office-page-mobile-menu__contact">@d('personal_16')</a>
            </div>
        </div>
    </header>


    @yield('content')


    <footer class="footer-new">
        <div class="footer-new__content">
            <div class="footer-new__left">
                <a class="footer-logo footer-new__logo" href="#"></a>
                <div>
                    <div class="footer-new__links">
                        <div class="footer-new__links-item">
                            <a href="{{ $dictionary['personal_facebook_link'] }}"
                               class="footer-new__link footer-new__link_bold">@d('personal_160')</a>
                        </div>
                        <div class="footer-new__links-item">
                            <a href="{{ $dictionary['personal_instagram_link'] }}"
                               class="footer-new__link footer-new__link_bold">@d('personal_161')</a>
                        </div>
                    </div>
                    <div class="footer-new__links footer-new__links_last">
                        <div class="footer-new__links-item">
                            @d('personal_162')
                        </div>
                        <div class="footer-new__links-item">
                            <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}" class="footer-new__link">@d('personal_163')</a>
                        </div>
                    </div>
                    <a href="https://cdek-express.com/" target="_blank" class="footer-new__link footer-new__link_bold">@d('personal_164')</a>
                </div>
            </div>
            <div class="footer-new__right">
                <div class="footer-new__text">
                    @d('personal_165')<br/>
                    @d('personal_166')<br/>
                    @d('personal_167')
                </div>
                <div>

                    @foreach($site->localOffices as $localOffice)
                        @foreach($localOffice->localOfficePhones as $localOfficePhone)
                            <div class="footer-new__phone">{{$localOfficePhone->phone_text}}</div>
                        @endforeach
                        @foreach($localOffice->localOfficeEmails as $localOfficeEmail)
                            <a href="mailto:{{ $localOfficeEmail->email }}"
                               class="footer-new__link footer-email">{{ $localOfficeEmail->email }}</a>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </footer>


    <div class="modal-container">
        <div class="modal" id="feedback-modal">
            <div class="modal__close"></div>
            <div class="modal__content">
                <div class="modal__heading">@d('personal_170')</div>
                <div class="form calculator_form">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="name" class="form-field__input" placeholder="Имя"/>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="phone" class="form-field__input" placeholder="Телефон"/>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="email" class="form-field__input" placeholder="E-mail"/>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <textarea name="message" class="form-field__input" placeholder="Текст вопроса"></textarea>
                        </div>
                    </div>
                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" id="modal-agree"/><label for="modal-agree"><span>@d('personal_171') <a
                                        class="checkbox-widget__link" href="#">@d('personal_172')</a></span></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="Отправить"
                               class="primary-button primary-button_wide primary-button_submit"/>
                    </div>
                </div>
            </div>
            <div class="modal__content modal__content_result js-modal-result-ok" style="display: none;">
                <div>
                    <div class="modal__result-icon modal__result-icon_ok"></div>
                    <div class="modal__result-title">@d('personal_173')<br/>@d('personal_174')</div>
                    <div class="modal__result-text">@d('personal_175')</div>
                </div>
            </div>
            <div class="modal__content modal__content_result js-modal-result-error" style="display: none;">
                <div>
                    <div class="modal__result-icon modal__result-icon_error"></div>
                    <div class="modal__result-title">@d('personal_176')</div>
                    <div class="modal__result-text">@d('personal_177')</div>
                </div>
            </div>
        </div>

        <div id="review-modal" class="review-modal">
            <div class="review-modal__close"></div>
            <div class="review-modal__title">@d('personal_182')</div>
            <div class="review-modal__text">
                @d('personal_183')
                @d('personal_183')
            </div>
        </div>


        <div id="presentation-modal" class="presentation-modal">
            <div class="presentation-modal__close"></div>
            <form method="post" action="{{ route('request.presentation') }}"
                  class="presentation-modal__form js-presentation-form">
                <div class="presentation-modal__bg"></div>
                <div class="presentation-modal__title">@d('personal_184')</div>
                <div class="form calculator_form">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="name" class="form-field__input"
                                   placeholder="{{ $dictionary['personal_presentation_form_name'] }}"/>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="phone" class="form-field__input"
                                   placeholder="{{ $dictionary['personal_presentation_form_phone'] }}"/>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="email" class="form-field__input"
                                   placeholder="{{ $dictionary['personal_presentation_form_email'] }}"/>
                        </div>
                    </div>
                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" value="1" id="modal-agree2" required/><label
                                for="modal-agree2"><span>@d('personal_185') <a class="checkbox-widget__link" href="#">@d('personal_186')</a></span></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="{{ $dictionary['personal_presentation_form_submit'] }}"
                               class="primary-button primary-button_wide primary-button_submit"/>
                    </div>
                </div>
            </form>
            <div class="presentation-modal__result js-modal-result-ok" style="display: none;">
                <div>
                    <div class="presentation-modal__result-icon presentation-modal__result-icon_ok"></div>
                    <div class="presentation-modal__result-title">@d('personal_187')</div>
                    <div class="presentation-modal__result-text">@d('personal_188')</div>
                    <a href="/request/images/presentation.pptx" class="presentation-modal__download"
                    >@d('personal_189')</a>
                </div>
            </div>
            <div class="presentation-modal__result js-modal-result-error" style="display: none;">
                <div>
                    <div class="presentation-modal__result-icon presentation-modal__result-icon_error"></div>
                    <div class="presentation-modal__result-title">@d('personal_190')</div>
                    <div class="presentation-modal__result-text">@d('personal_191')</div>
                </div>
            </div>
        </div>

        <div id="review-add-modal" class="review-add-modal">
            <div class="review-add-modal__close"></div>
            <div class="review-add-modal__content js-modal-result-hide">
                <div class="review-add-modal__title">@d('personal_review_header')</div>
                <form method="post" action="{!! route('request.feedback_review') !!}"
                      class="form calculator_form js-feedback-review-form"
                      data-feedback-review-submit-event="feedback_form">
                    <input type="hidden" name="language_id" value="{{ $language->id }}">
                    <div class="review-add-modal__two-fields">
                        <div class="form__row review-add-modal__two-fields-item">
                            <div class="form-field">
                                <input type="text" name="name" class="form-field__input js-feedback-review-name"
                                       placeholder="{{ $dictionary['personal_review_form_name'] }}"/>
                                <div class="form-field__error-message">@d('personal_review_form_required')</div>
                            </div>
                        </div>
                        <div class="form__row review-add-modal__two-fields-item">
                            <div class="form-field">
                                <input type="text" name="email" class="form-field__input js-feedback-review-email"
                                       placeholder="{{ $dictionary['personal_review_form_email'] }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <textarea name="text" class="form-field__input js-feedback-review-text"
                                      placeholder="{{ $dictionary['personal_review_form_text'] }}"></textarea>
                        </div>
                    </div>
                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" id="modal-agree_review"
                                   class="js-feedback-review-checkbox"/><label for="modal-agree_review"><span>@d('personal_review_form_agree')<a
                                        class="checkbox-widget__link"
                                        href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}">@d('personal_review_form_agree_2')</a></span></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="{{ $dictionary['personal_review_form_submit'] }}"
                               class="primary-button primary-button_wide primary-button_submit"/>
                        <div class="calculator__description" style="margin-top: 25px;">
                            This site is protected by reCAPTCHA and the Google<br>
                            <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                            <a href="https://policies.google.com/terms">Terms of Service</a> apply.
                        </div>
                    </div>
                </form>
            </div>
            <div class="review-add-modal__result js-modal-result-ok" style="display: none;">
                <div>
                    <div class="review-add-modal__result-icon review-add-modal__result-icon_ok"></div>
                    <div class="review-add-modal__result-title">@d('personal_review_form_success_header')</div>
                    <div class="review-add-modal__result-text">@d('personal_review_form_success_text')
                    </div>
                </div>
            </div>
            <div class="review-add-modal__result js-modal-result-error" style="display: none;">
                <div>
                    <div class="review-add-modal__result-icon review-add-modal__result-icon_error"></div>
                    <div class="review-add-modal__result-title">@d('personal_review_form_error_header')</div>
                    <div class="review-add-modal__result-text">@d('personal_review_form_error_text')
                    </div>
                </div>
            </div>
        </div>

    </div>


    @include('site.universal2.allow_cookies')
</div>

<script id="recaptcha_script" data-key="{{ config('app.recapcha3_key') }}"
        src="https://www.google.com/recaptcha/api.js?render={{ config('app.recapcha3_key') }}" async defer></script>
<script src="{{ mix('personal/new.js') }}" defer></script>
</body>
</html>



