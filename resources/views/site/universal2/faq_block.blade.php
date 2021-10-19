<div class="faq screen">
    <div class="content faq__container">
        <div class="faq__content">
            <div class="faq__dots-top background-dots background-dots_size_3x8"></div>
            <h2 class="typo-h2 faq__title">@d('faq_header')</h2>
            <div class="submenu faq__submenu">
                <div class="submenu__content">
                    <div class="submenu__item submenu__item_active js-faq-tab" data-for="#faq_shop" data-for2="#faq_button_shop">@d('faq_subheader_shop')</div>
                    <div class="submenu__item js-faq-tab" data-for="#faq_business" data-for2="#faq_button_business">@d('faq_subheader_business')</div>
                </div>
            </div>
            <div class="faq-list faq__faq-list" id="faq_shop">
                <div class="faq-list__faq faq-list__faq_opened">
                    <div class="faq-list__faq-question">@d('faq_shop_question_1')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_1')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_shop_question_2')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_2')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_shop_question_3')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_3')<a href="{!!route('request.images','import_restrictions.pdf')!!}" target="_blank">@d('faq_shop_answer_3_link')</a></div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_shop_question_4')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_4')<a href="{!!route('request.images','prohibited.pdf')!!}" target="_blank">@d('faq_shop_answer_4_link')</a></div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_shop_question_5')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_5')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_shop_question_6')</div>
                    <div class="faq-list__faq-answer">@d('faq_shop_answer_6')</div>
                </div>
            </div>

            <div class="faq-list faq__faq-list hidden" id="faq_business">
                <div class="faq-list__faq faq-list__faq_opened">
                    <div class="faq-list__faq-question">@d('faq_business_question_1')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_1')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_business_question_2')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_2')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_business_question_3')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_3')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_business_question_4')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_4')<a href="{!!route('request.images','prohibited.pdf')!!}" target="_blank">@d('faq_business_answer_4_link')</a></div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_business_question_5')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_5')</div>
                </div>
                <div class="faq-list__faq">
                    <div class="faq-list__faq-question">@d('faq_business_question_6')</div>
                    <div class="faq-list__faq-answer">@d('faq_business_answer_6')</div>
                </div>
            </div>

            @php
                $templateGtm = [
                    'universal2.index' => 'perehod_im',
                    ];
                $buttonGtm = $templateGtm[$page->template] ?? '';
            @endphp

            <div id="faq_button_shop" class="faq__more js-faq_button">
                <a href="{!! route('site.show_page', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => 'e-commerce' ]) !!}"
                   class="primary-button gtm-click"
                   data-click="{{ $buttonGtm }}">@d('faq_detail')</a>
            </div>
            @php
                $templateGtm = [
                    'universal2.index' => 'perehod_b2b',
                    'universal2.e_commerce' => 'perehod_b2b_im',
                    'universal2.business' => 'perehod_b2b_b2b',
                    ];
                $buttonGtm = $templateGtm[$page->template] ?? '';
            @endphp
            <div id="faq_button_business" class="faq__more js-faq_button hidden">
                <a href="{!! route('site.show_page', ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => 'business' ]) !!}"
                   class="primary-button gtm-click"
                   data-click="{{ $buttonGtm }}">@d('faq_detail')</a>
            </div>
        </div>
    </div>
</div>
