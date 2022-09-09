@extends('site.universal2.layout')

@section('content')

    <div class="support-page screen">
        <div class="content support-page__content  support-page__content_step1">
            <h1 class="typo-h1 support-page__heading">@d('support_1')</h1>

            @include('site.universal2.support_new_form')

            <div class="support-page__support">
                <div class="feedback">
                    <div class="feedback__heading">@d('support_new_list_header_1')</div>
                    <div class="feedback__text">@d('support_new_list_header_2')</div>
                    <div class="feedback__list preloader js-feedback-preloader">
                        @foreach($supportContainer->supportCategories as $supportCategory)
                            <a class="feedback__category feedback__category_root {{ $supportCategory->icon_class }}"
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
