<form action="{{ config('') }}" method="post" class="js-tracking-form">
    <input type="hidden" name="lang" value="eng">
    <div class="office-page-track__content">
        <div class="office-page-track__title">@d('personal_110')</div>
        <div class="office-page-track__form">
            <div class="form__row office-page-track__input-row">
                <div class="form-field">
                    <input type="text" name="order" value="#52712"
                           class="form-field__input office-page-track__input"
                           autocomplete="off"
                           placeholder="Укажите код груза"/>
                </div>
            </div>
            <div class="form__row office-page-track__input-row">
                <div class="form-field">
                    <input type="text" name="phone" value="9127"
                           class="form-field__input office-page-track__input"
                           autocomplete="off"
                           placeholder="Последние 4 цифры номера телефона получателя"/>
                </div>
            </div>
            <div class="form__row">
                <input type="submit" class="office-page-track__submit"/>
            </div>
        </div>
    </div>

    <div class="js-tracking-table">
        <table>

        </table>
    </div>

</form>
