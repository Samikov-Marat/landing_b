@extends('site.universal2.layout')

@section('content')


    <div class="e-commerce-page">
        <div class="main-poster e-commerce-page__poster screen">
            <div class="main-poster__content">
                <div class="main-poster__heading e-commerce-page__heading">
                    <h1 class="typo-h1">Доставка товаров из интернет-магазинов<br />Великобритании клиентам в Россию и страны СНГ</h1>
                </div>
                <div class="circle-icon-list main-poster__icons">
                    <div class="circle-icon circle-icon_icon_courier circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_ru circle-icon-list__icon"></div>
                    <div class="circle-icon circle-icon_icon_calendar circle-icon-list__icon"></div>
                </div>
                <div class="main-poster__text">
                    —  Курьером или в пункты выдачи заказов<br />
                    —  В Россию и страны СНГ<br />
                    —  Доставка от 5 дней
                </div>
                <a href="#" class="primary-button primary-button_with_arrow">Рассчитать стоимость</a>
                <div class="background-dots main-poster__dots-left"></div>
                <div class="main-poster__wave-right"></div>
            </div>
        </div>
        <div class="company-advantages screen-content">
            <h2 class="typo-h2 company-advantages__heading e-commerce-page__company-adv-heading">Тариф <span class="typo-colored_color_green">«CDEK Express»</span></h2>
            <div class="company-advantages__description e-commerce-page__company-adv-description">
                Привезем заказы из интернет-магазинов Великобритании в Россию и страны СНГ
            </div>
            <div class="two-icons e-commerce-page__company-adv-icons">
                <div class="two-icons__item">
                    <div class="two-icons__icon"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">0,5 кг</span> от <span class="two-icons__text-big">5,88 £</span></div>
                </div>
                <div class="two-icons__item">
                    <div class="two-icons__icon two-icons__icon_icon_second"></div>
                    <div class="two-icons__text"><span class="two-icons__text-big">1 кг</span> от <span class="two-icons__text-big">10,77 £</span></div>
                </div>
            </div>
            <div class="square-cards js-company-advantages owl-carousel">
                <div class="square-card square-card_size_big square-card_big-icon_packages">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">Доставка и удобное получение</div>
                    <div class="square-card__description">
                        Привезем товар в Россию ― в один из 2300+ пунктов выдачи СДЭК с примерочными или клиенту на дом.
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_contract">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">Таможня</div>
                    <div class="square-card__description">
                        Проведем таможенное оформление в Великобритании и России, сами соберем у ваших клиентов личные данные, необходимые для этой процедуры.
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_mail">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">Уведомления получателя</div>
                    <div class="square-card__description">
                        Мы позвоним получателю и отправим ему уведомления в мессенджеры или по SMS, когда заказ будет готов к вручению.
                    </div>
                </div>
                <div class="square-card square-card_size_big square-card_big-icon_integration">
                    <div class="square-card__bg"></div>
                    <div class="square-card__title">Интеграция</div>
                    <div class="square-card__description">
                        Синхронизируйте работу наших сервисов с сайтом вашего интернет-магазина, чтобы повысить конверсию продаж и легко управлять всеми процессами доставки.
                    </div>
                </div>
            </div>
        </div>
        <div class="ecom-solution screen">
            <div class="content">
                <div class="ecom-solution__content">

                    <div class="ecom-solution__title">Маркетинговые решения для наших партнеров</div>
                    <div class="ecom-solution__desc">Бесплатно поможем выйти на российский рынок и найти новых клиентов. </div>
                    <div class="ecom-solution__list">
                        <div class="ecom-solution__item ecom-solution__item_icon_1">Поможем создать и реализовать маркетинговую стратегию для продвижения вашего бизнеса на российском рынке.</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_2">Проведем полный интернет-анализ ваших конкурентов. </div>
                        <div class="ecom-solution__item ecom-solution__item_icon_3">Разработаем и создадим рекламные сообщения и баннеры.</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_4">Настроим рекламные кампании в Google, Yandex.ru, Facebook, Instagram.</div>
                        <div class="ecom-solution__item ecom-solution__item_icon_5">Подскажем, как разместить товары на маркетплейсах Ozon.ru и CDEK.MARKET, и доставим их вашим клиентам.</div>
                    </div>
                </div>
                <div class="ecom-solution__promo">
                    <div class="ecom-solution__promo-title">Разместим информацию о вашем интернет-магазине на наших площадках:</div>
                    <div class="ecom-solution__promo-list">
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_heart">
                            <div class="ecom-solution__promo-list-num">400 000+</div>
                            <div class="ecom-solution__promo-list-text">Подписчиков в социальных сетях </div>
                        </div>
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_eye">
                            <div class="ecom-solution__promo-list-num">13 000 000+</div>
                            <div class="ecom-solution__promo-list-text">Посещений в месяц на нашем сайте</div>
                        </div>
                        <div class="ecom-solution__promo-list-item ecom-solution__promo-list-item_icon_mail">
                            <div class="ecom-solution__promo-list-num">600 000+</div>
                            <div class="ecom-solution__promo-list-text">Адресов в нашей E-mail рассылке </div>
                        </div>
                    </div>
                    <a href="#" class="ecom-solution__link">Cкачать презентацию<br />по маркетинговому сопровождению</a>
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
                        <div class="how-it-works__item-text">Вы получаете трек-номер для отслеживания посылки и сообщаете его клиенту. </div>
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
