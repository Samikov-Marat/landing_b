@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@section('content')

    @if($tariffs->isNotEmpty())

        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Название
                </th>
                <th>
                    Описание
                </th>
            </tr>
{{--                        @dump($tariffs)--}}
            @foreach($tariffs as $tariff)
                @foreach($tariff->tariffText as $value)
                    <tr>
                        <td>
                            {{ $value->id}}
                        </td>
                        <td>
                            {{ $value->name}}
                        </td>
                        <td>
                            {{ $value->description}}
                        </td>

                        <td class="text-nowrap">
                                                <a href="{!! route('admin.tariffs.edit', ['id' => $value->id]) !!}"
                                                   class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                            {{--                    <button type="button" data-text="Удалить?"--}}
                            {{--                            data-action="{!! route('admin.tariffs.delete',['id' => $tariff->id]) !!}"--}}
                            {{--                            data-id="{{ $tariff->id }}"--}}
                            {{--                            class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить--}}
                            {{--                    </button>--}}
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
