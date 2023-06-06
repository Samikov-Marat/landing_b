<div id="map" class="contact-page__map js-yandex-map js-contacts-tab-content-1"
     @if('local' == env('APP_ENV'))
     data-url-template="https://cdek.uk/request/get-office-list?bbox=%b"
     @else
     data-url-template="{!! route('request.get_office_list') . '?bbox=%b&lang='.$dictionary['contacts_office_lang'] !!}"
     @endif
         @if(isset($subdomain) && $subdomain->hasSubdomain() && isset($subdomain->getFranchisee()->localOffices->first()->map_preset) && ($subdomain->getFranchisee()->localOffices->first()->map_preset !== ''))
             data-map-state="{{ $subdomain->getFranchisee()->localOffices->first()->map_preset }}"
         @else
             data-map-state="{{ $dictionary['contacts_map_state'] }}"
        @endif
            >
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
