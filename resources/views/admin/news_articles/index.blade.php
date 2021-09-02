@extends('admin.layout')

@section('header')
    Новости
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Новости'],
    ]])
@endsection

@can('admin.news_articles.add')
    @push('buttons2')
        <a href="{!! route('admin.news_articles.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->newsArticles->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Дата
                </th>
                <th>
                    Дата публикации
                </th>
                <th>
                    Заголовок<br>
                    Краткое изложение
                </th>
                <th>

                </th>
            </tr>
            @foreach($site->newsArticles as $newsArticle)
                <tr>
                    <td>
                        {{ $newsArticle->id }}
                    </td>
                    <td style="white-space: nowrap;">
                        {{ $newsArticle->publication_date_text }}
                    </td>
                    <td>
                        {{ $newsArticle->publication_date->format('d.m.Y') }}
                    </td>
                    <td>
                        <b>{{ $newsArticle->header }}</b><br>
                        {!! nl2br(e($newsArticle->note)) !!}
                    </td>
                    <td class="text-nowrap">
                        <a href="{!! route('admin.news_articles.edit', ['id' => $newsArticle->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $newsArticle->code }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.news_articles.delete') !!}" data-id="{{ $newsArticle->id }}"
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
