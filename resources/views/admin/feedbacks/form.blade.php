@extends('admin.layout')

@section('header')
    @isset($feedback)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Отзывы'],
        ['text' => isset($feedback)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.feedbacks.save') !!}">
        @csrf
        @if(isset($feedback))
            <input type="hidden" name="id" value="{{ $feedback->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label>Язык</label>
            @foreach($site->languages as $language)
                @php($forId = 'language_id_' . $language->id)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="language_id" id="{{ $forId }}"
                           value="{{ $language->id }}" required {{ isset($feedback) && $feedback->language_id == $language->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $forId }}">{{ $language->name }}</label>
                </div>
            @endforeach
        </div>


        <div class="form-group">
            <label for="id_name">Имя</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($feedback) ? $feedback->name : '' }}"
                   placeholder="Имя" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Имя автора отзыва</small>
        </div>

        <div class="form-group">
            <label for="id_email">Email</label>
            <input type="email" class="form-control" name="email" id="id_email"
                   value="{{ isset($feedback) ? $feedback->email : '' }}"
                   placeholder="Email" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Email</small>
        </div>

        <div class="form-group">
            <label for="id_text">Текст отзыва</label>
            <textarea class="form-control" id="id_text" name="text"
                      rows="7">{{ isset($feedback) ? $feedback->text : '' }}</textarea>
        </div>


        <div class="form-group">
            <div class="form-row">
                <div class="col-auto">
                    <label for="id_publication_date">Дата для сортировки</label>
                    <input type="date" class="form-control" name="writing_date" id="id_publication_date"
                           value="{{ isset($feedback) ? $feedback->writing_date->format('Y-m-d') : \Illuminate\Support\Carbon::now()->format('Y-m-d') }}"
                           autocomplete="off" style="width: auto;">
                </div>
                <div class="col">
                    <label for="id_publication_date">Время для сортировки</label>
                    <input type="time" class="form-control" name="writing_date_time" id="id_publication_date_time"
                           value="{{ isset($feedback) ? $feedback->writing_date->format('H:i') : \Illuminate\Support\Carbon::now()->format('H:i') }}"
                           autocomplete="off" style="width: auto;">
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="published" value="1"
                       id="check_published" {{ (isset($feedback) && $feedback->published)?'checked':'' }}
                       class="form-check-input">
                <label for="check_published" class="form-check-label">
                    Опубликовать
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
