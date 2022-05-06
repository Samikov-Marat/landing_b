<div class="yellow-line">
    <div class="yellow-line__content">
        <div class="yellow-line__text">

            @d('antifraud_text_1') <span class="typo-bold">@d('antifraud_text_2')</span>
            @d('antifraud_text_3')
            <span class="typo-bold">@d('antifraud_text_4')</span>
        </div>
        <div class="yellow-line__text">
            @d('antifraud_text_5')
            <a class="yellow-line__link" href="tel:{{ $dictionary['antifraud_phone_1_value'] }}">@d('antifraud_phone_1_value')</a>,
            <a class="yellow-line__link" href="tel:{{ $dictionary['antifraud_phone_2_value'] }}">@d('antifraud_phone_2_value')</a>
        </div>
    </div>
</div>

@if(!Cookie::has('antifraud'))
<div class="modal-container">
    <div class="modal modal_size_m" id="antifraud">
        <div class="modal__close modal__close_inside"></div>
        <div class="modal__image-bank-card"></div>
        <div class="modal__heading modal__heading_size_m">@d('antifraud_text_1') </div>
        <div class="modal__text">
            @d('antifraud_text_2') <br/>
            @d('antifraud_text_3') <br/>
            <span class="typo-bold">@d('antifraud_text_4')</span>
        </div>
        <div class="modal__text">
            @d('antifraud_text_5') <br />
            <a class="modal__modal-link" href="tel:{{ $dictionary['antifraud_phone_1_value'] }}">@d('antifraud_phone_1_value')</a>,
            <a class="modal__modal-link" href="tel:{{ $dictionary['antifraud_phone_2_value'] }}">@d('antifraud_phone_2_value')</a>.
        </div>
    </div>
</div>
@endif
