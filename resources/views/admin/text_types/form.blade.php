@extends('admin.layout')
@section('buttons')
@endsection


@section('content')

    <h2>Тексты страницы <q>{{ $page->name }}</q></h2>
    <h3>
    @if(isset($textType))
        Редактирование
    @else
        Добавление
    @endif
    </h3>

    <form method="post" action="{!! route('admin.text_types.save') !!}">
        @csrf
        @if(isset($textType))
            <input type="hidden" name="id" value="{{ $textType->id }}">
        @endif
        <input type="hidden" name="page_id" value="{{ $page->id }}">

        <div class="form-group">
            <label for="id_shortname">Обозначение</label>
            <input type="text" class="form-control" name="shortname" id="id_shortname"
                   value="{{ isset($textType) ? $textType->shortname : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_shortname_help" class="form-text text-muted">Например, <q>main.banner.header</q> </small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($textType) ? $textType->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Полное название языка. Например, <q>Английский язык</q></small>
        </div>

        <div class="form-group">
            <label for="id_default_value">Значение по умолчанию</label>
            <textarea class="form-control" id="id_default_value" name="default_value" rows="7">{{ isset($textType) ? $textType->default_value : '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
