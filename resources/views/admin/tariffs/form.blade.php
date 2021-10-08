@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariffs.save') !!}">
        {{ csrf_field() }}
        @if(isset($tariff))
            <input type="hidden" name="id" value="{{ $tariff->id }}">
        @endif

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="is_layout" value="1"
                       id="check_is_layout"
                       class="form-check-input js-tariff-is-layout-checkbox"
                       data-tariff_field="#id_tariff">
                <label for="check_is_layout" class="form-check-label">
                    Фрагмент общей части шаблона (шапка, подвал сайта, меню)
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="ek_id">ЭК id</label>
            <input type="text" class="form-control" name="ek_id" id="ek_id"
                   value="{{ isset($tariff) ? $tariff->ek_id : '' }}"
                   placeholder="ЭК id" autocomplete="off"
                   required
                {{ (isset($tariff) && $tariff->is_layout)?'disabled':'' }}>
            <small id="ek_id" class="form-text text-muted">ЭК id</small>
        </div>

        <div class="form-group">
            <label for="tariff_type_id">Тип тарифа</label>
            <input type="text" class="form-control" name="tariff_type_id" id="tariff_type_id"
                   value="{{ isset($tariff) ? $tariff->tariff_type_id : '' }}"
                   placeholder="Тип тарифа" autocomplete="off">
            <small id="tariff_type_id" class="form-text text-muted">Тип тарифа</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
