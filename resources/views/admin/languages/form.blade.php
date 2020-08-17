@extends('admin.layout')
@section('buttons')
@endsection


@section('content')

    <h2>{{ $site->domain }} <small>{{ $site->name }}</small></h2>
    <h3>
    @if(isset($language))
        Редактирование
    @else
        Добавление
    @endif
    </h3>

    <form method="post" action="{!! route('admin.languages.save') !!}">
        @csrf
        @if(isset($language))
            <input type="hidden" name="id" value="{{ $language->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_shortname">Обозначение</label>
            <input type="text" class="form-control" name="shortname" id="id_shortname"
                   value="{{ isset($language) ? $language->shortname : '' }}" placeholder="Обозначение">
            <small id="id_shortname_help" class="form-text text-muted">Обычно 2 буквы. Например, <q>RU</q></small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($language) ? $language->name : '' }}"
                   placeholder="название">
            <small id="id_name_help" class="form-text text-muted">Полное название языка. Например, <q>Английский язык</q></small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
