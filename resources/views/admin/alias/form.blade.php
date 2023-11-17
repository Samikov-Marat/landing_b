@extends('admin.layout')

@section('header')
    @if($alias->exists)
        Редактирование псевдонима
    @else
        Добавление псевдонима
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.aliases.index'), 'text' => 'Псевдонимы'],
        ['text' => $alias->exists?'Редактирование':'Добавление'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.aliases.save') !!}">
        @csrf
        @if($alias->exists)
            <input type="hidden" name="id" value="{{ $alias->id }}">
        @endif

        <div class="form-group">
            <label for="id_site_id">Сайт</label>

            <select class="form-select form-control js-alias-site-search" name="site_id"
                    data-ajax-url="{!! route('admin.aliases.search_sites') !!}">
                @if($alias->exists)
                    <option value="{{ $alias->site_id }}" selected data-old="{{ $alias->site }}">
                        {{ $alias->name }}
                    </option>
                @endif
            </select>

            <small id="id_site_id_help" class="form-text text-muted">Сайт</small>
        </div>
        <div class="form-group">
            <label for="id_name">Псевдоним</label>
            <input type="text" class="form-control" name="domain" id="id_domain"
                   value="{{ $alias->exists ? $alias->domain : '' }}"
                   placeholder="Домен-псевдоним" autocomplete="off">
            <small id="id_domain_help" class="form-text text-muted">Домен-псевдоним</small>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="public" value="1"
                       id="check_public" {{ ($alias->exists && $alias->public)?'checked':'' }}
                       class="form-check-input">
                <label for="check_public" class="form-check-label">
                    Публичный (не требует авторизации)
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
