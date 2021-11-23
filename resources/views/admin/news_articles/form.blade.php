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

        <h5>Заголовок на разных языках</h5>

        @php
            $headers = collect();
            if(isset($newsArticle)){
                $headers = $newsArticle->newsArticleTexts->pluck('header', 'language_id');
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <input type="text" class="form-control" name="header[{{ $language->id }}]"
                           value="{{ isset($headers[$language->id]) ? $headers[$language->id] : '' }}"
                           placeholder="Заголовок" autocomplete="off">
                </div>
            @endforeach
        </div>


        <h5>Анонс на разных языках</h5>
        @php
            $notes = collect();
            if(isset($newsArticle)){
                $notes = $newsArticle->newsArticleTexts->pluck('note', 'language_id');
            }
        @endphp
        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <textarea class="form-control" name="note[{{ $language->id }}]"
                              rows="3">{{ isset($notes[$language->id]) ? $notes[$language->id] : '' }}</textarea>
                </div>
            @endforeach
        </div>

        <h5>Текст новости на разных языках</h5>
        @php
            $texts = collect();
            if(isset($newsArticle)){
                $texts = $newsArticle->newsArticleTexts->pluck('text', 'language_id');
            }
        @endphp
        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <textarea class="form-control" name="text[{{ $language->id }}]"
                              rows="7">{{ isset($texts[$language->id]) ? $texts[$language->id] : '' }}</textarea>
                </div>
            @endforeach
        </div>

        <h5>Дата в текстовом формате на разных языках</h5>
        @php
            $publicationDateTexts = collect();
            if(isset($newsArticle)){
                $publicationDateTexts = $newsArticle->newsArticleTexts->pluck('publication_date_text', 'language_id');
            }
        @endphp
        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <input type="text" class="form-control" name="publication_date_text[{{ $language->id }}]"
                           value="{{ isset($publicationDateTexts[$language->id]) ? $publicationDateTexts[$language->id] : '' }}"
                           placeholder="Дата в текстовом формате. Например, 21 апреля 2021" autocomplete="off">
                </div>
            @endforeach
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

        @include('admin.news_articles.image',
            ['newsArticle' => $newsArticle,
            'inputName' => 'preview',
            'attribute' => 'preview',
            'label' => 'Превью 224x174'])

        @include('admin.news_articles.image',
            ['newsArticle' => $newsArticle,
            'inputName' => 'image',
            'attribute' => 'image',
            'label' => 'Картинка. Основной размер 600x398'])

        @include('admin.news_articles.image',
            ['newsArticle' => $newsArticle,
            'inputName' => 'image2',
            'attribute' => 'image2',
            'label' => 'Картинка. Основной двойной размер 1200x796'])

        @include('admin.news_articles.image',
            ['newsArticle' => $newsArticle,
            'inputName' => 'mobile',
            'attribute' => 'mobile',
            'label' => 'Картинка. Мобильный размер. 320x213'])

        @include('admin.news_articles.image',
            ['newsArticle' => $newsArticle,
            'inputName' => 'mobile2',
            'attribute' => 'mobile2',
            'label' => 'Картинка. Мобильный двойной размер. 640x425'])


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>



@endsection
