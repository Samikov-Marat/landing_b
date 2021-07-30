@extends('admin.layout')

@section('header')
    Избранные офисы
@endsection

@can('admin.top_offices.add')
    @push('buttons2')
        <a href="{!! route('admin.top_offices.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($topOffices->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название, адрес
                </th>
                <th>
                    Актуальность
                </th>
                @can('admin.top_offices.move')
                <th>
                    Сортировка
                </th>
                @endcan

                @canany(['admin.top_offices.edit', 'admin.top_offices.delete'])
                    <th>

                    </th>
                @endcan
            </tr>
            @foreach($topOffices as $topOffice)
                <tr>
                    <td>
                        {{ $topOffice->id }}
                    </td>
                    <td>
                        {{ $topOffice->code }}
                    </td>
                    <td>
                        {{ $topOffice->office->name }}<br>
                        {{ $topOffice->office->full_address }}
                    </td>
                    <td>
                        @if(!$topOffice->isActual)
                            Нет
                        @endif
                    </td>
                    @can('admin.top_offices.move')
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.top_offices.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $topOffice->id }}">

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
                    @endcan
                    @canany(['admin.top_offices.edit', 'admin.top_offices.delete'])
                        <td class="text-nowrap">
                            @can('admin.top_offices.edit')
                            <a href="{!! route('admin.top_offices.edit', ['id' => $topOffice->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                            @endcan
                            @can('admin.top_offices.delete')
                                <button type="button" data-text="Удалить {{ $topOffice->code }}?"
                                        data-action="{!! route('admin.top_offices.delete') !!}" data-id="{{ $topOffice->id }}"
                                        class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i>
                                    Удалить
                                </button>
                            @endcan
                        </td>
                    @endcan
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
