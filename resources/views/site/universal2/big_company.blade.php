<div class="index-big-company">
    <div class="content">
        <div class="index-big-company__content">
            <div class="index-big-company__dots-top background-dots background-dots_size_3x8"></div>
            <h2 class="typo-h2 index-big-company__title">@d('big_header')</h2>
            <div class="divider index-big-company__divider"></div>
            <div class="index-big-company__text">
                @d('big_text')
            </div>
            <a href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'company']) !!}" class="primary-button">@d('big_details')</a>
        </div>
    </div>
</div>
