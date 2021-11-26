@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    @if($tariffs->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Название тарифа ({{ config('app.tariff_default_language') }})
                </th>
                <th>
                    Перевод
                </th>
            </tr>
            @foreach($tariffs as $tariff)
                @php
                    $tariffTextIndexed = $tariff->tariffText->keyBy('tariff_id');
                @endphp
                @foreach($tariffTextIndexed as $value)
                    <tr>
                        <td>
                            @if($value->language_code_iso == config('app.tariff_default_language'))
                                <h2>{{ $value->name }}</h2>
                                {{ $value->description}}
                            @endif
                        </td>
                        <td>

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
