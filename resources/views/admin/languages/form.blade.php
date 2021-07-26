@extends('admin.layout')

@section('header')
    @isset($language)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Языки'],
        ['text' => isset($language)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.languages.save') !!}">
        @csrf
        @if(isset($language))
            <input type="hidden" name="id" value="{{ $language->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_shortname">Обозначение</label>
            <input type="text" class="form-control" name="shortname" id="id_shortname"
                   value="{{ isset($language) ? $language->shortname : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_shortname_help" class="form-text text-muted">Обычно 2 буквы. Например, <q>RU</q></small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($language) ? $language->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Полное название языка. Например, <q>Английский язык</q></small>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="rtl" value="1"
                       id="check_rtl" {{ (isset($language) && $language->rtl)?'checked':'' }}
                       class="form-check-input">
                <label for="check_rtl" class="form-check-label">
                    Письмо справа налево (RTL)
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
