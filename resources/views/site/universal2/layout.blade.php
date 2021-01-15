<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@d('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
            <link href="/universal2/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/universal2/assets/css/app.css?v=22">

    </head>
    <body>
    <div class="body-wrapper js-body_wrapper ">
        <div class="fullscreen-modal-background js-fade_background "></div>
        <header class="header-shadow">
            <div class="header">
    <div class="header__content">
        <a href="/" class="logo-cdek header__logo"></a>
        <div class="main-menu header__menu">
            <ul class="main-menu__list">
                <li class="main-menu__item">
                    <a class="main-menu__link current" href="/{{ $language->uri }}">@d('menu_delivery')</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="/{{ $language->uri }}/company">@d('menu_company')</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="/{{ $language->uri }}/contacts">@d('menu_contects')</a>
                </li>
            </ul>
        </div>
        <div class="header__right">
            <a href="" class="header__button">@d('header_button')</a>
            <div class="header__language-selector">RU</div>
            <div class="header-contact">
                <div class="header-contact__content">
                    <a class="header-contact__phone" href="tel:@d('header_phone')">@d('header_phone_formatted')</a>
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
                    <a class="main-menu__link current" href="">@d('menu_delivery')</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">@d('menu_company')</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">@d('menu_contects')</a>
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
                    <a class="footer__footer-logo footer-logo" href=""></a>
                    <div class="footer__link-social-item">
                        <a class="footer__link footer__link-mr-social" href="">Facebook</a>
                        <a class="footer__link footer__link-mr-social" href="">Instagram</a>
                    </div>
                    <div class="footer__link-policy-item">
                        <a class="footer__link footer__link-mr-policy" href="">@d('menu_contects')</a>
                        <a class="footer__link footer__link-mr-policy" href="">@d('footer_policy')</a>
                    </div>
                </div>
                <div class="footer__right">
                    <div class="footer__right-img"></div>
                    <div class="footer__right-text">
                        <div class="footer__contacts">
                            <div class="footer__phone-item">
                                <a class="footer__phone" href="tel:@d('header_phone')">@d('header_phone')</a>
                            </div>
                        </div>
                        <a class="footer__email footer-email" href="mailto:@d('footer_email')">@d('footer_email')</a>
                    </div>
                </div>
            </div>
        </footer>
        <div class="modal-container">
            <div class="modal" id="feedback-modal">
                <div class="modal__close"></div>
                <div class="modal__content">
                    <div class="modal__heading">@d('footer_feedback')</div>
                    <div class="form calculator_form">
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="name" class="form-field__input" placeholder="Имя" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="phone" class="form-field__input" placeholder="Телефон" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <input type="text" name="email" class="form-field__input" placeholder="E-mail" />
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form-field">
                                <textarea name="message" class="form-field__input" placeholder="Текст вопроса"></textarea>
                            </div>
                        </div>
                        <div class="form__row form__row_no-input">
                            <div class="checkbox-widget">
                                <input type="checkbox" name="agree" id="modal-agree" /><label for="modal-agree"><span>@d('footer_feedback_agree_1') <a class="checkbox-widget__link" href="#">@d('footer_feedback_agree_2')</a></span></label>
                            </div>
                        </div>
                        <div class="form-field">
                            <input type="submit" value="Отправить" class="primary-button primary-button_wide primary-button_submit" />
                        </div>
                    </div>
                </div>
                <div class="modal__content modal__content_result js-modal-result-ok" style="display: none;">
                    <div>
                        <div class="modal__result-icon modal__result-icon_ok"></div>
                        <div class="modal__result-title">@d('footer_feedback_success_1')</div>
                        <div class="modal__result-text">@d('footer_feedback_success_2')</div>
                    </div>
                </div>
                <div class="modal__content modal__content_result js-modal-result-error" style="display: none;">
                    <div>
                        <div class="modal__result-icon modal__result-icon_error"></div>
                        <div class="modal__result-title">@d('footer_feedback_error_1')</div>
                        <div class="modal__result-text">@d('footer_feedback_error_2')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="/universal2/assets/vendor/jquery.min.js"></script>
        <script src="/universal2/assets/vendor/owl.carousel.min.js"></script>
        <script src="/universal2/assets/vendor/jquery.autocomplete.js"></script>
        <script src="/universal2/assets/js/app.js?v=24"></script>

    </body>
</html>
