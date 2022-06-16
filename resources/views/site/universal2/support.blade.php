@extends('site.universal2.layout')

@section('content')
    <div class="support-page screen">

        <div class="content support-page__content  support-page__content_step1">
            <h1 class="typo-h1">@d('support_1')</h1>
            <div class="support-page__contact">
                <div class="support-page__phone">
                    @d('support_2')
                    <a class="support-page__phone-link" href="tel:{{ $dictionary['support_3'] }}">@d('support_4')</a>
                    <div class="support-page__phone-desc">
                        @d('support_5')
                    </div>
                </div>
            </div>
            <div class="support-page__support">
                <div class="feedback">
                    <div class="feedback__heading">@d('support_6')</div>
                    <div class="feedback__text">@d('support_7')
                    </div>
                    <div class="feedback__list preloader js-feedback-preloader">

                        @foreach($supportContainer->supportCategories as $supportCategory)
                            <a class="feedback__category feedback__category_root"
                                 href="{!! route('site.support', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url, 'category' => $supportCategory->id]) !!}">
                                {{ $supportCategory->supportCategoryTexts[0]->name ?? '' }}
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
