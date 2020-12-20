@extends('admin.layout')

@section('content')

    <div class="index-page">
        <div class="main-poster index-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading index-page__poster-heading">
                    <h1 class="typo-h1">Доставка из Великобритании<br />в Россию</h1> <span class="main-poster__heading-added typo-h1">от 10.95 £ и 5 дней</span>
                </div>
                <div class="circle-icon-list main-poster__icons">
                    <div class="circle-icon circle-icon_icon_cart circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_business circle-icon-list__icon"></div>
                </div>
                <div class="main-poster__text">
                    — Заказы из интернет-магазинов<br />
                    — Бизнес-отправления
                </div>
                <a href="#" class="primary-button primary-button_with_arrow">Рассчитать стоимость</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>
        <div class="company-advantages screen-content">
    <h2 class="typo-h2 company-advantages__heading">Почему выбирают доставку СДЭК</h2>
    <div class="company-advantages__description">
        Мы гарантируем безопасность груза при доставке любым видом транспорта.<br />
        Вместе с надежными партнерами и подрядчиками мы выстроили оптимальные логистические маршруты. Отправлять со СДЭК ― это:
    </div>
    <div class="square-cards js-company-advantages owl-carousel">
        <div class="square-card square-card_icon_customs">
            <div class="square-card__bg"></div>
            <div class="square-card__title">Просто</div>
            <div class="square-card__description">
                Возьмем на себя всю <span class="typo-bold">логистику и таможенное оформление</span> товаров;
            </div>
        </div>
        <div class="square-card square-card_icon_settings">
            <div class="square-card__bg"></div>
            <div class="square-card__title">Выгодно</div>
            <div class="square-card__description">
                Предлагаем <span class="typo-bold">комплексное решение</span>: доставка, интеграция, маркетинг для интернет-магазинов;
            </div>
        </div>
        <div class="square-card square-card_icon_protect">
            <div class="square-card__bg"></div>
            <div class="square-card__title">Надежно</div>
            <div class="square-card__description">
                Работаем с 2000 года, нам доверяют <span class="typo-bold">1 000 000+ клиентов;</span>
            </div>
        </div>
        <div class="square-card square-card_icon_lorry">
            <div class="square-card__bg"></div>
            <div class="square-card__title">Доступно</div>
            <div class="square-card__description">
                Доставим клиенту на дом или в любой из <span class="typo-bold">2300+ офисов СДЭК;</span>
            </div>
        </div>
        <div class="square-card square-card_icon_parcels">
            <div class="square-card__bg"></div>
            <div class="square-card__title">Удобно</div>
            <div class="square-card__description">
                Дадим трек-номер для <span class="typo-bold">отслеживания</span> посылки и оповестим, что отправление <span class="typo-bold">готово к выдаче.</span>
            </div>
        </div>
    </div>
