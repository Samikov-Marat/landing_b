@extends('admin.layout')
@section('buttons')
@endsection

@section('content')

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
