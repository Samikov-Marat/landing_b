@extends('admin.layout')

@section('header')
    @isset($topOfficeWorldLanguage->exists)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.top_offices.index'), 'text' => 'Международные офисы'],
        ['href' => route('admin.top_office_world_languages.index', ['top_office_id' => $topOfficeWorldLanguage->topOffice->id]), 'text' => $topOfficeWorldLanguage->topOffice->office->name],
        ['text' => 'Переводы'],
        ['text' => $topOfficeWorldLanguage->worldLanguage->name],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.top_office_world_languages.save') !!}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="top_office_id" value="{{ $topOfficeWorldLanguage->top_office_id }}">
        <input type="hidden" name="world_language_id" value="{{ $topOfficeWorldLanguage->world_language_id }}">

        <div class="form-group">
            <label for="id_country">
                Страна.
                @if('' != $topOfficeWorldLanguage->topOffice->office->country_code_iso)
                    Известен код "{{ $topOfficeWorldLanguage->topOffice->office->country_code_iso }}"
                @endif
            </label>
            <input type="text" class="form-control" name="country" id="id_country"
                   value="{{ $topOfficeWorldLanguage->exists ? $topOfficeWorldLanguage->country : '' }}"
                   placeholder="Страна, в которой находится офис" autocomplete="off">
            <small id="id_country_help" class="form-text text-muted">Страна, в которой находится офис</small>
        </div>

        <div class="form-group">
            <label for="id_name">{{ $topOfficeWorldLanguage->topOffice->office->name }}</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ $topOfficeWorldLanguage->exists ? $topOfficeWorldLanguage->name : '' }}"
                   placeholder="Название офиса" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Название офиса</small>
        </div>

        <div class="form-group">
            <label for="id_full_address">{{ $topOfficeWorldLanguage->topOffice->office->full_address }}</label>
            <input type="text" class="form-control" name="full_address" id="id_full_address"
                   value="{{ $topOfficeWorldLanguage->exists ? $topOfficeWorldLanguage->full_address : '' }}"
                   placeholder="Полный адрес" autocomplete="off">
            <small id="id_full_address_help" class="form-text text-muted">Полный адрес</small>
        </div>

        <div class="form-group">
            <label for="id_address_comment">{{ $topOfficeWorldLanguage->topOffice->office->address_comment }}</label>
            <input type="text" class="form-control" name="address_comment" id="id_address_comment"
                   value="{{ $topOfficeWorldLanguage->exists ? $topOfficeWorldLanguage->address_comment : '' }}"
                   placeholder="Дополнительная информация" autocomplete="off">
            <small id="id_address_comment_help" class="form-text text-muted">Дополнительная информация</small>
        </div>

        <div class="form-group">
            <label for="id_work_time">{{ $topOfficeWorldLanguage->topOffice->office->work_time }}</label>
            <input type="text" class="form-control" name="work_time" id="id_work_time"
                   value="{{ $topOfficeWorldLanguage->exists ? $topOfficeWorldLanguage->work_time : '' }}"
                   placeholder="Время работы" autocomplete="off">
            <small id="id_work_time_help" class="form-text text-muted">Время работы</small>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