</div>
        <div class="calculator">
    <div class="screen-content">
        <div class="calculator__content calculator__content_step1">
            <h2 class="typo-h2 calculator__title">Расчет доставки из Великобритании в Россию*</h2>
            <div class="form calculator_form">
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_from">
                        <input type="text" name="from" class="form-field__input" placeholder="Откуда" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_to">
                        <input type="text" name="to" class="form-field__input" placeholder="Куда" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_has_icon form-field_icon_weight">
                        <input type="text" name="weight" class="form-field__input" placeholder="Вес (кг)" />
                    </div>
                </div>
                <div class="form__three-fields form__row_last">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="length" class="form-field__input" placeholder="Длина (см)" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="width" class="form-field__input" placeholder="Ширина (см)" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="height" class="form-field__input" placeholder="Высота (см)" />
                        </div>
                    </div>
                </div>
                <div class="form-field">
                    <input type="submit" value="Рассчитать стоимость" class="primary-button primary-button_wide primary-button_submit" />
                </div>
            </div>
            <div class="calculator__description">
                При оформлении отправки, сотрудники CDEK проверят фактический и объемный вес отправлений. Оплата будет производиться за большую
                из двух величин.Объемный вес рассчитывается по формуле: Длина (см) × Ширина (см) × Высота (см) / 5000 = Объемный вес (кг).
            </div>
        </div>
        <div class="calculator__content calculator__content_step2" style="display: none;">
            <div class="calculator__step-container">
                <a href="#" class="calculator__step-link calculator__step-link_back">Изменить расчет</a>
            </div>
            <div class="calculator__tariff-used">
                <div>
                    Деланко, Нью-Джерси <span class="typo-colored typo-colored_color_green">—</span> Москва<br />
                    Посылка 1кг, 0.01 м3
                </div>
            </div>
            <h2 class="typo-h2 calculator__title">Выберите тариф</h2>
            <div class="calculator__tariff-list">
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="1" id="tariff-1" /><label for="tariff-1">Международный экспресс документы</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка документов для бизнеса и частных лиц</div>
                            <div class="calculator__tariff-item-type">Дверь-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">7 360 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="2" id="tariff-2" /><label for="tariff-2">Международный экспресс грузы</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка образцов и другой продукции для бизнеса</div>
                            <div class="calculator__tariff-item-type">Дверь-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">8 100 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="3" id="tariff-3" /><label for="tariff-3">CDEK-Express</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка только от интернет-магазинов клиентам</div>
                            <div class="calculator__tariff-item-type">Cклад-склад</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">983.72 ₽</div>
                </div>
                <div class="calculator__tariff-item">
                    <div>
                        <div class="calculator__tariff-item-title">
                            <div class="choice-widget">
                                <input type="radio" name="tariff" value="3" id="tariff-4" /><label for="tariff-4">CDEK-Express</label>
                            </div>
                        </div>
                        <div class="calculator__tariff-item-info">
                            <div class="calculator__tariff-item-description">Доставка только от интернет-магазинов клиентам</div>
                            <div class="calculator__tariff-item-type">Cклад-дверь</div>
                        </div>
                    </div>
                    <div class="calculator__tariff-item-price">1 102.72 ₽</div>
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step3" style="display: none;">
            <div class="calculator__step-container">
                <a href="#" class="calculator__step-link calculator__step-link_back">Изменить расчет</a>
                <a href="#" class="calculator__step-link calculator__step-link_repeat">Новый расчет</a>
            </div>
            <div class="calculator__tariff-used">
                <div>
                    Деланко, Нью-Джерси <span class="typo-colored typo-colored_color_green">—</span> Москва<br />
                    Посылка 1кг, 0.01 м3
                </div>
                <div class="calculator__tariff-used-price">983.72 ₽</div>
            </div>
            <div class="calculator__contact-title">Контактные данные</div>
            <div class="calculator__contact-description">
                Менеджер свяжется с вами по указанным контактам, чтобы подробнее рассказать о наших тарифах и условиях доставки.
            </div>
            <div class="form calculator_form">
                <div class="form__row">
                    <div class="form-field">
                        <input type="text" name="name" class="form-field__input" placeholder="Имя" />
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_error">
                        <input type="text" name="phone" class="form-field__input" placeholder="Телефон" />
                        <div class="form-field__error-message">Укажите корректный телефон</div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form-field form-field_error">
                        <input type="text" name="email" class="form-field__input" placeholder="E-mail" />
                        <div class="form-field__error-message">Укажите корректный e-mail</div>
                    </div>
                </div>
                <div class="form__row form__row_no-input">
                    <div class="checkbox-widget">
                        <input type="checkbox" name="agree" id="agree" /><label for="agree"><span>Я соглашаюсь с <a class="checkbox-widget__link" href="#">условиями обработки персональных данных</a></span></label>
                    </div>
                </div>
                <div class="form-field">
                    <input type="submit" value="Отправить" class="primary-button primary-button_wide primary-button_submit" />
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-ok" style="display: none;">
            <div>
                <div class="calculator__result-icon calculator__result-icon_ok"></div>
                <div class="calculator__result-title">Спасибо!</div>
                <div class="calculator__result-text">Менеджер свяжется с вами по указанным контактам, чтобы подробнее рассказать о наших тарифах и условиях доставки.</div>
                <div class="calculator__step-container calculator__step-container_single">
                    <a href="#" class="calculator__step-link calculator__step-link_repeat">Новый расчет</a>
                </div>
            </div>
        </div>
        <div class="calculator__content calculator__content_step-result js-calculator__content_step-result-error" style="display: none;">
            <div>
                <div class="calculator__result-icon calculator__result-icon_error"></div>
                <div class="calculator__result-title">Ошибка!</div>
                <div class="calculator__result-text">Что-то пошло не так, попробуйте<br />отправить еще раз позднее.</div>
            </div>
        </div>
    </div>
