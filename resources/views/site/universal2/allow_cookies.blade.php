@if(!$allowCookies)

    <div class="cookie-confirm">
        <div class="cookie-confirm__close"></div>
        <div class="cookie-confirm__container">
            <div class="cookie-confirm__heading">@d('allow_cookies_192')</div>
            <div class="cookie-confirm__paragraph">
                @d('allow_cookies_193')
            </div>
            <div class="cookie-confirm__heading">@d('allow_cookies_194')</div>
            <div class="cookie-confirm__paragraph">
                @d('allow_cookies_195')
                <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}"
                   target="_blank"
                   class="cookie-confirm__link">@d('allow_cookies_196')</a>
            </div>
        </div>
        <button type="button" data-url="{{ route('request.allow_cookies') }}" class="primary-button cookie-confirm__button js-cookies-confirm">@d('allow_cookies_197')</button>
    </div>
@endif

