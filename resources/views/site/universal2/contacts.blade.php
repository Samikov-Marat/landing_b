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
            <div class="contact-page__item">
                <div class="contact-page__city">@d('contacts_harlow_name')</div>
                <div class="contact-page__street">@d('contacts_harlow_address')</div>
                <div class="contact-page__metro">@d('contacts_harlow_path')</div>
                <div class="contact-page__schedule">
                    @d('contacts_harlow_time')
                </div>
                <div class="contact-page__phone">@d('contacts_harlow_phone_formatted')</div>
                <div class="contact-page__email">E-mail: <a href="mailto:{{ $dictionary['contacts_harlow_email'] }}" class="contact-page__link">@d('contacts_harlow_email')</a></div>
            </div>

            <div class="hidden" id="harlow_baloon">
                <div class="js-baloon-header">@d('contacts_harlow_name')</div>
                <div class="js-baloon-body">@d('contacts_harlow_address')</div>
                <div class="js-baloon-footer">@d('contacts_harlow_phone_formatted')</div>
            </div>

            <div class="contact-page__item">
                <div class="contact-page__city">@d('contacts_ipswich_name')</div>
                <div class="contact-page__street">@d('contacts_ipswich_address')</div>
                <div class="contact-page__metro">@d('contacts_ipswich_path')</div>
                <div class="contact-page__schedule">
                    @d('contacts_ipswich_time')
                </div>
                <div class="contact-page__phone">@d('contacts_ipswich_phone_formatted')</div>
                <div class="contact-page__email">E-mail: <a href="mailto:{{ $dictionary['contacts_ipswich_email'] }}" class="contact-page__link">@d('contacts_ipswich_email')</a></div>
            </div>

            <div class="hidden" id="ipswich_baloon">
                <div class="js-baloon-header">@d('contacts_ipswich_name')</div>
                <div class="js-baloon-body">@d('contacts_ipswich_address')</div>
                <div class="js-baloon-footer">@d('contacts_ipswich_phone_formatted')</div>
            </div>

        </div>
        <div id="map" class="contact-page__map js-map"></div>
    </div>

@endsection
