@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    @if($tariffs->isNotEmpty())

        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Название
                </th>
                <th>
                    Описание
                </th>
                <th>
                    язык
                </th>
            </tr>
            @foreach($tariffs as $tariff)
                @foreach($tariff->tariffText as $value)
                    <tr>
                        <td>
                            {{ $value->id}}
                        </td>
                        <td>
                            {{ $value->name}}
                        </td>
                        <td>
                            {{ $value->description}}
                        </td>
                        <td>
                            {{ $value->language_code_iso}}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
        {{$tariffs->links()}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
