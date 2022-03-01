@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariff_types.save') !!}">
        {{ csrf_field() }}

        @if($tariffType->exists)
            <input type="hidden" name="id" value="{{ $tariffType->id }}">
        @endif
        <div class="form-group">
            <label for="ek_id">ЭК id</label>
            <input type="text" class="form-control" name="ek_id"
                   value="{{ isset($tariffType) ? $tariffType->ek_id : '' }}"
                   placeholder="ЭК id" autocomplete="off"
                   required>
            <small class="form-text text-muted">ЭК id</small>
        </div>
        <div class="form-group">
            <label for="ek_id">Тип тарифа</label>
            <input type="text" class="form-control" name="name"
                   value="{{ isset($tariffType) ? $tariffType->name: '' }}"
                   placeholder="Тип тарифа" autocomplete="off"
                   required>
            <small class="form-text text-muted">Тип тарифа</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
