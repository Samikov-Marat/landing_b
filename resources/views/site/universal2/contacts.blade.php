@extends('site.universal2.layout')

@section('content')

    <div class="contact-page screen">
        <div class="content">
            <h1 class="typo-h1 contact-page__heading">@d('page_header')</h1>
        </div>
        <div class="submenu contact-page__submenu">
            <div class="submenu__content">
                <div class="submenu__item submenu__item_active js-contact-tab" data-content=".js-contacts-tab-content-1">@d('tab_1')</div>
                <div class="submenu__item  js-contact-tab" data-content=".js-contacts-tab-content-2">@d('tab_2')</div>
                <div class="submenu__item  js-contact-tab" data-content=".js-contacts-tab-content-3">@d('tab_3')</div>
                <a href="#" class="submenu__item contact-page__feedback js-feedback-open">@d('feedback')</a>
            </div>
        </div>
        @include('site.universal2.contacts_content_1')
        @include('site.universal2.contacts_content_2')
        @include('site.universal2.contacts_content_3')
    </div>
@endsection
