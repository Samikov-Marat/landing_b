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
                    Название
                </th>

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
                        Название по таблице офисов
                    </td>

                    @canany(['admin.sites.edit', 'admin.sites.delete'])
                        <td class="text-nowrap">
                            @can('admin.sites.delete')
                                <button type="button" data-text="Удалить {{ $topOffice->domain }}?"
                                        data-action="{!! route('admin.sites.delete') !!}" data-id="{{ $topOffice->id }}"
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
