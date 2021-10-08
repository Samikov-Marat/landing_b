@extends('admin.layout')

@section('header')
    Тарифы
@endsection

@can('admin.tariffs.add')
    @push('buttons2')
        <a href="{!! route('admin.tariffs.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($tariffs->isNotEmpty())
        {!! $tariffs->render() !!}

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
            @foreach($tariffs as $tariff)
                <tr>
                    <td>
                        {{ $tariff->id }}
                    </td>
                    <td>
                        {{ $tariff->ek_id}}
                    </td>
                    <td>
                        {{ $tariff->tariff_type_id }}
                    </td>

{{--                    <td>--}}
{{--                        <a href="{!! route('admin.text_types.index', ['tariff_id' => $tariff->id]) !!}">{{ $tariff->text_types_count }} шт.</a>--}}
{{--                    </td>--}}

{{--                    <td class="text-center">--}}
{{--                        <form method="post" action="{!! route('admin.tariffs.move') !!}">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="id" value="{{ $tariff->id }}">--}}
{{--                            @if (!$loop->first)--}}
{{--                                <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm">--}}
{{--                                    <i class="fas fa-arrow-up"></i>--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                            @if (!$loop->last)--}}
{{--                                <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm">--}}
{{--                                    <i class="fas fa-arrow-down"></i>--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                        </form>--}}
{{--                    </td>--}}

                    <td class="text-nowrap">
                        <a href="{!! route('admin.tariffs.edit', ['id' => $tariff->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить?"
                               data-action="{!! route('admin.tariffs.delete') !!}" data-id="{{ $tariff->id }}"
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
