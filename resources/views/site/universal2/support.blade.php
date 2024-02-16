@extends('site.universal2.layout')

@section('content')

    <div class="support-page screen">
        <div class="content support-page__content  support-page__content_step1">
            <h1 class="typo-h1 support-page__heading">@d('support_1')</h1>
            @if($dictionary['turkey_support'])
                <div class="contact-page__phone" style="padding-top: 10px; padding-bottom: 20px;">
                    @d('turkey_support') @d('turkey_support_time') <a class="contact-page__link" href="tel:{{ $dictionary['turkey_support_phone'] }}">@d('turkey_support_phone')</a>
                </div>
            @endif


            @include('site.universal2.support_new_form')

            <div class="support-page__support">
                <div class="feedback">
                    <div class="feedback__heading">@d('support_new_list_header_1')</div>
                    <div class="feedback__text">@d('support_new_list_header_2')</div>
                    <div class="feedback__list preloader js-feedback-preloader">
                        @if(isset($supportContainer->specialSupportQuestions[0]))
                            <a class="feedback__category feedback__category_root feedback__category_customer i18n-h"
                               data-click="support_spec-question-sender_client"
                                 href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportContainer->specialSupportQuestions[0]->category_id, 'question' => $supportContainer->specialSupportQuestions[0]->id]) !!}">
                                {{ $supportContainer->specialSupportQuestions[0]->supportQuestionTexts[0]->question }}
                            </a>
                        @endif
                        @if(isset($supportContainer->specialSupportQuestions[1]))
                            <a class="feedback__category feedback__category_root feedback__category_box i18n-h"
                               data-click="support_spec-question-sender_business"
                                 href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportContainer->specialSupportQuestions[1]->category_id, 'question' => $supportContainer->specialSupportQuestions[1]->id]) !!}">
                                {{ $supportContainer->specialSupportQuestions[1]->supportQuestionTexts[0]->question }}
                            </a>
                        @endif


                        @foreach($supportContainer->supportCategories as $supportCategory)
                            @if($supportCategory->supportCategoryTexts->isNotEmpty())
                                <a class="feedback__category feedback__category_root {{ $supportCategory->icon_class }} gtm-click"
                                   data-click="support_category-{{$supportCategory->gtm}}"
                                   href="{!! route('site.support', ['languageUrl' => $language->uri, 'pageUrl' => $page->url, 'category' => $supportCategory->id]) !!}">
                                    {{ $supportCategory->supportCategoryTexts[0]->name ?? '' }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
