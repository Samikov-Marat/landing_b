@extends('site.universal2.layout')

@section('content')

    <div class="support-page screen">

        <div class="content support-page__content  support-page__content_step4">
            <div class="bm-breadcrumbs feedback__breadcrumbs">
                <a class="bm-breadcrumbs__item" href="{!! route('site.support', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url]) !!}">@d('support_1')</a>
                @foreach($supportContainer->path as $supportCategoryInPath)
                    <a class="bm-breadcrumbs__item" href="{!! route('site.support', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url, 'category' => $supportCategoryInPath->id]) !!}">{{ $supportCategoryInPath->supportCategoryTexts[0]->name ?? '' }}</a>
                @endforeach
                <span class="bm-breadcrumbs__item">{{ $supportContainer->supportQuestion->supportQuestionTexts[0]->question }}</span>
            </div>


            @php
                if($supportContainer->path->count() > 0){
                    $prev = $supportContainer->path->last();
                    $back = route('site.support', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url, 'category' => $prev->id]);
                }
                else{
                    $back = route('site.support', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url]);
                }
            @endphp
            <div class="feedback__back-holder">
                <a class="feedback__back-link" href="{!! $back !!}">
                    @d('support_back')
                </a>
            </div>

            <div class="feedback__heading feedback__heading_mb20">
                {{ $supportContainer->supportQuestion->supportQuestionTexts[0]->question }}
            </div>
            <div class="feedback__sheet preloader js-feedback-preloader">
                <div class="feedback__sheet-text">
                    <div class="editorjs-view">
                        {!! Markdown::parse($supportContainer->supportQuestion->supportQuestionTexts[0]->answer ?? '') !!}
                    </div>
                </div>

            @if(!$supportContainer->supportQuestion->show_form)
                <div class="js-feedback-post-control">
                    <div class="feedback__confirm">
                        <div class="feedback__confirm-title">@d('support_8')</div>
                        <div class="feedback__confirm-buttons">
                            <button
                                    class="primary-button feedback__confirm-button js-answer-button-yes">@d('support_yes')</button>
                            <button
                                    class="alternative-button feedback__confirm-button js-answer-button-no" style="background: white;">@d('support_no')</button>
                        </div>
                    </div>
                </div>
            @endif

                <div class="feedback__form-container js-feedback-form-container @if(!$supportContainer->supportQuestion->show_form) hidden @endif">
                    <div class="feedback__form-wrapper js-support-form-wrapper">
                        <div class="feedback__form-heading">@d('support_form_header')</div>
                        <div class="feedback__form">
                            <form class="form js-support-form" method="post" action="{{ route('request.support') }}">
                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="name" class="form-field__input" placeholder="{{ $dictionary['support_name'] }}"/>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="phone" class="form-field__input"
                                               placeholder="{{ $dictionary['support_phone'] }}"/>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="email" class="form-field__input" placeholder="{{ $dictionary['support_email'] }}"/>
                                    </div>
                                </div>


                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="invoice_number" class="form-field__input"
                                               placeholder="Номер накладной"/>
                                        <div class="form-field__error-message">Номер накладной состоит из 10 цифр</div>
                                    </div>
                                </div>



                                <div class="form__row">
                                    <div class="form-field">
                                        <select class="form-field__input js-support-select2" name="summary" placeholder="Тема вопроса">
                                            <option></option>
                                            @foreach($supportContainer->tree as $category)
                                                @include('site.universal2.support_optgroup', ['category' => $category, 'level' => 0])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form__row">
                                    <div class="form-field">
                                        <textarea name="question" class="form-field__input"
                                                  placeholder="{{ $dictionary['support_custom_question'] }}"></textarea>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <input type="submit" value="{{ $dictionary['support_send'] }}"
                                           class="primary-button primary-button_wide primary-button_submit"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="hidden feedback__result-container js-support-result-ok-wrapper" style="display: none;">
                        <div class="feedback__result-title">@d('support_success_header')</div>
                        <div class="feedback__result feedback__result_success">
                            @d('support_success_text')
                        </div>
                    </div>
                    <div class="hidden feedback__result-container js-feedback-result-error-wrapper"
                         style="display: none;">
                        <div class="feedback__result-title">@d('support_error_header')</div>
                        <div class="feedback__result feedback__result_error">
                            @d('support_error_text')
                        </div>
                    </div>
                </div>





                <div class="feedback__confirm js-feedback-glad-to-help" style="display: none;">
                    <div class="feedback__confirm-title">@d('support_enough')</div>
                </div>
            </div>
        </div>
    </div>
@endsection
