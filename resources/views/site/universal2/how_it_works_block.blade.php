@php
    $modeBusiness = false;
@endphp

<div class="how-it-works">
    <h2 class="typo-h2 how-it-works__title">Как это работает?</h2>
    <div class="submenu submenu_centered how-it-works__submenu">
        <div class="submenu__content">
            <div class="submenu__item @if(!$modeBusiness)submenu__item_active @endif js-how-it-works-tab" data-for="commerce">Интернет магазинам</div>
            <div class="submenu__item @if($modeBusiness)submenu__item_active @endif js-how-it-works-tab" data-for="business">Корпоративным клиентам</div>
        </div>
    </div>
    <div class="content">
        <div class="how-it-works__content index-page__how-it-works-content @if($modeBusiness)hidden @endif js-how-it-works-content"  data-for="commerce">
            <div class="index-page__how-it-works-dots background-dots"></div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_contract"></div>
                </div>
                <div class="how-it-works__item-num">1.</div>
                <div class="how-it-works__item-text">@d('how_text_c1')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_lorry"></div>
                </div>
                <div class="how-it-works__item-num">2.</div>
                <div class="how-it-works__item-text">@d('how_text_c2')</div>
            </div>
            <div class="how-it-works__item how-it-works__item_no-margin">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_stock"></div>
                </div>
                <div class="how-it-works__item-num">3.</div>
                <div class="how-it-works__item-text">@d('how_text_c3')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_phone"></div>
                </div>
                <div class="how-it-works__item-num">4.</div>
                <div class="how-it-works__item-text">@d('how_text_c4')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_got"></div>
                </div>
                <div class="how-it-works__item-num">5.</div>
                <div class="how-it-works__item-text">@d('how_text_c5')</div>
            </div>
        </div>


        <div class="how-it-works__content business-page__how-it-works-content @if(!$modeBusiness)hidden @endif js-how-it-works-content" data-for="business">
            <div class="business-page__how-it-works-dots background-dots"></div>
            <div class="how-it-works__item business-page__how-it-works-left-item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_operator"></div>
                </div>
                <div class="how-it-works__item-num">1.</div>
                <div class="how-it-works__item-text">@d('how_text_b1')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_track"></div>
                </div>
                <div class="how-it-works__item-num">2.</div>
                <div class="how-it-works__item-text">@d('how_text_b2')</div>
            </div>
            <div class="how-it-works__item how-it-works__item_no-margin">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_into-box"></div>
                </div>
                <div class="how-it-works__item-num">3.</div>
                <div class="how-it-works__item-text">@d('how_text_b3')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_phone"></div>
                </div>
                <div class="how-it-works__item-num">4.</div>
                <div class="how-it-works__item-text">@d('how_text_b4')</div>
            </div>
            <div class="how-it-works__item">
                <div class="how-it-works__item-icon-container">
                    <div class="how-it-works__item-icon how-it-works__item-icon_icon_got"></div>
                </div>
                <div class="how-it-works__item-num">5.</div>
                <div class="how-it-works__item-text">@d('how_text_b5')</div>
            </div>
        </div>
    </div>
</div>