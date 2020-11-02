@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.permissions.add') !!}" class="btn btn-primary">+ Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    @if($permissions->isNotEmpty())
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
            @foreach($permissions as $permission)
                <tr>
                    <td>
                        {{ $permission->text_id }}
                    </td>
                    <td>
                        {{ $permission->name }}
                    </td>

                    <td class="text-nowrap">
                        <a href="{!! route('admin.permissions.edit', ['id' => $permission->text_id]) !!}" class="btn btn-primary btn-sm">Редактировать</a>
                        <button type="button" data-text="Удалить разрешение '{{ $permission->name }}'?"
                                data-action="{!! route('admin.permissions.delete') !!}" data-id="{{ $permission->text_id }}"
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
