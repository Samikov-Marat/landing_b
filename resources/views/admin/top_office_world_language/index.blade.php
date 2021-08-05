@extends('admin.layout')

@section('header')
    Переводы данных международных офисов
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.top_offices.index'), 'text' => 'Международные офисы'],
        ['text' => $topOffice->office->name],
        ['text' => 'Переводы'],
    ]])
@endsection


@section('content')

    @if($worldLanguages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Язык
                </th>
                <th>
                    Перевод данных
                </th>
                <th>
                    Актуальность
                </th>
                <th>

                </th>
            </tr>
            @php
                $actualHash = \App\Classes\OfficeHash::getInstance($topOffice->office)->getHash();
            @endphp
            @foreach($worldLanguages as $worldLanguage)
                <tr>
                    <td>
                        [{{ $worldLanguage->language_code_iso }}]
                        {{ $worldLanguage->name }}
                    </td>
                    <td>
                        @if($worldLanguage->topOffices->isNotEmpty())
                            {{ $worldLanguage->topOffices->first()->pivot->name }}
                        @else
                            <span class="badge badge-warning">Не переведено</span>
                        @endif
                    </td>
                    <td>
                        @if($worldLanguage->topOffices->isNotEmpty())
                            @if($worldLanguage->topOffices->first()->pivot->office_hash == $actualHash)
                                Актуальный
                            @else
                                <span class="text-warning"><i class="fas fa-exclamation-triangle"></i></span> Неактульный
                            @endif
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.top_office_world_languages.edit', ['top_office_id' => $topOffice->id, 'world_language_id'=>$worldLanguage->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
