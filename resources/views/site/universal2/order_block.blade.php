<div class="form-order-docs screen">
    <div class="form-order-docs__bg">
        <div class="content">
            <div class="form-order-docs__content">
                <div class="form-order-docs__title">
                    @d('order_form_header')
                </div>
                <div class="form">
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="name" class="form-field__input" placeholder="Имя" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="phone" class="form-field__input" placeholder="Телефон" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="email" class="form-field__input" placeholder="E-mail" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="org" class="form-field__input" placeholder="Наименование организации" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_from" class="form-field__input" placeholder="Страна отправителя" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_to" class="form-field__input" placeholder="Страна получателя" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="country_to" class="form-field__input" placeholder="Свой вариант страны получателя" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <textarea name="items_description" class="form-field__input" placeholder="Описание товаров"></textarea>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="items_link" class="form-field__input" placeholder="Ссылка на товар в интернете" />
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form-field">
                            <input type="text" name="items_cost" class="form-field__input" placeholder="Стоимость товаров в партии" />
                        </div>
                    </div>
                    <div class="form__row form__row_no-input">
                        <div class="checkbox-widget">
                            <input type="checkbox" name="agree" id="modal-agree" /><label for="modal-agree"><span>Я соглашаюсь с <a class="checkbox-widget__link" href="#">условиями обработки персональных данных</a></span></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <input type="submit" value="Отправить заявку" class="primary-button primary-button_wide primary-button_submit" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
