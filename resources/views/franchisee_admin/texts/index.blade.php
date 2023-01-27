@extends('admin.layout')

@section('header')
    Тексты сайта
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['text' => 'Тексты'],
    ]])
@endsection

@section('content')

        <table class="table table-hover table-bordered">
            <tr>
                @foreach($site->languages as $language)
                    <th>
                        {{ $language->shortname }}
                        {{ $language->name }}
                    </th>
                @endforeach
                <th></th>
            </tr>
            @foreach($pages as $page)
                @include('franchisee_admin.texts.line_page', ['page' => $page, 'languages' => $site->languages])
            @endforeach
        </table>
@endsection

@include('admin.texts.edit_modal')