</div>
        <div class="index-special-conditions screen-content">
            <h2 class="typo-h2 index-special-conditions__title">Специальные условия для каждого отправителя</h2>
            <div class="index-special-conditions__content">
                <div class="index-special-conditions__dots-left background-dots background-dots_size_3x4"></div>
                <div class="index-special-conditions__dots-right background-dots"></div>
                <a href="#" class="index-special-conditions__card index-special-conditions__card_yellow">
                    <div class="index-special-conditions__card-text">Интернет магазинам</div>
                    <div class="index-special-conditions__arrow"></div>
                </a>
                <a href="#" class="index-special-conditions__card">
                    <div class="index-special-conditions__card-text">Корпоративным клиентам</div>
                    <div class="index-special-conditions__arrow"></div>
                </a>
            </div>
        </div>
        <div class="how-it-works">
            <h2 class="typo-h2 how-it-works__title">Как это работает?</h2>
            <div class="submenu submenu_centered how-it-works__submenu">
                <div class="submenu__content">
                    <div class="submenu__item submenu__item_active">Интернет магазинам</div>
                    <a href="#" class="submenu__item">Корпоративным клиентам</a>
                </div>
            </div>
            <div class="content">
                <div class="how-it-works__content index-page__how-it-works-content">
                    <div class="index-page__how-it-works-dots background-dots"></div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_contract"></div>
                        </div>
                        <div class="how-it-works__item-num">1.</div>
                        <div class="how-it-works__item-text">Мы заключаем договор с вами и даем данные для входа в личный кабинет.</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_lorry"></div>
                        </div>
                        <div class="how-it-works__item-num">2.</div>
                        <div class="how-it-works__item-text">Вы привозите товары для отправки в офис СДЭК или вызываете нашего курьера.</div>
                    </div>
                    <div class="how-it-works__item how-it-works__item_no-margin">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_stock"></div>
                        </div>
                        <div class="how-it-works__item-num">3.</div>
                        <div class="how-it-works__item-text">Мы получаем груз и данные ваших клиентов для российской таможни. Если у вас нет этой информации, мы сами свяжемся с получателями.</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_phone"></div>
                        </div>
                        <div class="how-it-works__item-num">4.</div>
                        <div class="how-it-works__item-text">Мы даем трек-номер для отслеживания посылки, а вы сообщаете его клиенту.</div>
                    </div>
                    <div class="how-it-works__item">
                        <div class="how-it-works__item-icon-container">
                            <div class="how-it-works__item-icon how-it-works__item-icon_icon_got"></div>
                        </div>
                        <div class="how-it-works__item-num">5.</div>
                        <div class="how-it-works__item-text">Мы доставляем заказы в Россию и вручаем их получателю в пункте выдачи СДЭК или доставляем клиенту на дом.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="package-russia screen">
    <div class="package-russia__content content">
        <div class="package-russia__text">
            <h2 class="typo-h2 package-russia__title">Два способа получить посылку в России</h2>
            <div class="package-russia__ways">
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_map"></div>
                    <div class="package-russia__way-text">Доставка в пункт выдачи заказов</div>
                </div>
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_hand-box"></div>
                    <div class="package-russia__way-text">Курьерская доставка от двери до двери</div>
                </div>
            </div>
            <div class="divider package-russia__divider"></div>
            <div class="package-russia__know-more">Узнайте больше о сотрудничестве со СДЭК!</div>
            <a href="#" class="primary-button">Свяжитесь с нами</a>
        </div>
        <div class="package-russia__office">
            <div class="package-russia__office-num">2 300+</div>
            <div class="package-russia__office-text">Офисов в 20 странах</div>
        </div>
    </div>
