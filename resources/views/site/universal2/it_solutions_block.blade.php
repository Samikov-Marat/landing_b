@if(isset($dictionary['it_solutions_header']) && ($dictionary['it_solutions_header'] != ''))
<div class="it-solutions screen">
    <div class="content">
        <div class="it-solutions__content">
            <div class="it-solutions__left-item">
                <h2 class="typo-h2 it-solutions__heading">@d('it_solutions_header')</h2>
                <div class="it-solutions__left-item-title">@d('it_solutions_list_header')</div>
                <ul class="it-solutions__list">
                    <li class="it-solutions__list-item">@d('it_solutions_3')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_4')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_5')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_6')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_7')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_8')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_9')</li>
                    <li class="it-solutions__list-item">@d('it_solutions_10')</li>
                </ul>
                <a href="https://cdek.ru/ru/integration" class="primary-button primary-button_with_arrow i18n-h it-solutions__primary-button_desktop">@d('it_solutions_button')</a>
            </div>
            <div class="it-solutions__right-item">
                <div class="it-solutions__right-item-content">
                    <div class="it-solutions__right-item-title">
                        @d('it_solutions_image_header')
                    </div>
                    <div class="it-solutions__image-shopify"></div>
                    <div class="it-solutions__image-wordpress"></div>
                </div>
            </div>
            <a href="https://cdek.ru/ru/integration" class="primary-button primary-button_with_arrow i18n-h it-solutions__primary-button_mobile">@d('it_solutions_button')</a>
            <div class="background-dots it-solutions__dots-right"></div>
        </div>
    </div>
</div>
@endif
