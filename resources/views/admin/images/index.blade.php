@extends('admin.layout')

@section('header')
    Картинки сайта
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Картинки'],
    ]])
@endsection

@can('admin.images.add')
    @push('buttons2')
        <a href="{!! route('admin.images.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->images->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    URL
                </th>
                <th>
                    Внешний вид
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($site->images as $image)
                <tr>
                    <td>
                        {{ $image->id }}
                    </td>
                    <td>
                        {{ $image->url }}
                    </td>
                    <td>

                        <img src="{!! url(Storage::disk('images')->url($image->path)) !!}" style="max-width: 200px; max-height: 200px;">
                    </td>
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.images.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $image->id }}">

                            @if (!$loop->first)
                                <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm"
                                        title="Вверх">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                            @endif
                            @if (!$loop->last)
                                <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm"
                                        title="Вниз">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            @endif

                        </form>
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.images.edit', ['id' => $image->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $image->url }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.images.delete') !!}" data-id="{{ $image->id }}"
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
