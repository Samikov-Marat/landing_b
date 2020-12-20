@extends('admin.layout')

@section('content')


    <div class="contact-page screen">
        <div class="content">
            <h1 class="typo-h1 contact-page__heading">Контакты</h1>
        </div>
        <div class="submenu contact-page__submenu">
            <div class="submenu__content">
                <a class="submenu__item" href="#">Великобритания</a>
                <a class="submenu__item" href="#">Россия</a>
                <div class="submenu__item submenu__item_active">Другие страны</div>
                <a href="#" class="submenu__item contact-page__feedback">Обратная связь</a>
            </div>
        </div>
        <div class="contact-page__map contact-page__map_pos_top"></div>
        <div class="content">
            <div class="form-field form-field_filter contact-page__filter">
                <input type="text" class="form-field__input" name="search" placeholder="Укажите вашу страну" />
            </div>
            <div class="contact-page__found">Найдено 120 офисов:</div>
        </div>
        <div class="contact-page__list contact-page__list_lots">
            <div class="contact-page__item">
                <div class="contact-page__country">Великобритания</div>
                <div class="contact-page__city">Харлоу</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Великобритания</div>
                <div class="contact-page__city">Ипсуич</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Южная корея</div>
                <div class="contact-page__city">Сеул</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Латвия</div>
                <div class="contact-page__city">Рига</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Великобритания</div>
                <div class="contact-page__city">Харлоу</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Великобритания</div>
                <div class="contact-page__city">Ипсуич</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Южная корея</div>
                <div class="contact-page__city">Сеул</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__country">Латвия</div>
                <div class="contact-page__city">Рига</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <a class="contact-page__site" href="#">cdek.com</a>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
        </div>
    </div>

@endsection
