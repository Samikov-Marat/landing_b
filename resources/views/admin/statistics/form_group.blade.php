<div class="form-row">
    <div class="form-group col-md-6">
        <label for="id_domain">{{ $formGroupName }}</label>
        <select class="form-select form-control {{ $select2Class }}" name="filter[{{ $utmName }}]"
                data-ajax-url="{!! route($searchRouteName) !!}">
            @if(isset($filter[$utmName]))
                <option value="{{ $filter[$utmName] }}" selected data-old="{{ collect($filter) }}">
                    {{ $filter[$utmName] }}
                </option>
            @endif
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="id_domain">{{ $formGroupName }}</label>
        <div class="form-check">
            <input type="checkbox" name="detail[{{ $utmName }}]" value="1"
                   {{ isset($detail[$utmName]) ? 'checked':'' }} class="form-check-input js-statistics-send-form"
                   id="id_{{ $utmName }}_checkbox">
            <label class="form-check-label" for="id_{{ $utmName }}_checkbox">Детализация</label>
        </div>
    </div>
</div>
