@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    @if($tariffs->isNotEmpty())
{{--        @dump($tariffs)--}}
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
                    $tariffTextIndexed = $tariff->tariffText->groupBy('tariff_id');
                @endphp

                @dump($tariffTextIndexed)
{{--                @dump($tariffTextIndexed[0]['id'])--}}

{{--                @foreach($tariffTranslations as $value)--}}
                    <tr>
                        <td>
{{--                            @if(isset($tariffTextIndexed[config('app.tariff_default_language')]))--}}
{{--                                <h2>{{ $tariffTextIndexed[config('app.tariff_default_language')]->name }}</h2>--}}
{{--                                {{ $tariffTextIndexed[config('app.tariff_default_language')]->description }}--}}
{{--                            @endif--}}
                        </td>
                        <td>
{{--                            @if($value->language_code_iso != config('app.tariff_default_language'))--}}
{{--                                <h2>{{ $value->name }}</h2>--}}
{{--                                {{ $value->description }}--}}
{{--                            @else--}}
{{--                                <span class="badge badge-warning">Нет перевода</span>--}}
{{--                            @endif--}}
                        </td>
                    </tr>
{{--                @endforeach--}}
            @endforeach
        </table>
        {{$tariffs->links()}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