</div>
        <div class="faq screen">
            <div class="content faq__container">
                <div class="faq__content">
                    <div class="faq__dots-top background-dots background-dots_size_3x8"></div>
                    <h2 class="typo-h2 faq__title">Часто задаваемые вопросы</h2>
                    <div class="submenu faq__submenu">
                        <div class="submenu__content">
                            <div class="submenu__item submenu__item_active">Интернет магазинам</div>
                            <a href="#" class="submenu__item">Корпоративным клиентам</a>
                        </div>
                    </div>
                    <div class="faq-list faq__faq-list">
                        <div class="faq-list__faq faq-list__faq_opened">
                            <div class="faq-list__faq-question">Как рассчитывается тариф, что в него входит?</div>
                            <div class="faq-list__faq-answer">Наши тарифы включают таможенную очистку только для недорогих товаров. Ввозные и вывозные пошлины, местные и таможенные сборы, налоги/НДС на транспортные услуги в наши тарифы не включены.</div>
                        </div>
                        <div class="faq-list__faq">
                            <div class="faq-list__faq-question">Где есть офисы СДЭК? В какие страны осуществляете доставку?</div>
                        </div>
                        <div class="faq-list__faq">
                            <div class="faq-list__faq-question">Какие условия по ввозу товаров из-за границы действуют в России?</div>
                        </div>
                        <div class="faq-list__faq">
                            <div class="faq-list__faq-question">Что нельзя отправить тарифом CDEK Express?</div>
                        </div>
                        <div class="faq-list__faq">
                            <div class="faq-list__faq-question">Как узнать, где посылка?</div>
                        </div>
                        <div class="faq-list__faq">
                            <div class="faq-list__faq-question">Какие уведомления придут получателю посылки?</div>
                        </div>
                    </div>
                    <div class="faq__more">
                        <a href="#" class="primary-button">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="index-big-company">
            <div class="content">
                <div class="index-big-company__content">
                    <div class="index-big-company__dots-top background-dots background-dots_size_3x8"></div>
                    <h2 class="typo-h2 index-big-company__title">СДЭК – одна из крупнейших и наиболее популярных логистических компаний в России</h2>
                    <div class="divider index-big-company__divider"></div>
                    <div class="index-big-company__text">
                        В 2000 году компания была основана в Сибири.<br />
                        2001 ― открылся первый пункт выдачи СДЭК в Москве.<br />
                        2008 ― компания вышла на международный рынок и запустила первый зарубежный офис.<br />
                    </div>
                    <a href="#" class="primary-button">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="partner">
    <div class="content">
        <h2 class="typo-h2 partner__title">Наши клиенты и партнеры</h2>
        <div class="partner__list">
            <div class="partner__item partner__item_asos"></div>
            <div class="partner__item partner__item_ebay"></div>
            <div class="partner__item partner__item_aliexpress"></div>
            <div class="partner__item partner__item_ozon"></div>
            <div class="partner__item partner__item_yves-rocher"></div>
            <div class="partner__item partner__item_loreal"></div>
            <div class="partner__item partner__item_oriflame"></div>
            <div class="partner__item partner__item_avon"></div>
            <div class="partner__item partner__item_mary-key"></div>
            <div class="partner__item partner__item_rebound"></div>
        </div>
        <div class="partner__more-container">
            <a href="#" class="partner__more">Показать еще</a>
        </div>
    </div>
</div>
        <div class="question">
    <div class="question__content">
        <div class="question__icon-1">
            <div class="question__icon-2">
                <div class="question__icon-3">?</div>
            </div>
        </div>
        <div class="question__title">Остались вопросы?</div>
        <div class="question__desc">Мы ответим на все и расскажем подробнее</div>
        <div class="question__desc-2">Давайте обсудим наше сотрудничество </div>
        <a href="#" class="primary-button js-feedback-open">Свяжитесь с нами</a>
    </div>
</div>
    </div>

@endsection
