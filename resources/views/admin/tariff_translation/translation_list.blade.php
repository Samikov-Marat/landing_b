@extends('admin.layout')

@section('header')
    Переводы
@endsection

@section('content')

    <table class="table table-hover table-bordered">
        <tr>

            <th>
                Название тарифа ({{ config('app.tariff_default_language') }})
            </th>
            <th>
                Перевод
            </th>

            <th>

            </th>

        </tr>

        @foreach($tariffs as $tariff)
            @php
                $tariffTextIndexed = $tariff->tariffText->keyBy('language_code_iso');
            @endphp
            <tr>
                <td>
                    @if(isset($tariffTextIndexed[config('app.tariff_default_language')]))
                        <h2>{{ $tariffTextIndexed[config('app.tariff_default_language')]->name }}</h2>
                        {{ $tariffTextIndexed[config('app.tariff_default_language')]->description }}
                    @endif

                </td>
                <td>
                    @if(isset($tariffTextIndexed[$language]))
                        <h2>{{ $tariffTextIndexed[$language]->name }}</h2>
                        {{ $tariffTextIndexed[$language]->description }}
                    @else
                        <span class="badge badge-warning">Нет перевода</span>
                    @endif
                </td>
                <td class="text-nowrap">
                    <a href="{!! route('admin.tariff_translation.edit',['language' => $language,'id' => $tariff->id] ) !!}"
                       class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

