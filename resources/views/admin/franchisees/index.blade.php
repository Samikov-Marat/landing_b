@extends('admin.layout')

@section('header')
    Франчайзи
@endsection

@can('admin.franchisees.add')
    @push('buttons2')
        <a href="{!! route('admin.franchisees.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($franchisees->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Описание
                </th>
                <th>
                    Пользователи-редакторы
                </th>
                <th>

                </th>
            </tr>
            @foreach($franchisees as $franchisee)
                <tr>
                    <td>
                        {{ $franchisee->id }}
                    </td>
                    <td>
                        {{ $franchisee->name }}
                    </td>
                    <td>
                        {{ $franchisee->description }}
                    </td>
                    <td>
                        {{ $franchisee->users_count }} шт.
                    </td>

                    <td class="text-nowrap">
                        <a href="{!! route('admin.franchisees.edit', ['id' => $franchisee->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $franchisee->name }}?"
                                data-action="{!! route('admin.franchisees.delete') !!}" data-id="{{ $franchisee->id }}"
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
