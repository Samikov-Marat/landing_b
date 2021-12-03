<form action="{{ config('app.tracking_api_url') }}" method="post" class="js-tracking-form" data-tracking-event="track_form">
    <input type="hidden" name="lang" value="{{ $dictionary['personal_tracking_language'] }}">
    <div class="office-page-track__content">
        <div class="office-page-track__item">
            <div class="office-page-track__title">@d('personal_110')</div>
            <div class="office-page-track__form">
                <div class="form__row office-page-track__input-row">
                    <div class="form-field ">
                        <input type="text" name="order" class="form-field__input office-page-track__input js-tracking-order-number"
                               placeholder="{{ $dictionary['personal_tracking_order_number'] }}"/>
                        <div class="form-field__error-message">@d('personal_tracking_2')</div>
                    </div>
                </div>
                <div class="form__row">
                    <input type="submit" class="office-page-track__submit" value=""/>
                </div>
            </div>


            <div class="office-page-track__more hidden js-tracking-phone-postfix">
                <div class="office-page-track__state">
                    <div class="office-page-track__more-title">
                        @d('personal_tracking_3')
                    </div>
                    <div class="office-page-track__more-text office-page-track__more-text_desktop">
                        @d('personal_tracking_4')
                    </div>
                </div>
                <div class="office-page-track__more-text office-page-track__more-text_mobile">
                    @d('personal_tracking_5')
                </div>
                <div class="office-page-track__more-phone">
                    <div class="form-field">
                        <input type="text" name="phone" maxlength="4" class="form-field__input office-page-track__more-phone-input js-tracking-receiver-phone" disabled>
                        <div class="form-field__error-message">@d('personal_tracking_6')</div>
                    </div>
                    <div class="form__row">
                        <input type="submit" class="office-page-track__submit office-page-track__submit_arrow"
                               value=""/>
                    </div>
                </div>
            </div>


            <div class="office-page-track__state office-page-track__state_not-found hidden js-tracking-error">
                @d('personal_tracking_7')
            </div>


            <div class="office-page-track__state office-page-track__state_error hidden js-tracking-request-error">
                @d('personal_tracking_8')
            </div>


        </div>
        <div class="office-page-track__form-information hidden js-tracking-result">
            <div class="office-page-track__form-information-subtitle">@d('personal_tracking_9')</div>
            <div class="office-page-track__form-information-direction">
                <div class="office-page-track__form-information-item">
                    <div class="office-page-track__form-information-text">@d('personal_tracking_10')</div>
                    <div class="office-page-track__form-information-city-content">
                        <div class="office-page-track__form-information-city js-tracking-from-city">---</div>
                        <div class="office-page-track__form-information-date js-tracking-from-date">00.00.0000</div>
                    </div>
                </div>
                <div class="office-page-track__form-information-item">
                    <div class="office-page-track__form-information-text">@d('personal_tracking_13')</div>
                    <div class="office-page-track__form-information-city-content">
                        <div class="office-page-track__form-information-city js-tracking-to-city">---</div>
                        <div class="office-page-track__form-information-date js-tracking-to-date">00.00.0000</div>
                    </div>
                </div>
            </div>
            <div class="office-page-track__form-information-status">
                @d('personal_tracking_16') <span class="typo-colored typo-colored_color_green js-tracking-status">@d('personal_tracking_17')</span>
            </div>
            <button type="button" class="office-page-track__form-detail-button js-tracking-show-details" href="#">@d('personal_tracking_18')</button>
            <div class="office-page-track__form-detail js-tracking-detail-block hidden">
                <div class="office-page-track__form-detail-title">@d('personal_tracking_19')</div>

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
                            <div class="office-page-track__form-detail-date js-tracking-detail-date">дата начала</div>
                            <div class="office-page-track__form-detail-status js-tracking-detail-status">статус</div>
                            <div class="office-page-track__form-detail-city js-tracking-detail-city">город</div>
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
                            <div class="office-page-track__form-detail-date js-tracking-detail-date">дата окончания</div>
                            <div class="office-page-track__form-detail-status js-tracking-detail-status">статус</div>
                            <div class="office-page-track__form-detail-city js-tracking-detail-city">Город, место</div>
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
