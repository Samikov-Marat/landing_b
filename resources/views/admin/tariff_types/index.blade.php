@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    <div class="float-right">
        <a href="{!! route('admin.tariff_types.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    </div>
    @if($tariffTypes->isNotEmpty())
        {{$tariffTypes->links()}}
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
            </tr>
            @foreach($tariffTypes as $tariffType)
                <tr>
                    <td>
                        {{ $tariffType->id }}
                    </td>
                    <td>
                        {{ $tariffType->ek_id}}
                    </td>
                    <td>
                        {{ $tariffType->name }}
                    </td>

                    <td class="text-nowrap">
                        <a href="{!! route('admin.tariff_types.edit', ['id' => $tariffType->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить?"
                                data-action="{!! route('admin.tariff_types.delete',['id' => $tariffType->id]) !!}"
                                data-id="{{ $tariffType->id }}"
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
