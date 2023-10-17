@if(!empty($dictionary['alert_personal_information']))
    <div class="alert__container">
        <div class="alert__block">
            <div class="alert alert__personal-information" data-href="{!! route('site.show_page', ['languageUrl' => $language->uri, '#personal-information']) !!}">
                @d('alert_personal_information')
            </div>
        </div>
    </div>
@endif
