<form action="{{ config('tracking_api_url') }}" method="post" class="js-tracking-form">
    <input type="hidden" name="lang" value="eng">
    <div class="office-page-track__content">
        <div class="office-page-track__item">
            <div class="office-page-track__title">@d('personal_110')</div>
            <div class="office-page-track__form">
                <div class="form__row office-page-track__input-row">
                    <div class="form-field ">
                        <input type="text" name="order" class="form-field__input office-page-track__input js-tracking-order-number"
                               placeholder="Укажите номер заказа"/>
                        <div class="form-field__error-message">Заполните поле</div>
                    </div>
                </div>
                <div class="form__row">
                    <input type="submit" class="office-page-track__submit" value="Поиск"/>
                </div>
            </div>


            <div class="office-page-track__more hidden js-tracking-phone-postfix">
                <div class="office-page-track__state">
                    <div class="office-page-track__more-title">
                        Найдено более одного заказа
                    </div>
                    <div class="office-page-track__more-text office-page-track__more-text_desktop">
                        Для поиска вашего заказа введите четыре последние цифры номера телефона получателя
                    </div>
                </div>
                <div class="office-page-track__more-text office-page-track__more-text_mobile">
                    Для поиска вашего заказа введите четыре последние цифры номера телефона получателя
                </div>
                <div class="office-page-track__more-phone">
                    <div class="form-field form-field_error">
                        <input type="text" name="phone" class="form-field__input office-page-track__more-phone-input js-tracking-receiver-phone" disabled>
                        <div class="form-field__error-message">Заполните поле</div>
                    </div>
                    <div class="form__row">
                        <input type="submit" class="office-page-track__submit office-page-track__submit_arrow"
                               value=""/>
                    </div>
                </div>
            </div>


            <div class="office-page-track__state office-page-track__state_not-found hidden js-tracking-error">
                Ошибка
            </div>


            <div class="office-page-track__state office-page-track__state_error hidden js-tracking-request-error">
                Возникла ошибка при обработке запроса
            </div>


        </div>
        <div class="office-page-track__form-information hidden js-tracking-result">
            <div class="office-page-track__form-information-subtitle">Информация об отправке</div>
            <div class="office-page-track__form-information-direction">
                <div class="office-page-track__form-information-item">
                    <div class="office-page-track__form-information-text">Откуда:</div>
                    <div class="office-page-track__form-information-city-content">
                        <div class="office-page-track__form-information-city js-tracking-from-city">---</div>
                        <div class="office-page-track__form-information-date js-tracking-from-date">00.00.0000</div>
                    </div>
                </div>
                <div class="office-page-track__form-information-item">
                    <div class="office-page-track__form-information-text">Куда:</div>
                    <div class="office-page-track__form-information-city-content">
                        <div class="office-page-track__form-information-city js-tracking-to-city">---</div>
                        <div class="office-page-track__form-information-date js-tracking-to-date">00.00.0000</div>
                    </div>
                </div>
            </div>
            <div class="office-page-track__form-information-status">
                Статус доставки: <span class="typo-colored typo-colored_color_green js-tracking-status">Вручен</span>
            </div>
            <a class="office-page-track__form-detail-button js-tracking-show-details" href="#">Детали доставки</a>
            <div class="office-page-track__form-detail js-tracking-detail-block hidden">
                <div class="office-page-track__form-detail-title">Детали доставки</div>

                <!-- Блок шаблонов -->
                <div class="office-page-track__form-detail-items-template js-tracking-detail-templates hidden">
                    <div class="office-page-track__form-detail-item js-tracking-detail-template-normal">
                        <div class="office-page-track__form-detail-circle-wrapper">
                            <div class="office-page-track__form-detail-circle">
                                <div class="office-page-track__form-detail-circle-small"></div>
                            </div>
                            <div class="office-page-track__form-detail-line"></div>
                        </div>
                        <div class="office-page-track__form-detail-description">
                            <div class="office-page-track__form-detail-date js-tracking-detail-date">12.04.2021</div>
                            <div class="office-page-track__form-detail-status js-tracking-detail-status">Отправлен в транзитный город</div>
                            <div class="office-page-track__form-detail-city js-tracking-detail-city">Таможенное оформление (МСК)</div>
                        </div>
                    </div>
                    <div class="office-page-track__form-detail-item office-page-track__form-detail-item_done js-tracking-detail-template-finish">
                        <div class="office-page-track__form-detail-circle-wrapper">
                            <div class="office-page-track__form-detail-circle">
                                <div class="office-page-track__form-detail-circle-small"></div>
                            </div>
                            <div class="office-page-track__form-detail-line"></div>
                        </div>
                        <div class="office-page-track__form-detail-description">
                            <div class="office-page-track__form-detail-date js-tracking-detail-date">15.04.2021</div>
                            <div class="office-page-track__form-detail-status js-tracking-detail-status">Вручен</div>
                            <div class="office-page-track__form-detail-city js-tracking-detail-city">Петрозаводск</div>
                        </div>
                    </div>
                </div>
                <!-- /Блок шаблонов -->

                <div class="office-page-track__form-detail-items js-tracking-detail-items">
                </div>

            </div>
        </div>


    </div>
</form>
