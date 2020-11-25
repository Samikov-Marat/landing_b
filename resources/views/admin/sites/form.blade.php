@extends('admin.layout')

@section('header')
    @if(isset($site))
        Редактирование сайта
    @else
        Добавление сайта
    @endif
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => isset($site)?'Редактирование':'Добавление'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.sites.save') !!}">
        @csrf
        @if(isset($site))
            <input type="hidden" name="id" value="{{ $site->id }}">
        @endif

        <div class="form-group">
            <label for="id_domain">Домен</label>
            <input type="text" class="form-control" name="domain" id="id_domain"
                   value="{{ isset($site) ? $site->domain : '' }}"
                   placeholder="домен" autocomplete="off">
            <small id="id_domain_help" class="form-text text-muted">Адрес сайта, доменное имя</small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($site) ? $site->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название сайта</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
