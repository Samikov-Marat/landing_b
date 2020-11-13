@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.pages.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    @if($pages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Url
                </th>
                <th>
                    Название
                </th>
                <th>
                    Шаблон
                </th>
                <th>
                    Тексты
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($pages as $page)
                <tr>
                    <td>
                        {{ $page->id }}
                    </td>
                    <td>
                        {{ $page->url }}
                    </td>
                    <td>
                        {{ $page->name }}
                    </td>
                    <td>
                        {{ $page->template }}
                    </td>

                    <td>
                        <a href="{!! route('admin.text_types.index', ['page_id' => $page->id]) !!}">Тексты</a>
                    </td>

                    <td>
                        <form method="post" action="{!! route('admin.pages.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $page->id }}">
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
                        <a href="{!! route('admin.pages.edit', ['id' => $page->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $page->url }}?"
                                data-action="{!! route('admin.pages.delete') !!}" data-id="{{ $page->id }}"
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
