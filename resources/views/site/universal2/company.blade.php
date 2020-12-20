@extends('admin.layout')

@section('content')

    <div class="company-page">
        <div class="company-poster">
            <div class="content">
                <div class="company-poster__content">
                    <h1 class="typo-h1 company-poster__heading">СДЭК – одна из крупнейших и наиболее популярных логистических компаний в России</h1>
                    <div class="divider company-poster__divider"></div>
                    <div class="company-poster__text">
                        В 2000 году компания была основана в Сибири.<br />
                        2001 ― открылся первый пункт выдачи СДЭК в Москве.<br />
                        2008 ― компания вышла на международный рынок и запустила первый зарубежный офис.
                    </div>
                </div>
            </div>
        </div>
        <div class="company-grow screen">
            <div class="content">
                <div class="company-grow__content">
                    <h2 class="typo-h2 company-grow__title">Мы постоянно расширяемся</h2>
                    <div class="company-grow__inner-content">
                        <div class="company-grow__text">СДЭК сегодня ― это</div>
                        <div class="company-grow__cards">
                            <div class="company-grow__card company-grow__card_green">
                                <div class="company-grow__card-num">200+</div>
                                <div>направлений доставки<br />по всему миру</div>
                            </div>
                            <div class="company-grow__card-empty">
                                <div class="company-grow__card-shadow"></div>
                                <div class="company-grow__card company-grow__card_yellow">
                                    <div class="company-grow__card-num">20</div>
                                    <div>стран с собственными<br />офисами</div>
                                </div>
                            </div>
                        </div>
                        <div class="company-grow__flags">

                                <div class="company-grow__flag company-grow__flag_country_ru"></div>

                                <div class="company-grow__flag company-grow__flag_country_ua"></div>

                                <div class="company-grow__flag company-grow__flag_country_us"></div>

                                <div class="company-grow__flag company-grow__flag_country_uk"></div>

                                <div class="company-grow__flag company-grow__flag_country_de"></div>

                                <div class="company-grow__flag company-grow__flag_country_kg"></div>

                                <div class="company-grow__flag company-grow__flag_country_kz"></div>

                                <div class="company-grow__flag company-grow__flag_country_by"></div>

                                <div class="company-grow__flag company-grow__flag_country_am"></div>

                                <div class="company-grow__flag company-grow__flag_country_uz"></div>

                                <div class="company-grow__flag company-grow__flag_country_ge"></div>

                                <div class="company-grow__flag company-grow__flag_country_cz"></div>

                                <div class="company-grow__flag company-grow__flag_country_kr"></div>

                                <div class="company-grow__flag company-grow__flag_country_cn"></div>

                                <div class="company-grow__flag company-grow__flag_country_lv"></div>

                                <div class="company-grow__flag company-grow__flag_country_ae"></div>

                                <div class="company-grow__flag company-grow__flag_country_tr"></div>

                                <div class="company-grow__flag company-grow__flag_country_th"></div>

                                <div class="company-grow__flag company-grow__flag_country_az"></div>

                                <div class="company-grow__flag company-grow__flag_country_it"></div>

                        </div>
                        <div class="company-grow__countries">Россия, Украина, США, Великобритания, Германия, Киргизия, Казахстан, Республика Беларусь, Армения, Узбекистан, Грузия,  Чехия, Южная Корея, Китай, Латвия, ОАЭ, Турция, Таиланд, Азербайджан, Италия.</div>
                    </div>
                </div>
            </div>
            <div class="company-grow__numbers">
                <div class="company-grow__numbers-title">СДЭК в цифрах</div>
                <div class="company-grow__numbers-list">
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_office">
                        <div class="company-grow__numbers-item-num">2300+</div>
                        <div>офисов по всему миру</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_shop">
                        <div class="company-grow__numbers-item-num">64 000+</div>
                        <div>интернет-магазинов</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_city">
                        <div class="company-grow__numbers-item-num">36 000+</div>
                        <div>городов и населенных пунктов в России</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_package">
                        <div class="company-grow__numbers-item-num">200 000</div>
                        <div>отправлений в день</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_world">
                        <div class="company-grow__numbers-item-num">20</div>
                        <div>международных подразделений</div>
                    </div>
                </div>
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
