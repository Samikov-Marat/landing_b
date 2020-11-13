@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.roles.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    @if($roles->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Разрешения
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($roles as $role)
                <tr>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        <a href="{!! route('admin.roles.edit_permission_list', ['id' => $role->id]) !!}">
                            {{ $role->permissions->count() }} шт.
                        </a>
                    </td>

                    <td>
                        <form method="post" action="{!! route('admin.roles.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            @if (!$loop->first)
                                <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm">
                                    Выше
                                </button>
                            @endif
                            @if (!$loop->last)
                                <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm">
                                    Ниже
                                </button>
                            @endif
                        </form>
                    </td>

                    <td class="text-nowrap">
                        <a href="{!! route('admin.roles.edit', ['id' => $role->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $role->url }}?"
                                data-action="{!! route('admin.roles.delete') !!}" data-id="{{ $role->id }}"
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
