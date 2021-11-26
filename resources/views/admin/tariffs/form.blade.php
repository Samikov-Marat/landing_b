@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariffs.save') !!}">
        {{ csrf_field() }}

        @if($tariff->exists)
            <input type="hidden" name="id" value="{{ $tariff->id }}">
        @endif
        <div class="form-group">
            <label for="ek_id">ЭК id</label>
            <input type="text" class="form-control" name="ek_id" id="ek_id"
                   value="{{ isset($tariff) ? $tariff->ek_id : '' }}"
                   placeholder="ЭК id" autocomplete="off"
                   required>
            <small id="ek_id" class="form-text text-muted">ЭК id</small>
        </div>
        <div class="form-group">
            <label for="tariff_type_id">Тип тарифа</label></br>
            @foreach($tariffTypes as $type)
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="tariff_type_id"
                           id="id_tariff_type_{{ $type->id }}" required
                           value="{{ $type->id }}" {{$tariff->tariff_type_id == $type->id? "checked" : " "}}>
                        <label class="form-check-label" for="id_tariff_type_{{ $type->id }}">
                            {{ $type->name }}
                        </label>
                </div>
            @endforeach
        </div>
        @if($tariff->exists)
            @foreach($tariff->tariffTexts as $tariffText)
                <div class="form-group">
                    <label for="tariff_type_id">Название</label>
                    <input type="text" class="form-control" name="name" id="tariff_type_id" required
                           value="{{ $tariffText->name }}"
                           placeholder="название" autocomplete="off">
                    <small id="tariff_type_id" class="form-text text-muted">название</small>
                </div>
                <div class="form-group">
                    <label for="tariff_description_id">Описание</label>
                    <input type="text" class="form-control" name="description" id="tariff_description_id" required
                           value="{{ $tariffText->description }}"
                           placeholder="описание" autocomplete="off">
                    <small id="tariff_description_id" class="form-text text-muted">описание</small>
                </div>
            @endforeach
        @else
            <div class="form-group">
                <label for="tariff_type_id">Название</label>
                <input type="text" class="form-control" name="name" id="tariff_type_id" required
                       value=""
                       placeholder="название" autocomplete="off">
                <small id="tariff_type_id" class="form-text text-muted">название</small>
            </div>
            <div class="form-group">
                <label for="tariff_description_id">Описание</label>
                <input type="text" class="form-control" name="description" id="tariff_description_id" required
                       value=""
                       placeholder="описание" autocomplete="off">
                <small id="tariff_description_id" class="form-text text-muted">описание</small>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
