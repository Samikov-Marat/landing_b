@extends('admin.layout')

@section('header')
    Языки тарифов
@endsection

@section('content')
    @if($languageIsoItems->isNotEmpty())

        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Название
                </th>
                <th>
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
                    <td class="text-nowrap">
                        <a href=""
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Список переводов</a>

                    </td>
                </tr>
            @endforeach
        </table>
        {{--    {{ $languageIsoItems->links() }}--}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif

@endsection
