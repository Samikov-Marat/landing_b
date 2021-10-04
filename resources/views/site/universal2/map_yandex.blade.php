<div id="map" class="contact-page__map js-map"
     @if('local' == env('APP_ENV'))
     data-url-template="http://landing.dev.cdek.ru/request/get-office-list?bbox=%b"
     @else
     data-url-template="{!! route('request.get_office_list') . '?bbox=%b' !!}"
     @endif
     data-map-state="{{ $dictionary['contacts_map_state'] }}">
</div>
@php
    $yandexParameters = [
        'apikey' => 'a3a191e8-8704-4696-964a-1dac59b0730b',
        'lang' => $dictionary['contacts_yandex_lang'],
    ];
@endphp
<script src="https://api-maps.yandex.ru/2.1/?{!! http_build_query($yandexParameters) !!}"
        type="text/javascript">
</script>
