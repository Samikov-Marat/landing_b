<div class="package-russia screen">
    @php
        $templateGtm = [
            'universal2.documents' => 'document_contact_us',
            ];
        $buttonGtm = $templateGtm[$page->template] ?? '';

        $templateGtmForm = [
            'universal2.documents' => 'document_send_form',
            ];
        $buttonGtmForm = $templateGtmForm[$page->template] ?? '';
    @endphp
    <div class="package-russia__content content">
        <div class="package-russia__text">
            <h2 class="typo-h2 package-russia__title">@d('receive_title')</h2>
            <div class="package-russia__ways">
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_map"></div>
                    <div class="package-russia__way-text">@d('receive_text_1')</div>
                </div>
                <div class="package-russia__way">
                    <div class="circle-icon circle-icon_icon_hand-box"></div>
                    <div class="package-russia__way-text">@d('receive_text_2')</div>
                </div>
            </div>
            <div class="divider package-russia__divider"></div>
            <div class="package-russia__know-more">@d('receive_more')</div>
            <a href="#" class="primary-button js-feedback-open gtm-click"
               data-send-form-event="{{$buttonGtmForm}}"
               data-click="{{$buttonGtm}}"
            >@d('receive_button')</a>
        </div>
        <div class="package-russia__office">
            <div class="package-russia__office-num">@d('receive_office_count_prefix')@knumber('offices')@d('receive_office_count')</div>
            <div class="package-russia__office-text">@d('receive_country_count_prefix')@knumber('countries')@d('receive_country_count')</div>
        </div>
    </div>
</div>
