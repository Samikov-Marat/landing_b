@extends('site.universal2.layout')

@section('content')

    <div class="contact-page screen">
        <div class="content">
            <h1 class="typo-h1 contact-page__heading">@d('page_header')</h1>
        </div>
        <div class="submenu contact-page__submenu">
            <div class="submenu__content">
                <div class="submenu__item submenu__item_active">@d('tab_1')</div>
                {{--                <a class="submenu__item" href="#">@d('tab_2')</a>--}}
                {{--                <a class="submenu__item" href="#">@d('tab_3')</a>--}}
                <a href="#" class="submenu__item contact-page__feedback js-feedback-open">@d('feedback')</a>
            </div>
        </div>
        <div class="contact-page__list">

            @foreach($site->localOffices as $localOffice)

                <div class="contact-page__item">
                    @if($localOffice->localOfficeTexts->count())
                        <div class="contact-page__city">{{ $localOffice->localOfficeTexts[0]->name }}</div>
                        <div class="contact-page__street">{{ $localOffice->localOfficeTexts[0]->address }}</div>
                        <div class="contact-page__metro">{{ $localOffice->localOfficeTexts[0]->path }}</div>

                        <div class="contact-page__schedule">
                            {!! nl2br(e($localOffice->localOfficeTexts[0]->worktime)) !!}
                        </div>
                    @endif
                    @foreach($localOffice->localOfficePhones as $localOfficePhone)
                        <div class="contact-page__phone">
                            <a class="contact-page__link" href="tel:{{ $localOfficePhone->phone_value }}">{{ $localOfficePhone->phone_text }}</a>
                        </div>
                    @endforeach
                    @foreach($localOffice->localOfficeEmails as $localOfficeEmail)
                        <div class="contact-page__email">E-mail: <a href="mailto:{{ $localOfficeEmail->email }}"
                                                                    class="contact-page__link">{{ $localOfficeEmail->email }}</a>
                        </div>
                    @endforeach
                </div>
            @endforeach


        </div>
        @if('' != $dictionary['contacts_open_street_map_state'])
            @include('site.universal2.map_open_street')
        @else
            @include('site.universal2.map_yandex')
        @endif
    </div>
@endsection
