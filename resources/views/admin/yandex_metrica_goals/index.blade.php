@extends('admin.layout')

@section('header')
    Цели Яндекс-метрики
@endsection

@can('admin.yandex_metrica_goals.add')
    @push('buttons2')

        <a href="{!! route('admin.yandex_metrica_goals.yandex_auth') !!}" class="btn btn-link"><i class="fas fa-flag-checkered"></i> Отправить в Яндекс</a>
        <a href="{!! route('admin.yandex_metrica_goals.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    <table class="table table-hover table-bordered">
        <tr>
            <th>
                id
            </th>
            <th>
                Название
            </th>
            <th>&nbsp;
            </th>
        </tr>
        @foreach($projects as $project)
            <tr>
            <th colspan="4">{{ $project->name }}</th>
            </tr>
            @foreach($project->yandexMetricaGoals as $yandexMetricaGoal)
                <tr>
                    <td>
                        {{ $yandexMetricaGoal->id }}
                    </td>
                    <td>
                        {{ $yandexMetricaGoal->name }}
                    </td>
                    <td>
                        {{ $yandexMetricaGoal->description }}
                    </td>

                    <td class="text-nowrap">
                        <a href="{!! route('admin.yandex_metrica_goals.edit', ['id' => $yandexMetricaGoal->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить разрешение '{{ $yandexMetricaGoal->name }}'?"
                                data-action="{!! route('admin.yandex_metrica_goals.delete') !!}" data-id="{{ $yandexMetricaGoal->id }}"
                                class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </table>
@endsection
