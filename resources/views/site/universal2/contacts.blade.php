@extends('site.universal2.layout')

@section('content')

    <div class="contact-page screen">
        <div class="content">
            <h1 class="typo-h1 contact-page__heading">Контакты</h1>
        </div>
        <div class="submenu contact-page__submenu">
            <div class="submenu__content">
                <div class="submenu__item submenu__item_active">Великобритания</div>
                <a class="submenu__item" href="#">Россия</a>
                <a class="submenu__item" href="#">Другие страны</a>
                <a href="#" class="submenu__item contact-page__feedback">Обратная связь</a>
            </div>
        </div>
        <div class="contact-page__list">
            <div class="contact-page__item">
                <div class="contact-page__city">Харлоу</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
            <div class="contact-page__item">
                <div class="contact-page__city">Ипсуич</div>
                <div class="contact-page__street">ул. Авиамоторная, 67/8</div>
                <div class="contact-page__metro">Ближайшая станция метро Авиамоторная</div>
                <div class="contact-page__schedule">
                    ПН – ПТ: 09:00-21:00<br />
                    СБ, ВС: 10:00-18:00
                </div>
                <div class="contact-page__phone">+7 (495) 797-81-08</div>
                <div class="contact-page__email">E-mail: <a href="#" class="contact-page__link">msk@cdek.ru</a></div>
            </div>
        </div>
        <div class="contact-page__map"></div>
    </div>

@endsection
