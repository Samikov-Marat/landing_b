@if($subdomain->hasSubdomain() && $franchiseeContainer->franchiseeNewsArticles->isNotEmpty())
<div class="screen-content" id="news">
    <div class="office-page__heading2">@d('franchisee_new_header')</div>
    <div class="news-list__content">
        @foreach($franchiseeContainer->franchiseeNewsArticles as $franchiseeNewsArticle)
            @if($franchiseeNewsArticle->franchiseeNewsArticleTexts->isNotEmpty())
                <div class="news news-list__news js-news-item" data-id="{{ $franchiseeNewsArticle->id }}">
                    <a href="#"><img class="news__img"
                                     src="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->preview)  }}"
                                     alt="{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->header }}"/></a>
                    <div
                        class="news__date">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->publication_date_text }}</div>
                    <a href="#" class="news__title">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->header }}</a>
                    <div class="news__desc">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->note }}</div>


                    <div class="news-modal js-news-modal">
                        <div class="news-modal__close"></div>
                        <div class="news-modal__img">
                            <picture>
                                <source
                                    srcset="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->mobile) }}, {{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->mobile2) }} 2x"
                                    media="(max-width: 480px)">
                                <source
                                    srcset="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image) }}, {{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image2) }} 2x">
                                <img class="news-modal__image"
                                     src="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image) }}"/>
                            </picture>
                        </div>
                        <div class="news-modal__title-container">
                            <div
                                class="news-modal__date">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->publication_date_text }}</div>
                            <div
                                class="news-modal__title">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->header }}</div>
                        </div>
                        <div class="news-modal__text">
                            @php
                                $paragraphs = explode("\n", $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->text);
                            @endphp
                            @foreach($paragraphs as $paragraph)
                                <div class="news-modal__paragraph">{{ $paragraph }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<div class="modal-container">
    @foreach($franchiseeContainer->franchiseeNewsArticles as $franchiseeNewsArticle)
        @if($franchiseeNewsArticle->franchiseeNewsArticleTexts->isNotEmpty())
            <div class="news-modal js-news-modal" data-id="{{ $franchiseeNewsArticle->id }}">
                <div class="news-modal__close"></div>
                <div class="news-modal__img">
                    <picture>
                        <source
                            srcset="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->mobile) }}, {{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->mobile2) }} 2x"
                            media="(max-width: 480px)">
                        <source
                            srcset="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image) }}, {{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image2) }} 2x">
                        <img class="news-modal__image"
                             src="{{ Storage::disk('franchisee_news_images')->url($franchiseeNewsArticle->image) }}"/>
                    </picture>
                </div>
                <div class="news-modal__title-container">
                    <div
                        class="news-modal__date">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->publication_date_text }}</div>
                    <div class="news-modal__title">{{ $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->header }}</div>
                </div>
                <div class="news-modal__text">
                    @php
                        $paragraphs = explode("\n", $franchiseeNewsArticle->franchiseeNewsArticleTexts->first()->text);
                    @endphp
                    @foreach($paragraphs as $paragraph)
                        <div class="news-modal__paragraph">{{ $paragraph }}</div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>

@endif


