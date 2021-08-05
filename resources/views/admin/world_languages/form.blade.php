@extends('admin.layout')


@section('header')
    @isset($worldLanguage)
        Редактирование международный язык
    @else
        Добавление международного языка
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.world_languages.index'), 'text' => 'Международные языки'],
        ['text' => isset($worldLanguage)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')

    <form method="post" action="{!! route('admin.world_languages.save') !!}">
        @csrf
        @isset($worldLanguage)
            <input type="hidden" name="id" value="{{ $worldLanguage->id }}">
        @endisset

        <div class="form-group">
            <label for="id_domain">Код автоопределения языка браузера (по ISO 639-1)</label>
            <select class="form-select form-control js-world-languages-code-search" name="language_code_iso"
                    data-ajax-url="{!! route('admin.world_languages.search_iso') !!}">
                @if(isset($worldLanguage) && isset($worldLanguage->languageIso))
                    <option value="{{ $worldLanguage->language_code_iso }}" selected data-old="{{ $worldLanguage->languageIso }}">
                        {{ $worldLanguage->language_code_iso }}
                    </option>
                @endif
            </select>

            <small id="id_domain_help" class="form-text text-muted">ISO код языка</small>
        </div>


        <div class="form-group">
            <label for="id_name">Имя</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($worldLanguage) ? $worldLanguage->name : '' }}"
                   placeholder="Название языка" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Название языка</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
