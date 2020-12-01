@extends('admin.layout')
@section('header')
    Типы текстов на странице {{ $page->name }}
@endsection

@can('admin.text_types.add')
    @push('buttons2')
        <a href="{!! route('admin.text_types.add', ['page_id' => $page->id]) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($page->textTypes->isNotEmpty())
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
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($page->textTypes as $textType)
                <tr>
                    <td>
                        {{ $textType->id }}
                    </td>
                    <td>
                        {{ $textType->shortname }}
                    </td>
                    <td>
                        {{ $textType->name }}
                    </td>
                    <td>
                        {{ $textType->sort }}
                        <form method="post" action="{!! route('admin.text_types.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $textType->id }}">

                            @if (!$loop->first)
                            <input type="submit" name="direction" value="up" class="btn btn-primary btn-sm">
                            @endif
                            @if (!$loop->last)
                            <input type="submit" name="direction" value="down" class="btn btn-primary btn-sm">
                            @endif

                        </form>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.text_types.edit', ['id' => $textType->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $textType->shortname }} ({{ $textType->name }})?" data-action="{!! route('admin.text_types.delete') !!}" data-id="{{ $textType->id }}" class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
