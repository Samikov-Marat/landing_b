<div class="question">
    <div class="question__content">
        <div class="question__icon-1">
            <div class="question__icon-2">
                <div class="question__icon-3">?</div>
            </div>
        </div>
        <div class="question__title">@d('any_question_text_1')</div>
        <div class="question__desc">@d('any_question_text_2')</div>
        <div class="question__desc-2">@d('any_question_text_3')</div>

        @php
            $templateGtm = [
                'universal2.index' => 'open_form',
                'universal2.e_commerce' => 'open_form_im',
                'universal2.business' => 'open_form_b2b',
                'universal2.documents' => 'document_open_form'
                ];
            $buttonGtm = $templateGtm[$page->template] ?? '';

            $templateGtmForm = [
                'universal2.documents' => 'document_send_form_bottom'
                ];
            $buttonGtmForm = $templateGtmForm[$page->template] ?? '';
        @endphp

        <a href="#" class="primary-button js-feedback-open gtm-click"
           data-send-form-event="{{ $buttonGtmForm }}"
           data-click="{{$buttonGtm}}">@d('any_question_text_4')</a>
    </div>
</div>
