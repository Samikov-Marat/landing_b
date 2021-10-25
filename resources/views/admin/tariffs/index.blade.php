@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    <div>
        <a href="{!! route('admin.tariffs.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    </div
    @if($tariffs->isNotEmpty())

        >
    <table class="table table-hover table-bordered">
        <tr>
            <th>
                id
            </th>
            <th>
                ЭК id
            </th>
            <th>
                Тип тарифа
            </th>
            <th>
                Название
            </th>
            <th>
                Описание
            </th>
        </tr>
        @foreach($tariffs as $tariff)
            @foreach($tariff->tariffText as $value)
            <tr>
                <td>
                    {{ $tariff->id }}
                </td>
                <td>
                    {{ $tariff->ek_id}}
                </td>
                <td>
                    {{ $tariff->tariff_type_id}}
                </td>
                <td>
                    {{ $value->name}}
                </td>
                <td>
                    {{ $value->description}}
                </td>

                <td class="text-nowrap">
                    <a href="{!! route('admin.tariffs.edit', ['id' => $tariff->id]) !!}"
                       class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                    <button type="button" data-text="Удалить?"
                            data-action="{!! route('admin.tariffs.delete',['id' => $tariff->id]) !!}"
                            data-id="{{ $tariff->id }}"
                            class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
                    </button>
                </td>
            </tr>
            @endforeach
        @endforeach
    </table>
    {{$tariffs->links()}}
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
