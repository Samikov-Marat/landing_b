@extends('admin.layout')

@section('header')
    Языки сайта
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Языки'],
    ]])
@endsection

@can('admin.languages.add')
    @push('buttons2')
        <a href="{!! route('admin.languages.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->languages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Обозначение
                </th>
                <th>
                    Название
                </th>
                <th>
                    Международные офисы
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($site->languages as $language)
                <tr>
                    <td>
                        {{ $language->id }}
                    </td>
                    <td>
                        {{ $language->shortname }}
                    </td>
                    <td>
                        {{ $language->name }}
                    </td>
                    <td>
                        @if(isset($language->worldLanguage))
                            {{ $language->worldLanguage->name }}
                        @endif
                    </td>
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.languages.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $language->id }}">

                            @if (!$loop->first)
                                <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm"
                                        title="Вверх">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                            @endif
                            @if (!$loop->last)
                                <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm"
                                        title="Вниз">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            @endif

                        </form>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.languages.edit', ['id' => $language->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $language->shortname }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.languages.delete') !!}" data-id="{{ $language->id }}"
                                class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
