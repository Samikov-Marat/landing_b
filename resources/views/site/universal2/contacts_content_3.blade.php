<div class="contact-page__list contact-page__list_lots hidden js-contacts-tab-content-3">
    @foreach($topOffices as $topOffice)
        <div class="contact-page__item">
            <div class="contact-page__country">{{ $topOffice->pivot->country }}</div>
            <div class="contact-page__city">{{ $topOffice->pivot->name }}</div>
            <div class="contact-page__street">{{ $topOffice->pivot->full_address }}</div>
            <div class="contact-page__metro">{{ $topOffice->pivot->address_comment }}</div>
            <div class="contact-page__schedule">
                {{ $topOffice->pivot->work_time }}
            </div>
            <a class="contact-page__site" href="https://cdek.ru">
                cdek.ru
            </a>
            <div class="contact-page__phone">{{ $topOffice->office->email }}</div>
            <div class="contact-page__email">E-mail: <a href="mailto:{{ $topOffice->office->email }}" class="contact-page__link">{{ $topOffice->office->email }}</a></div>
        </div>
    @endforeach
</div>
