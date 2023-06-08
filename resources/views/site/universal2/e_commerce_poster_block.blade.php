<div class="main-poster e-commerce-page__poster screen">
    <div class="main-poster__content">
        <div class="main-poster__heading e-commerce-page__heading">
            <h1 class="typo-h1">@d('delivery_header')</h1>
        </div>
        <div class="circle-icon-list main-poster__icons">
            <div class="circle-icon circle-icon_icon_courier circle-icon-list__icon"></div>
            {{-- <div class="circle-icon circle-icon_icon_ru circle-icon-list__icon"></div> --}}
            <div class="circle-icon circle-icon_icon_calendar circle-icon-list__icon"></div>
        </div>
        <div class="main-poster__text">
            @d('delivery_list')
        </div>
        <a href="#calculator" class="primary-button primary-button_with_arrow gtm-click"
           data-click="rassitat_im">@d('delivery_button')</a>
        <div class="background-dots main-poster__dots-left"></div>
        <div class="main-poster__wave-right"></div>
    </div>
</div>
