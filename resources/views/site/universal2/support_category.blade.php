@extends('site.universal2.layout')

@section('content')
    <div class="support-page screen">


        <div class="content support-page__content support-page__content_step2">
            <div class="contact-page__support">

                <div class="bm-breadcrumbs feedback__breadcrumbs">
                    <a class="bm-breadcrumbs__item" href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url]) !!}">@d('support_1')</a>
                    @foreach($supportContainer->path as $supportCategoryInPath)
                        @if ($loop->last)
                            <span class="bm-breadcrumbs__item">{{ $supportCategoryInPath->supportCategoryTexts[0]->name ?? '' }}</span>
                        @else
                            <a class="bm-breadcrumbs__item" href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportCategoryInPath->id]) !!}">{{ $supportCategoryInPath->supportCategoryTexts[0]->name ?? '' }}</a>
                        @endif
                    @endforeach

                </div>

                @php
                    if($supportContainer->path->count() > 1){
                        $prev = $supportContainer->path[$supportContainer->path->count() - 2];
                        $back = route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $prev->id]);
                    }
                    else{
                        $back = route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url]);
                    }
                @endphp

                <div class="feedback__back-holder">
                    <a class="feedback__back-link" href="{!! $back !!}">
                        @d('support_back')
                    </a>
                </div>

                @if(isset($supportContainer->currentSupportCategory))
                    <div class="feedback__heading feedback__heading_mb20">
                        {{ $supportContainer->currentSupportCategory->supportCategoryTexts[0]->name ?? '' }}
                    </div>
                @endif
                @if($supportContainer->supportCategories->isNotEmpty())
                    <div class="feedback__sheet preloader">
                        <div class="feedback__sheet-categories">
                            @foreach($supportContainer->supportCategories as $supportCategory)
                                @if($supportCategory->supportCategoryTexts->isNotEmpty())
                                <div class="feedback__category-outer">
                                    <a class="feedback__category"
                                       href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportCategory->id]) !!}">
                                        {{ $supportCategory->supportCategoryTexts[0]->name ?? '' }}
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($supportContainer->currentSupportCategory) &&
                    $supportContainer->currentSupportCategory->supportQuestions->isNotEmpty())
                    <div class="feedback__sheet preloader js-feedback-preloader">
                        <div class="feedback__sheet-questions">
                            @foreach($supportContainer->currentSupportCategory->supportQuestions as $supportQuestion)
                                <div class="feedback__question-outer">
                                    <a class="feedback__question"
                                       href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportContainer->currentSupportCategory->id, 'question' => $supportQuestion->id]) !!}">
                                        {{ $supportQuestion->supportQuestionTexts[0]->question }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>


    </div>
@endsection
