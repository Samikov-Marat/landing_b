@extends('admin.layout')

@section('header')
    Языки тарифов
@endsection

@section('content')
    @if($languages->isNotEmpty())

    <table class="table table-hover table-bordered">
        <tr>
            <th>
                id
            </th>
            <th>
                Код ISO
            </th>
            <th>
                Сайт id
            </th>
            <th>
                Название
            </th>
        </tr>
        @foreach($languages as $language)
            <tr>
                <td>
                    {{$language->id}}
                </td>
                <td>
                    {{$language->language_code_iso}}
                </td>
                <td>
                    {{$language->site_id}}
                </td>
                <td>
                    {{$language->name}}
                </td>
                <td class="text-nowrap">
                    <a href=""
                       class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{$languages->links()}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif

@endsection
