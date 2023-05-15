@extends('site.universal2.layout')

@section('content')
    <div class="docs-page">
        @include('site.universal2.documents_poster_block')
        <div class="company-advantages screen">
            <div class="content">
                <h2 class="typo-h2 company-advantages__heading docs-page__company-adv-heading">@d('documents_onpagetext_7') <span class="typo-colored_color_green">@d('documents_onpagetext_8')</span></h2>
                <div class="company-advantages__description docs-page__company-adv-description">
                    @d('documents_onpagetext_9')
                </div>
                <div class="two-icons docs-page__company-adv-icons">
                    <div class="two-icons__item two-icons__item_docs">
                        <div class="two-icons__header">
                            @d('document_first_tariff_header')
                        </div>
                        <div class="two-icons__details">
                            <div class="two-icons__icon two-icons__icon_letter"></div>
                            <div class="two-icons__text"><span class="two-icons__text-big">@d('documents_onpagetext_10')</span> @d('documents_onpagetext_11') <span class="two-icons__text-big">@d('documents_onpagetext_12')</span></div>
                        </div>
                    </div>

                    @if (!empty($dictionary['documents_second_tariff_price']))
                        <div class="two-icons__item two-icons__item_docs">
                            <div class="two-icons__header">
                                @d('document_second_tariff_header')
                            </div>
                            <div class="two-icons__details">
                                <div class="two-icons__icon two-icons__icon_letter"></div>
                                <div class="two-icons__text"><span class="two-icons__text-big">@d('documents_second_tariff_weight')</span> @d('documents_onpagetext_11') <span class="two-icons__text-big">@d('documents_second_tariff_price')</span></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="square-cards js-company-advantages owl-carousel">
                    <div class="square-card square-card_size_big square-card_big-icon_person">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('documents_onpagetext_13')</div>
                        <div class="square-card__description">
                            @d('documents_onpagetext_14')
                        </div>
                    </div>
                    <div class="square-card square-card_size_big square-card_big-icon_contract">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('documents_onpagetext_15')</div>
                        <div class="square-card__description">
                            @d('documents_onpagetext_16')
                        </div>
                    </div>
                    <div class="square-card square-card_size_big square-card_big-icon_mail">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('documents_onpagetext_17')</div>
                        <div class="square-card__description">
                            @d('documents_onpagetext_18')
                        </div>
                    </div>
                    <div class="square-card square-card_size_big square-card_big-icon_courier">
                        <div class="square-card__bg"></div>
                        <div class="square-card__title">@d('documents_onpagetext_19')</div>
                        <div class="square-card__description">
                            @d('documents_onpagetext_20')
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="calculator-neutral-bg">
            @include('site.universal2.calculator_block')
        </div>



        @include('site.universal2.order_block', ['orderFormType' => 'documents_order'])

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')


        @include('site.universal2.faq_block')

        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>
@endsection
