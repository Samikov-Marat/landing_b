@extends('admin.layout')

@section('header')
    @isset($newsArticle)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Новости'],
        ['text' => isset($newsArticle)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.news_articles.save') !!}" enctype="multipart/form-data">
        @csrf
        @if(isset($newsArticle))
            <input type="hidden" name="id" value="{{ $newsArticle->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label>Язык</label>
            @foreach($site->languages as $language)
                @php($forId = 'language_id_' . $language->id)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="language_id" id="{{ $forId }}"
                           value="{{ $language->id }}" required {{ isset($newsArticle) && $newsArticle->language_id == $language->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $forId }}">{{ $language->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="id_header">Заголовок</label>
            <input type="text" class="form-control" name="header" id="id_code"
                   value="{{ isset($newsArticle) ? $newsArticle->header : '' }}"
                   placeholder="Заголовок" autocomplete="off">
            <small id="id_code_help" class="form-text text-muted">Заголовок новости</small>
        </div>

        <div class="form-group">
            <label for="id_note">Анонс</label>
            <textarea class="form-control" id="id_note" name="note"
                      rows="3">{{ isset($newsArticle) ? $newsArticle->note : '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="id_text">Текст новости</label>
            <textarea class="form-control" id="id_text" name="text"
                      rows="7">{{ isset($newsArticle) ? $newsArticle->text : '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="id_publication_date_text">Дата в текстовом формате</label>
            <input type="text" class="form-control" name="publication_date_text" id="id_publication_date_text"
                   value="{{ isset($newsArticle) ? $newsArticle->publication_date_text : '' }}"
                   placeholder="Дата в текстовом форрмате. Например, 21 апреля 2021" autocomplete="off">
            <small id="id_code_help" class="form-text text-muted">Дата в текстовом форрмате</small>
        </div>

        <div class="form-group">
            <div class="form-row">
                <div class="col-auto">
                    <label for="id_publication_date">Дата для сортировки</label>
                    <input type="date" class="form-control" name="publication_date" id="id_publication_date"
                           value="{{ isset($newsArticle) ? $newsArticle->publication_date->format('Y-m-d') : \Illuminate\Support\Carbon::now()->format('Y-m-d') }}"
                           autocomplete="off" style="width: auto;">
                </div>
                <div class="col">
                    <label for="id_publication_date">Время для сортировки</label>
                    <input type="time" class="form-control" name="publication_date_time" id="id_publication_date_time"
                           value="{{ isset($newsArticle) ? $newsArticle->publication_date->format('H:i') : \Illuminate\Support\Carbon::now()->format('H:i') }}"
                           autocomplete="off" style="width: auto;">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="id_preview">Превью</label>
            <input type="file" name="preview" class="form-control-file" id="id_preview">
            {{ isset($newsArticle, $newsArticle->preview) ? $newsArticle->preview : '' }}
        </div>
        <div class="form-group">
            <label for="id_image">Картинка</label>
            <input type="file" name="image" class="form-control-file" id="id_image">
            {{ isset($newsArticle, $newsArticle->image) ? $newsArticle->image : '' }}
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>



@endsection
