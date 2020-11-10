@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.users.add') !!}" class="btn btn-primary">+ Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


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
                        <a href="{!! route('admin.users.edit_role_list', ['id' => $user->id]) !!}">
                            {{ $user->roles->count() }} шт.
                        </a>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.users.edit', ['id' => $user->id]) !!}" class="btn btn-primary btn-sm">Редактировать</a>
                        <button type="button" data-text="Удалить {{ $user->domain }}?"
                                data-action="{!! route('admin.users.delete') !!}" data-id="{{ $user->id }}"
                                class="btn btn-danger btn-sm js-delete-confirm">Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
