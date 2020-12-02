@extends('admin.layout')


@section('header')
    Тексты сайта
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Тексты'],
    ]])
@endsection

@section('content')

    <form>
        <div class="input-group input-group-lg mx-sm-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" class="form-control js-admin-texts-filter">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary js-admin-texts-filter-clear" type="button">Очистить
                </button>
            </div>
        </div>
    </form>

    @if($site->pages->isNotEmpty() && $site->languages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                @foreach($site->languages as $language)
                    <th>
                        {{ $language->shortname }}
                        {{ $language->name }}
                    </th>
                @endforeach
            </tr>
            @foreach($site->pages as $page)
                @include('admin.texts.line_page', ['page' => $page, 'languages' => $site->languages])
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection

@include('admin.texts.edit_modal')
