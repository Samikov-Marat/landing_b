@extends('admin.layout')

@section('header')
    Разрешения
@endsection

@can('admin.permissions.generate')
    @push('buttons2')
        <form method="post" action="{!! route('admin.permissions.generate') !!}" class="d-inline">
            {!! csrf_field() !!}
            <button class="btn btn-secondary" type="submit">Генерировать</button>
        </form>
    @endpush
@endcan

@can('admin.permissions.add')
    @push('buttons2')
        <a href="{!! route('admin.permissions.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

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
                        <a href="{!! route('admin.permissions.edit', ['id' => $permission->text_id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить разрешение '{{ $permission->name }}'?"
                                data-action="{!! route('admin.permissions.delete') !!}" data-id="{{ $permission->text_id }}"
                                class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $permissions->links() !!}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
