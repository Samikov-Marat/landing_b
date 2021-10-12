@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariffs.save') !!}">
        {{ csrf_field() }}
        @if(isset($tariff))
            <input type="hidden" name="id" value="{{ $tariff->id }}">
        @endif

        <div class="form-group">
            <label for="ek_id">ЭК id</label>
            <input type="text" class="form-control" name="ek_id" id="ek_id"
                   value="{{ isset($tariff) ? $tariff->ek_id : '' }}"
                   placeholder="ЭК id" autocomplete="off"
                   required >
            <small id="ek_id" class="form-text text-muted">ЭК id</small>
        </div>

        <div class="form-group">
            <label for="tariff_type_id">Тип тарифа</label>
            @foreach($tariffTypes as $type)
            <input type="radio" class="form-control" name="tariff_type_id" id="tariff_type_id" required
                   value="{{$type['tariff_type_id']}}">
                {{$type['tariff_type_id']}}
            @endforeach
        </div>
        @foreach($tariffTexts as $tariffText)
        <div class="form-group">
            <label for="tariff_type_id">Название</label>
            <input type="text" class="form-control" name="name" id="tariff_type_id"
                   value="{{$tariffText->name}}"
                   placeholder="название" autocomplete="off">
            <small id="tariff_type_id" class="form-text text-muted">название</small>
        </div>
        <div class="form-group">
            <label for="tariff_description_id">Описание</label>
            <input type="text" class="form-control" name="description" id="tariff_description_id"
                   value="{{$tariffText->description}}"
                   placeholder="описание" autocomplete="off">
            <small id="tariff_description_id" class="form-text text-muted">описание</small>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
