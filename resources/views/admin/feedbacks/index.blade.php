@extends('admin.layout')

@section('header')
    Отзывы
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Отзывы'],
    ]])
@endsection

@can('admin.feedbacks.add')
    @push('buttons2')
        <a href="{!! route('admin.feedbacks.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->feedbacks->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Язык
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Email
                </th>
                <th>
                    Текст
                </th>
                <th>
                    Дата написания
                </th>
                <th>
                    Опубликован
                </th>

                <th>

                </th>
            </tr>
            @foreach($site->feedbacks as $feedback)
                <tr>
                    <td>
                        {{ $feedback->id }}
                    </td>
                    <td>
                        {{ isset($feedback->language)?$feedback->language->name:'' }}
                    </td>
                    <td>
                        {{ $feedback->name }}
                    </td>
                    <td>
                        {{ $feedback->email }}
                    </td>
                    <td>
                        {{ $feedback->text }}
                    </td>
                    <td>
                        {{ $feedback->writing_date->format('d.m.Y H:i') }}
                    </td>
                    <td>
                        @if($feedback->published)
                            Да
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.feedbacks.edit', ['id' => $feedback->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $feedback->shortname }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.feedbacks.delete') !!}" data-id="{{ $feedback->id }}"
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
