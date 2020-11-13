@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.languages.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    <h2>Языки сайта {{ $site->domain }} <small>{{ $site->name }}</small></h2>

    @if($site->languages->isNotEmpty())
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
            @foreach($site->languages as $language)
                <tr>
                    <td>
                        {{ $language->id }}
                    </td>
                    <td>
                        {{ $language->shortname }}
                    </td>
                    <td>
                        {{ $language->name }}
                    </td>
                    <td>
                        {{ $language->sort }}
                        <form method="post" action="{!! route('admin.languages.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $language->id }}">

                            @if (!$loop->first)
                            <input type="submit" name="direction" value="up" class="btn btn-primary btn-sm">
                            @endif
                            @if (!$loop->last)
                            <input type="submit" name="direction" value="down" class="btn btn-primary btn-sm">
                            @endif

                        </form>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.languages.edit', ['id' => $language->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $language->shortname }} сайта {{ $site->domain }}?" data-action="{!! route('admin.languages.delete') !!}" data-id="{{ $language->id }}" class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
