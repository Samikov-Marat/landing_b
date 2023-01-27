@extends('admin.layout')

@section('header')
    Пользователи
@endsection

@can('admin.users.permission_tree')
    @push('buttons2')
        <a href="{!! route('admin.users.permission_tree') !!}" class="btn btn-secondary"><i class="fas fa-tree"></i> Дерево разрешений</a>
    @endpush
@endcan

@can('admin.users.add')
    @push('buttons2')
        <a href="{!! route('admin.users.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($users->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Имя
                </th>
                <th>
                    email
                </th>
                <th>
                    Статус
                </th>
                <th>
                    Роли
                </th>
                <th>

                </th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        @if($user->disabled)
                            <i class="fas fa-user-slash"></i> заблокирован
                        @endif
                    </td>
                    <td>
                        <a href="{!! route('admin.users.edit_role_list', ['id' => $user->id]) !!}">
                            {{ $user->roles->count() }} шт.
                        </a>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.users.reset_password_form', ['id' => $user->id]) !!}" class="btn btn-primary btn-sm"><i class="fa fa-key"></i> Обновить пароль</a>

                        <a href="{!! route('admin.users.edit', ['id' => $user->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить  {{ $user->name }}({{ $user->email }})?"
                                data-action="{!! route('admin.users.delete') !!}" data-id="{{ $user->id }}"
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
