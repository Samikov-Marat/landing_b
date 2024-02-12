@extends('admin.layout')

@section('header')
    Псевдонимы
@endsection

@can('admin.sites.add')
    @push('buttons2')
        <a href="{!! route('admin.aliases.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')
    <style>
        thead {
            position: sticky;
            top: 0;
            background: white;
        }
    </style>
    @if($aliases->isNotEmpty())
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>
                    id
                </th>
                <th>
                    Сайт
                </th>
                <th>
                    Псевдоним
                </th>
                <th>
                    Публичность
                </th>

                @canany(['admin.aliases.edit', 'admin.aliases.delete'])
                    <th>

                    </th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($aliases as $alias)
                <tr>
                    <td>
                        {{ $alias->id }}
                    </td>
                    <td>
                        {{ $alias->site->name }} {{ $alias->site->domain }}
                    </td>
                    <td>
                        {{ $alias->domain }}
                    </td>
                    <td>
                        {{ $alias->public?'Публичный':'Требует авторизацию' }}
                    </td>

                    @canany(['admin.aliases.edit', 'admin.aliases.delete'])
                        <td class="text-nowrap">
                            @can('admin.aliases.edit')
                                <a href="{!! route('admin.aliases.edit', ['id' => $alias->id]) !!}"
                                   class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i> Редактировать</a>
                            @endcan
                            @can('admin.aliases.delete')
                                <button type="button" data-text="Удалить {{ $alias->domain }}?"
                                        data-action="{!! route('admin.aliases.delete') !!}" data-id="{{ $alias->id }}"
                                        class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i>
                                    Удалить
                                </button>
                            @endcan
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

        @foreach($languages as $language)
            {{ implode(';', $language->toArray())  }} <br>
        @endforeach


    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
