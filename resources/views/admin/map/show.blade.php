@extends('admin.layout')

@section('header')
    Карта
@endsection

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.map.update', ['site' => $siteId]) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="state" value="{{ $contacts_map_state }}">
            <button type="submit" class="btn btn-success mb-3 js-map-admin">Сохранить</button>
        </form>
    </div>
    <div id="map" class="contact-page__map js-yandex-map js-contacts-tab-content-1" style="width: 1200px; height: 550px;"
         @if('local' == env('APP_ENV'))
             data-url-template="https://cdek.uk/request/get-office-list?bbox=%b"
         @else
             data-url-template="{!! route('request.get_office_list') . '?bbox=%b&lang='.$dictionary['contacts_office_lang'] !!}"
         @endif
         data-map-state="{{ $contacts_map_state }}"
    >
    </div>
    @php
        $yandexParameters = [
            'apikey' => 'a3a191e8-8704-4696-964a-1dac59b0730b',
            'lang' => 'ru',
        ];
    @endphp
    <script src="https://api-maps.yandex.ru/2.1/?{!! http_build_query($yandexParameters) !!}"
            type="text/javascript">
    </script>
@endsection