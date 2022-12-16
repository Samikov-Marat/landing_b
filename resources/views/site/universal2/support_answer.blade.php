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

                <div class="js-feedback-form-container @if(!$supportContainer->supportQuestion->show_form) hidden @endif">
                    <div class="feedback__form-wrapper">
                        <div class="feedback__form-heading">@d('support_form_header')</div>
                        <div class="feedback__form">
                            <form class="form js-support-form js-support-form-wrapper"  method="post" action="{{ route('request.support') }}">
                                <input type="hidden" name="language_code_iso" value="{{ $language->language_code_iso }}">
                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="name" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_name'] }}" />
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form-field">
                                        <input type="text" name="email" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_email'] }}" />
                                    </div>
                                </div>
                                <div class="form__row form__row_support_radio">
                                    <div class="form-field">
                                        <div class="form-field__label">@d('support_new_have_invoice')</div>
                                        <div class="form-field__choices">
                                            <div class="choice-widget form-field__choices-choice">
                                                <input type="radio" name="have_invoice" value="1" id="invoice-1" class="js-support-have-invoice support-focus-reset-error" /><label for="invoice-1">@d('support_new_have_invoice_yes')</label>
                                            </div>
                                            <div class="choice-widget form-field__choices-choice">
                                                <input type="radio" name="have_invoice" value="0" id="invoice-0" class="js-support-have-invoice support-focus-reset-error" /><label for="invoice-0">@d('support_new_have_invoice_no')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__row js-support-invoice-number-row" style="display: none;">
                                    <div class="form-field">
                                        <input type="text" name="invoice_number" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_invoice_number'] }}" />
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form-field">
                                        <select class="form-field__input js-support-select2 support-focus-reset-error" name="summary" placeholder="{{ $dictionary['support_form_theme'] }}">
                                            <option></option>
                                            @foreach($supportContainer->tree as $category)
                                                @if($category->supportCategoryTexts->isNotEmpty())
                                                <option @if($supportContainer->path[0]->id == $category->id) selected @endif>{{ $category->supportCategoryTexts[0]->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form__row">
                                    <div class="form-field">
                                        <textarea name="question" class="form-field__input support-focus-reset-error" placeholder="{{ $dictionary['support_custom_question'] }}"></textarea>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <input type="submit" value="{{ $dictionary['support_send'] }}" class="primary-button primary-button_submit" />
                                </div>
                            </form>

                            <div class="form-order-docs__result js-support-result-ok-wrapper" style="display: none;">
                                <div class="form-order-docs__result-icon form-order-docs__result-icon_ok"></div>
                                <div class="feedback__heading">
                                    @d('support_success_header')
                                </div>
                                <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">@d('support_success_text')</div>
                                <a href="#" class="alternative-button js-support-new-answer">@d('support_new_more')</a>
                            </div>

                            <div class="form-order-docs__result js-feedback-result-error-wrapper" style="display: none;">
                                <div class="form-order-docs__result-icon form-order-docs__result-icon_error"></div>
                                <div class="feedback__heading">
                                    @d('support_error_header')
                                </div>
                                <div class="form-order-docs__result-text form-order-docs__result-text_small-bottom">
                                    @d('support_error_text')
                                </div>
                                <a href="#" class="alternative-button js-support-retry">@d('support_new_retry')</a>
                            </div>
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
