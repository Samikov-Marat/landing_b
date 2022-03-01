@extends('admin.layout')

@section('header')
    Языки типов тарифов
@endsection

@section('content')
    @if($languageIsoItems->isNotEmpty())

        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Язык
                </th>
                <th>
                    Языки и сайты на которых они используются
                </th>
                <th>
                    Переведено
                </th>
            </tr>
            @foreach($languageIsoItems as $language)
                <tr>
                    <td>
                        {{ $language->code_iso }}
                    </td>
                    <td>
                        {{ $language->name }}
                    </td>

                    <td>
                        @foreach( $language->languages as $item)
                        {{ $item->shortname }} {{ $item->site->name }}</br>
                        @endforeach
                    </td>
                    <td>
                        {{ $language->tariffTypeTexts->count() }}/{{ $tariffTypeCount}}
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.tariff_types.translation_list', ['language' => $language->code_iso] ) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Список переводов</a>

                    </td>
                </tr>
            @endforeach
        </table>
        {{ $languageIsoItems->links() }}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif

@endsection
