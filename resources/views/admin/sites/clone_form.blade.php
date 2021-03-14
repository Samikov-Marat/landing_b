@extends('admin.layout')

@section('header')
    Клонирование сайта {{ $site->domain }}
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => 'Клонировать'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.sites.clone') !!}">
        @csrf

        <input type="hidden" name="id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_domain">Домен (новый)</label>
            <input type="text" class="form-control" name="domain" id="id_domain"
                   value="cdek.ru"
                   placeholder="домен" autocomplete="off">
            <small id="id_domain_help" class="form-text text-muted">Адрес сайта, доменное имя</small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ 'клон ' . $site->name }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название сайта</small>
        </div>

        <div class="form-group">
            <label for="id_name">Можно скопировать 1 язык</label>
            <select class="form-select form-control" name="language_id">
                @foreach($site->languages as $language)
                    <option value="{{ $language->id }}">{{ $language->shortname . ' ' . $language->name }}</option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-primary">Клонировать</button>
    </form>


@endsection
