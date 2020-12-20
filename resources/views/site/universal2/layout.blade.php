<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CDEK UK</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
            <link href="/universal2/assets/vendor/owl.carousel.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/universal2/assets/css/app.css?i20">

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
                    <a class="main-menu__link current" href="">О доставке</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">Компания</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">Контакты</a>
                </li>
            </ul>
        </div>
        <div class="header__right">
            <a href="" class="header__button">Рассчитать доставку</a>
            <div class="header__language-selector">RU</div>
            <div class="header-contact">
                <div class="header-contact__content">
                    <a class="header-contact__phone" href="tel:+441473711668">+44 147 371 16 68</a>
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
                    <a class="main-menu__link current" href="">О доставке</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">Компания</a>
                </li>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="">Контакты</a>
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
                        <a class="footer__link footer__link-mr-policy" href="">Курьерская компания СДЭК,© 2000-2020</a>
                        <a class="footer__link footer__link-mr-policy" href="">Политика конфиденциальности</a>
                    </div>
                </div>
                <div class="footer__right">
                    <div class="footer__right-img"></div>
                    <div class="footer__right-text">
                        <div class="footer__contacts">
                            <div class="footer__phone-item">
                                <a class="footer__phone" href="tel:+441473711668">+441473711668</a>
                            </div>
                        </div>
                        <a class="footer__email footer-email" href="mailto:fedorov.m@cdek.ru">fedorov.m@cdek.ru</a>
                    </div>
                </div>
            </div>
        </footer>
        <div class="modal-container">
            <div class="modal" id="feedback-modal">
                <div class="modal__close"></div>
                <div class="modal__content">
                    <div class="modal__heading">Обратная связь</div>
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
                                <input type="checkbox" name="agree" id="modal-agree" /><label for="modal-agree"><span>Я соглашаюсь с <a class="checkbox-widget__link" href="#">условиями обработки персональных данных</a></span></label>
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
                        <div class="modal__result-title">Сообщение<br />успешно отправлено!</div>
                        <div class="modal__result-text">Постаремся ответить на ваш запрос как можно скорее.</div>
                    </div>
                </div>
                <div class="modal__content modal__content_result js-modal-result-error" style="display: none;">
                    <div>
                        <div class="modal__result-icon modal__result-icon_error"></div>
                        <div class="modal__result-title">Ошибка!</div>
                        <div class="modal__result-text">Что-то пошло не так, попробуйте отправить еще раз позднее.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="/universal2/assets/vendor/jquery.min.js"></script>
        <script src="/universal2/assets/vendor/owl.carousel.min.js"></script>
        <script src="/universal2/assets/vendor/jquery.autocomplete.js"></script>
        <script src="/universal2/assets/js/app.js?i20"></script>

    </body>
</html>
