@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    @if($site->languages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                @foreach($site->languages as $language)
                <th>
                    {{ $language->name }}
                </th>
                @endforeach
            </tr>
            @foreach($tariffs as $tariff)
                <tr>
                    @php
                        $tariffTextIndexed = $tariff->tariffTexts->keyBy('language_code_iso');
                    @endphp
                    @foreach($site->languages as $language)
                        <td>
                            @if($tariffTextIndexed->has($language->language_code_iso))
                                <h2>{{ $tariffTextIndexed[$language->language_code_iso]->name }}</h2>
                                {{ $tariffTextIndexed[$language->language_code_iso]->description }}
                            @else
                                <span class="badge badge-warning">Нет перевода</span>
                            @endif
                        </td>
                    @endforeach

                </tr>
            @endforeach
        </table>
        {{$tariffs->links()}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
