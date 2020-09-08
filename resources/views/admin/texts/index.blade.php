@extends('admin.layout')
@section('buttons')
@endsection


@section('content')

    <h2>{{ $site->name }} {{ $site->domain }} Тексты.</h2>

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
