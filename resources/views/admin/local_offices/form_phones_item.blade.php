<div class="form-row align-items-center js-local-office-phone-item">
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Форматированный</div>
            </div>
            <input type="text" class="form-control js-local-office-phone-text" placeholder="+0 (000) 000-00-00 "
                   name="{{ $name . '[phone_text]' }}"
                   value="{{ isset($phone) ? $phone->phone_text : '' }}">
        </div>
    </div>
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Международный</div>
            </div>
            <input type="text" class="form-control  js-local-office-phone-value" placeholder="+00000000000"
                   name="{{ $name . '[phone_value]' }}"
                   value="{{ isset($phone) ? $phone->phone_value : '' }}">
        </div>
    </div>
    {{--    <div class="col-auto">--}}
    {{--        <div class="form-check mb-2">--}}
    {{--            <input class="form-check-input" type="checkbox" id="autoSizingCheck">--}}
    {{--            <label class="form-check-label" for="autoSizingCheck">--}}
    {{--                Whatsapp--}}
    {{--            </label>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="col-auto">
        <button type="button" class="btn btn-outline-danger mb-2 js-local-office-phone-delete">
            <i class="fas fa-trash"></i> Удалить
        </button>
    </div>
</div>
