@extends('admin.layout')

@section('header')
    Новости
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => $localOffice->subdomain],
        ['text' => 'Новости'],
    ]])
@endsection

@can('admin.franchisee_admin.news_articles.add')
    @push('buttons2')
        <a href="{!! route('admin.franchisee_admin.news_articles.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($franchisee->franchiseeNewsArticles->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Дата публикации
                </th>
                <th>
                    Дата на разных языках
                </th>
                <th>
                    Заголовок на разных языках
                </th>
                <th>

                </th>
            </tr>
            @foreach($franchisee->franchiseeNewsArticles as $newsArticle)
                <tr>
                    <td>
                        {{ $newsArticle->id }}
                    </td>
                    <td>
                        {{ $newsArticle->publication_date->format('d.m.Y') }}
                    </td>
                    <td style="white-space: nowrap;">
                        @foreach($newsArticle->franchiseeNewsArticleTexts as $newsArticleText)
                            <div>
                                {{ $newsArticleText->publication_date_text }}
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($newsArticle->franchiseeNewsArticleTexts as $newsArticleText)
                            <div>
                                {{ $newsArticleText->header }}
                            </div>
                        @endforeach
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
