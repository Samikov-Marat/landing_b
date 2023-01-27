<!-- fast-answer -->
<div class="attention-line">
    <div class="attention-line__content">
        <div class="attention-line__image"></div>
        <div class="attention-line__text">
            {{ $dictionary['fast_answer_content'] }}
            <a class="yellow-line__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'contacts']) !!}">@d('menu_contects')</a>
        </div>
    </div>
</div>
<!-- /fast-answer -->
