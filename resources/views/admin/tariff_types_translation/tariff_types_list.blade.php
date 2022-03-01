@extends('admin.layout')

@section('header')
    Переводы
@endsection

@section('content')

    <table class="table table-hover table-bordered">
        <tr>
            <th>
                Тип тарифа ({{ config('app.tariff_default_language') }})
            </th>
            <th>
                Перевод
            </th>
            <th>

            </th>
        </tr>
        @foreach($tariffTypes as $tariffType)
            @php
                $tariffTextIndexed = $tariffType->tariffTypeTexts->keyBy('language_code_iso');
            @endphp
            <tr>
                <td>
                    @if(isset($tariffTextIndexed[config('app.tariff_default_language')]))
                        {{ $tariffTextIndexed[config('app.tariff_default_language')]->name }}

                    @endif

                </td>
                <td>
                    @if(isset($tariffTextIndexed[$language]))
                        {{ $tariffTextIndexed[$language]->name }}

                    @else
                        <span class="badge badge-warning">Нет перевода</span>
                    @endif
                </td>
                <td class="text-nowrap">
                    <a href="{!! route('admin.tariff_types_translation.edit',['language' => $language,'id' => $tariffType->id] ) !!}"
                       class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
