<div class="main-poster index-page__poster screen">
    <div class="main-poster__content">
        <div class="main-poster__heading index-page__poster-heading">
            <h1 class="typo-h1">@d('delivery_from')</h1> <span class="main-poster__heading-added typo-h1">@d('delivery_from_price')</span>
        </div>
        <div class="circle-icon-list main-poster__icons">
            <div class="circle-icon circle-icon_icon_cart circle-icon-list__icon"></div>
            <div class="circle-icon circle-icon_icon_business circle-icon-list__icon"></div>
        </div>
        <div class="main-poster__text">
            @d('delivery_list')
        </div>
        <a href="#calculator" class="primary-button primary-button_with_arrow gtm-click"
           data-click="rassitat">@d('delivery_calculate')</a>
        <div class="background-dots main-poster__dots-left"></div>
        <div class="main-poster__wave-right"></div>
    </div>
    <picture  class="index-page__poster-image-wrapper">
        <source srcset="/request/images/index/poster-mobile.jpg, /request/images/index/poster-mobile-2x.jpg 2x">
        <img src="/request/images/index/poster-mobile.jpg" alt="" class="index-page__poster-image">
    </picture>
</div>
