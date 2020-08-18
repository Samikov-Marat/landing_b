@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.pages.add') !!}" class="btn btn-primary">+ Создать</a>
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
                    <td class="text-nowrap">
                        <a href="{!! route('admin.pages.edit', ['id' => $page->id]) !!}" class="btn btn-primary btn-sm">Редактировать</a>
                        <button type="button" data-text="Удалить {{ $page->url }}?"
                                data-action="{!! route('admin.pages.delete') !!}" data-id="{{ $page->id }}"
                                class="btn btn-danger btn-sm js-delete-confirm">Удалить
                        </button>
                        <form method="post" action="{!! route('admin.pages.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $page->id }}">
                            @if (!$loop->first)
                                <input type="submit" name="direction" value="up" class="btn btn-primary btn-sm">
                            @endif
                            @if (!$loop->last)
                                <input type="submit" name="direction" value="down" class="btn btn-primary btn-sm">
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
