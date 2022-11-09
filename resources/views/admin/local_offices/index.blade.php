@extends('admin.layout')

@section('header')
    Местные офисы
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Местные офисы'],
    ]])
@endsection

@can('admin.local_offices.add')
    @push('buttons2')
        <a href="{!! route('admin.local_offices.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->localOffices->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Обозначение
                </th>
                <th>
                    Поддомен
                </th>
                <th>
                    Название
                </th>
                <th>
                    UTM
                </th>
                <th>
                    Категория api-marketing
                </th>
                <th>
                    Фотографии
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($site->localOffices as $localOffice)
                <tr>
                    <td>
                        {{ $localOffice->id }}
                    </td>
                    <td>
                        {{ $localOffice->code }}
                    </td>
                    <td>
                        @if($localOffice->subdomain !== '')
                            {{ $localOffice->subdomain }}<br>
                            https://{{ $localOffice->subdomain }}.{{ $site->domain }}
                        @else
                            <span class="disabled">нет</span>
                        @endif
                    </td>
                    <td>
                        @foreach($localOffice->localOfficeTexts as $text)
                            <div>
                                {{ $text->name }}
                            </div>
                        @endforeach
                    </td>
                    <td>
                        {{ $localOffice->utm_tag }}={{ $localOffice->utm_value }}
                    </td>
                    <td>
                        {{ $localOffice->category }}
                    </td>
                    <td>
                        <a href="{!! route('admin.local_office_photos.index', ['local_office_id'=>$localOffice->id]) !!}">Фотографии</a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.local_offices.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $localOffice->id }}">

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
                        <a href="{!! route('admin.local_offices.edit', ['id' => $localOffice->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $localOffice->code }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.local_offices.delete') !!}" data-id="{{ $localOffice->id }}"
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
