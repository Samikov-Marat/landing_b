@extends('admin.layout')

@section('header')
    Сайты
@endsection

@can('admin.sites.add')
    @push('buttons2')
        <a href="{!! route('admin.sites.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')
<style>
    thead {
        position: sticky;
        top: 0;
        background: white;
    }
</style>
    @if($sites->isNotEmpty())
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>
                    id
                </th>
                <th>
                    Домен
                </th>
                <th>
                    Название
                </th>

                @can('admin.sites.edit_page_list')
                    <th>
                        Страницы
                    </th>
                @endcan

                @can('admin.sites.edit_tariff_list')
                    <th>
                        Тарифы калькулятора
                    </th>
                @endcan

                @can('admin.languages.index')
                <th>
                    Языки
                </th>
                @endcan

                @can('admin.texts.index')
                <th>
                    Тексты
                </th>
                @endcan

                @can('admin.images.index')
                <th>
                    Картинки
                </th>
                @endcan

                @can('admin.tariffs.site_tariffs')
                <th>
                    Тарифы
                </th>
                @endcan
                @can('admin.local_offices.index')
                <th>
                    Местные офисы
                </th>
                @endcan
                @can('admin.news_articles.index')
                <th>
                    Новости
                </th>
                @endcan
                @can('admin.our_workers.index')
                <th>
                    Сотрудники
                </th>
                @endcan
                @can('admin.feedbacks.index')
                <th>
                    Отзывы
                </th>
                @endcan
                @can('admin.support_categories.index')
                    <th>
                        Поддержка
                    </th>
                @endcan
                @can('admin.map.index')
                    <th>
                        Карта
                    </th>
                @endcan
                @canany(['admin.sites.edit', 'admin.sites.delete'])
                    <th>

                    </th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($sites as $site)
                <tr>
                    <td>
                        {{ $site->id }}
                    </td>
                    <td>
                        {{ $site->domain }}
                    </td>
                    <td>
                        {{ $site->name }}
                    </td>
                    @can('admin.sites.edit_page_list')
                        <td>
                            <a href="{!! route('admin.sites.edit_page_list', ['id' => $site->id]) !!}">
                                {{ $site->pages->count() }} шт.
                            </a>
                        </td>
                    @endcan
                    @can('admin.sites.edit_tariff_list')
                        <td>
                            <a href="{!! route('admin.sites.edit_tariff_list', ['id' => $site->id]) !!}">
                                {{ $site->tariffs->count() }} шт.
                            </a>
                        </td>
                    @endcan
                    @can('admin.languages.index')
                    <td>
                        <a href="{!! route('admin.languages.index', ['site_id' => $site->id]) !!}">
                            {{ $site->languages->count() }} шт.
                        </a>
                    </td>
                    @endcan
                    @can('admin.texts.index')
                    <td>
                        <a href="{!! route('admin.texts.index', ['site_id' => $site->id]) !!}">
                            Тексты
                        </a>
                    </td>
                    @endcan

                    @can('admin.images.index')
                    <td>
                        <a href="{!! route('admin.images.index', ['site_id' => $site->id]) !!}">
                            Картинки
                        </a>
                    </td>
                    @endcan

                    @can('admin.tariffs.site_tariffs')
                    <td>
                        <a href="{!! route('admin.tariffs.site_tariffs', ['site_id' => $site->id]) !!}">
                            Тарифы
                        </a>
                    </td>
                    @endcan

                    @can('admin.local_offices.index')
                    <td>
                        <a href="{!! route('admin.local_offices.index', ['site_id' => $site->id]) !!}">
                            {{ $site->localOffices->count() }} шт.
                        </a>
                    </td>
                    @endcan

                    @can('admin.news_articles.index')
                    <td>
                        <a href="{!! route('admin.news_articles.index', ['site_id' => $site->id]) !!}">
                            Новости
                        </a>
                    </td>
                    @endcan
                    @can('admin.our_workers.index')
                    <td>
                        <a href="{!! route('admin.our_workers.index', ['site_id' => $site->id]) !!}">
                            Сотрудники
                        </a>
                    </td>
                    @endcan
                    @can('admin.feedbacks.index')
                    <td>
                        <a href="{!! route('admin.feedbacks.index', ['site_id' => $site->id]) !!}">
                            Отзывы
                        </a>
                    </td>
                    @endcan
                    @can('admin.support_categories.index')
                        <td>
                            <a href="{!! route('admin.support_categories.index', ['site_id' => $site->id]) !!}">
                                Поддержка
                            </a>
                        </td>
                    @endcan
                    @can('admin.map.index')
                        <td>
                            <a href="{!! route('admin.map.show', ['site' => $site->id]) !!}">
                                Карта
                            </a>
                        </td>
                    @endcan

                    @canany(['admin.sites.edit', 'admin.sites.delete'])
                        <td class="text-nowrap">
                            @can('admin.sites.edit')
                                <a href="{!! route('admin.sites.edit', ['id' => $site->id]) !!}"
                                   class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i> Редактировать</a>
                            @endcan
                            @can('admin.sites.clone_form')
                                <a href="{!! route('admin.sites.clone_form', ['id' => $site->id]) !!}"
                                   class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i> Клонировать</a>
                            @endcan
                            @can('admin.sites.delete')
                                <button type="button" data-text="Удалить {{ $site->domain }}?"
                                        data-action="{!! route('admin.sites.delete') !!}" data-id="{{ $site->id }}"
                                        class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i>
                                    Удалить
                                </button>
                            @endcan
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
