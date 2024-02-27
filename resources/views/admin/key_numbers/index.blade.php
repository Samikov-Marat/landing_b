@extends('admin.layout')

@section('header')
    Ключевые числа
@endsection

@can('admin.sites.add')
    @push('buttons2')
        <a href="{!! route('admin.key_numbers.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')
    @if($keyNumbers->isNotEmpty())
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>
                    id
                </th>
                <th>
                    Код
                </th>
                <th>
                    Значение
                </th>
                <th>
                    Описание
                </th>

                @canany(['admin.key_numbers.edit', 'admin.key_numbers.delete'])
                    <th>

                    </th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($keyNumbers as $keyNumber)
                <tr>
                    <td>
                        {{ $keyNumber->id }}
                    </td>
                    <td>
                        {{ $keyNumber->shortname }}
                    </td>
                    <td>
                        {{ $keyNumber->value }}
                    </td>
                    <td>
                        {{ $keyNumber->description }}
                    </td>

                    @canany(['admin.key_numbers.edit', 'admin.key_numbers.delete'])
                        <td class="text-nowrap">
                            @can('admin.key_numbers.edit')
                                <a href="{!! route('admin.key_numbers.edit', ['id' => $keyNumber->id]) !!}"
                                   class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i> Редактировать</a>
                            @endcan
                            @can('admin.key_numbers.delete')
                                <button type="button" data-text="Удалить {{ $keyNumber->description }}?"
                                        data-action="{!! route('admin.key_numbers.delete') !!}" data-id="{{ $keyNumber->id }}"
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
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
