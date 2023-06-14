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
                @if($dictionary['footer_has_privacy_policy_page'] != '-')
                    <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']) !!}"
                       target="_blank"
                       class="cookie-confirm__link">@d('allow_cookies_196')</a>
                @else
                    <a href="/storage/Privacy_Policy.pdf"
                       target="_blank"
                       class="cookie-confirm__link">@d('allow_cookies_196')</a>
                @endif

            </div>
        </div>
        <form method="post" action="{!! route('request.allow_cookies') !!}" class="js-cookies-confirm-form">
            <input type="hidden" name="url" value="{{ $url->full() }}">
            <button type="submit" class="primary-button cookie-confirm__button js-cookies-confirm">@d('allow_cookies_197')</button>
        </form>
    </div>
@endif

