@extends('admin.layout')

@section('header')
    Местные офисы
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Местные офисы'],
        ['text' => $localOffice->code],
        ['text' => 'Фотографии местных офисов'],
    ]])
@endsection

@can('admin.local_office_photos.add')
    @push('buttons2')
        <a href="{!! route('admin.local_office_photos.add', ['local_office_id' => $localOffice->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($localOffice->localOfficePhotos->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Файл
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($localOffice->localOfficePhotos as $localOfficePhoto)
                <tr>
                    <td>
                        {{ $localOfficePhoto->id }}
                    </td>
                    <td>
                        {{ $localOfficePhoto->sample }}
                    </td>
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.local_office_photos.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $localOfficePhoto->id }}">

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
                        <a href="{!! route('admin.local_office_photos.edit', ['id' => $localOfficePhoto->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $localOfficePhoto->sample }}?"
                                data-action="{!! route('admin.local_office_photos.delete') !!}" data-id="{{ $localOfficePhoto->id }}"
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
