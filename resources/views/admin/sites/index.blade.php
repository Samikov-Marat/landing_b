@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.sites.add') !!}" class="btn btn-primary">+ Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    @if($sites->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Домен
                </th>
                <th>
                    Название
                </th>
                <th>

                </th>
            </tr>
            @foreach($sites as $site)
                <tr>
                    <td>
                        {{ $site->id }}
                    </td>
                    <td>
                        {{ $site->domain }}
                    </td>
                    <td>
                        {{ $site->name }}
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.sites.edit', ['id' => $site->id]) !!}" class="btn btn-primary btn-sm">Редактировать</a>
                        <button type="button" data-text="Удалить {{ $site->domain }}?" data-action="{!! route('admin.sites.delete') !!}" data-id="{{ $site->id }}" class="btn btn-danger btn-sm js-delete-confirm">Удалить</button>
                        <a href="{!! route('admin.languages.index', ['site_id' => $site->id]) !!}" class="btn btn-primary btn-sm">Языки</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
