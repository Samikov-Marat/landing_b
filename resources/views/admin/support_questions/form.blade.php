@extends('admin.layout')

@section('content')

    <h2>Категория <q>{{ $supportCategory->id }}</q></h2>
    <h3>
    @if($supportQuestion->exists)
        Редактирование вопроса
    @else
        Добавление вопроса
    @endif
    </h3>

    <form method="post" action="{!! route('admin.support_questions.save') !!}">
        @csrf
        @if($supportQuestion->exists)
            <input type="hidden" name="id" value="{{ $supportQuestion->id }}">
        @endif
        <input type="hidden" name="category_id" value="{{ $supportCategory->id }}">

        <h5>Название на разных языках</h5>

        @php
            $questions = collect();
            if($supportQuestion->exists){
                $questions = $supportQuestion->supportQuestionTexts->pluck('question', 'language_id');
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <input type="text" class="form-control" name="question[{{ $language->id }}]"
                           value="{{ isset($questions[$language->id]) ? $questions[$language->id] : '' }}"
                           placeholder="Название" autocomplete="off">
                </div>
            @endforeach
        </div>

        <h5>Текст на разных языках</h5>

        @php
            $answers = collect();
            if($supportQuestion->exists){
                $answers = $supportQuestion->supportQuestionTexts->pluck('answer', 'language_id');
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <textarea class="form-control" style="height: 300px;" name="answer[{{ $language->id }}]" autocomplete="off">{{ isset($answers[$language->id]) ? $answers[$language->id] : '' }}</textarea>
                </div>
            @endforeach
        </div>


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
