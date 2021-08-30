@extends('site.universal2.layout')

@section('content')

    <div class="company-page">
        <div class="company-poster">
            <div class="content">
                <div class="company-poster__content">
                    <h1 class="typo-h1 company-poster__heading">@d('poster_header')</h1>
                    <div class="divider company-poster__divider"></div>
                    <div class="company-poster__text">
                        @d('poster_history')
                    </div>
                </div>
            </div>
        </div>
        <div class="company-grow screen">
            <div class="content">
                <div class="company-grow__content">
                    <h2 class="typo-h2 company-grow__title">@d('grow_header')</h2>
                    <div class="company-grow__inner-content">
                        <div class="company-grow__text">@d('grow_is')</div>
                        <div class="company-grow__cards">
                            <div class="company-grow__card company-grow__card_green">
                                <div class="company-grow__card-num">@d('grow_number_1')</div>
                                <div>@d('grow_text_1')</div>
                            </div>
                            <div class="company-grow__card-empty">
                                <div class="company-grow__card-shadow"></div>
                                <div class="company-grow__card company-grow__card_yellow">
                                    <div class="company-grow__card-num">@d('grow_number_2')</div>
                                    <div>@d('grow_text_2')</div>
                                </div>
                            </div>
                        </div>
                        <div class="company-grow__flags">

                                <div class="company-grow__flag company-grow__flag_country_ru"></div>

                                <div class="company-grow__flag company-grow__flag_country_ua"></div>

                                <div class="company-grow__flag company-grow__flag_country_us"></div>

                                <div class="company-grow__flag company-grow__flag_country_uk"></div>

                                <div class="company-grow__flag company-grow__flag_country_de"></div>

                                <div class="company-grow__flag company-grow__flag_country_kg"></div>

                                <div class="company-grow__flag company-grow__flag_country_kz"></div>

                                <div class="company-grow__flag company-grow__flag_country_by"></div>

                                <div class="company-grow__flag company-grow__flag_country_am"></div>

                                <div class="company-grow__flag company-grow__flag_country_uz"></div>

                                <div class="company-grow__flag company-grow__flag_country_ge"></div>

                                <div class="company-grow__flag company-grow__flag_country_cz"></div>

                                <div class="company-grow__flag company-grow__flag_country_kr"></div>

                                <div class="company-grow__flag company-grow__flag_country_cn"></div>

                                <div class="company-grow__flag company-grow__flag_country_lv"></div>

                                <div class="company-grow__flag company-grow__flag_country_ae"></div>

                                <div class="company-grow__flag company-grow__flag_country_tr"></div>

                                <div class="company-grow__flag company-grow__flag_country_th"></div>

                                <div class="company-grow__flag company-grow__flag_country_az"></div>

                                <div class="company-grow__flag company-grow__flag_country_it"></div>

                        </div>
                        <div class="company-grow__countries">@d('grow_countries')</div>
                    </div>
                </div>
            </div>
            <div class="company-grow__numbers">
                <div class="company-grow__numbers-title">@d('numbers_header')</div>
                <div class="company-grow__numbers-list">
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_office">
                        <div class="company-grow__numbers-item-num">@d('numbers_office_value')</div>
                        <div>@d('numbers_office_text')</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_shop">
                        <div class="company-grow__numbers-item-num">@d('numbers_shop_value')</div>
                        <div>@d('numbers_shop_text')</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_city">
                        <div class="company-grow__numbers-item-num">@d('numbers_city_value')</div>
                        <div>@d('numbers_city_text')</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_package">
                        <div class="company-grow__numbers-item-num">@d('numbers_package_value')</div>
                        <div>@d('numbers_package_text')</div>
                    </div>
                    <div class="company-grow__numbers-item company-grow__numbers-item_icon_world">
                        <div class="company-grow__numbers-item-num">@d('numbers_world_value')</div>
                        <div>@d('numbers_world_text')</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="company-advantages screen-content">
    <h2 class="typo-h2 company-advantages__heading">@d('advantages_header')</h2>
    <div class="company-advantages__description">
        @d('advantages_text')
    </div>
    <div class="square-cards js-company-advantages owl-carousel">
        <div class="square-card square-card_icon_customs">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('card_1_header')</div>
            <div class="square-card__description">
                @d('card_1_text_1') <span class="typo-bold">@d('card_1_text_2')</span> @d('card_1_text_3')
            </div>
        </div>
        <div class="square-card square-card_icon_settings">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('card_2_header')</div>
            <div class="square-card__description">
                @d('card_2_text_1') <span class="typo-bold">@d('card_2_text_2')</span>@d('card_2_text_3')
            </div>
        </div>
        <div class="square-card square-card_icon_protect">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('card_3_header')</div>
            <div class="square-card__description">
                @d('card_3_text_1') <span class="typo-bold">@d('card_3_text_2')</span>
            </div>
        </div>
        <div class="square-card square-card_icon_lorry">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('card_4_header')</div>
            <div class="square-card__description">
                @d('card_4_text_1') <span class="typo-bold">@d('card_4_text_2')</span>
            </div>
        </div>
        <div class="square-card square-card_icon_parcels">
            <div class="square-card__bg"></div>
            <div class="square-card__title">@d('card_5_header')</div>
            <div class="square-card__description">
                @d('card_5_text_1') <span class="typo-bold">@d('card_5_text_2')</span> @d('card_5_text_3') <span class="typo-bold">@d('card_5_text_4')</span>
            </div>
        </div>
    </div>
</div>

        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>

@endsection
