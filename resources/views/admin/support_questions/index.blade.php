@extends('admin.layout')
@section('header')
    Вопросы в категории
@endsection

@section('breadcrumbs')
    @php
        $breadcrumbs = [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['href' => route('admin.support_categories.index', ['site_id' => $site->id]), 'text' => 'Категории страницы поддержки'],
        ];
        foreach ($path as $category) {
            $breadcrumbs[] = ['text' => $category->supportCategoryTexts[0]->name ?? $category->id];
        }
    @endphp

    @include('admin.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endsection


@can('admin.support_questions.add')
    @push('buttons2')
        <a href="{!! route('admin.support_questions.add', ['category_id' => $supportCategory->id]) !!}"
           class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($supportCategory->supportQuestions->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                @foreach($site->languages as $language)
                    <th>
                        {{ $language->name }}
                    </th>
                @endforeach
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($supportCategory->supportQuestions as $supportQuestion)

                @php
                    $questions = collect();
                    if($supportQuestion->exists){
                        $questions = $supportQuestion->supportQuestionTexts->pluck('question', 'language_id');
                    }
                @endphp

                <tr>
                    @foreach($site->languages as $language)
                        <td>
                            {{ isset($questions[$language->id]) ? $questions[$language->id] : '' }}
                        </td>
                    @endforeach
                    <td>
                        <form method="post" action="{!! route('admin.support_questions.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $supportQuestion->id }}">

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
                        <a href="{!! route('admin.support_questions.edit', ['id' => $supportQuestion->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button"
                                data-text="Удалить {{ $supportQuestion->shortname }} ({{ $supportQuestion->name }})?"
                                data-action="{!! route('admin.support_questions.delete') !!}"
                                data-id="{{ $supportQuestion->id }}" class="btn btn-danger btn-sm js-delete-confirm"><i
                                class="fas fa-trash"></i> Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
