@extends('admin.layout')

@section('header')
    @isset($topOffice)
        Редактирование избранного офиса
    @else
        Добавление  избранного офиса
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.top_offices.index'), 'text' => 'Избранные офисы'],
        ['text' => isset($topOffice)?'Редактирование':'Добавление'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.top_offices.save') !!}">
        @csrf
        @if(isset($topOffice))
            <input type="hidden" name="id" value="{{ $topOffice->id }}">
        @endif

        <div class="form-group">
            <label for="id_domain">Офис</label>

            <select class="form-select form-control js-top-office-code-search" name="code" data-ajax-url="{!! route('admin.top_offices.search') !!}">
            </select>

            <small id="id_domain_help" class="form-text text-muted">Адрес</small>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
