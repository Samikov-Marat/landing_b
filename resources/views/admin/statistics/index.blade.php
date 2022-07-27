@extends('admin.layout')

@section('header')
    Статистика
@endsection

@section('content')
    <form method="get" action="{!! route('admin.statistics.index') !!}">

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>От</label>
                <input type="date" class="form-field js-statistics-send-form" name="filter[date_from]"
                       value="{{ $filter['date_from']->format('Y-m-d') }}">
            </div>
            <div class="form-group col-md-2">
                <label>До</label>
                <input type="date" class="form-field js-statistics-send-form" name="filter[date_to]"
                       value="{{ $filter['date_to']->format('Y-m-d') }}">
            </div>

        </div>


        <div class="form-group">
            <label for="id_domain">Сайт</label>
            <select class="form-select form-control js-statistics-sites-search" name="filter[site]"
                    data-ajax-url="{!! route('admin.statistics.search_sites') !!}">
                @if(isset($filter['site']))
                    <option value="{{ $filter['site'] }}" selected data-old="{{ collect($filter) }}">
                        {{ $filter['site'] }}
                    </option>
                @endif
            </select>

            <small id="id_domain_help" class="form-text text-muted">Сайт</small>
        </div>

        @include('admin.statistics.form_group', ['formGroupName' => 'utm_source', 'select2Class' => 'js-statistics-utm-source-search', 'utmName' => 'utm_source', 'searchRouteName' => 'admin.statistics.search_utm_source'])
        @include('admin.statistics.form_group', ['formGroupName' => 'utm_medium', 'select2Class' => 'js-statistics-utm-medium-search', 'utmName' => 'utm_medium', 'searchRouteName' => 'admin.statistics.search_utm_medium'])
        @include('admin.statistics.form_group', ['formGroupName' => 'utm_campaign', 'select2Class' => 'js-statistics-utm-campaign-search', 'utmName' => 'utm_campaign', 'searchRouteName' => 'admin.statistics.search_utm_campaign'])
        @include('admin.statistics.form_group', ['formGroupName' => 'utm_term', 'select2Class' => 'js-statistics-utm-term-search', 'utmName' => 'utm_term', 'searchRouteName' => 'admin.statistics.search_utm_term'])
        @include('admin.statistics.form_group', ['formGroupName' => 'utm_content', 'select2Class' => 'js-statistics-utm-content-search', 'utmName' => 'utm_content', 'searchRouteName' => 'admin.statistics.search_utm_content'])

    </form>


    <table class="table table-bordered table-hover">
        <tr>
            <th>Сайт</th>
            <th>utm_source</th>
            <th>utm_medium</th>
            <th>utm_campaign</th>
            <th>utm_term</th>
            <th>utm_content</th>
            <th>Кол-во</th>
        </tr>
        @foreach($statistics as $stat)
            <tr>
                <td>{{ $stat->site }}</td>

                <td>
                    @if(isset($stat->utm_source))
                        {{ Str::limit($stat->utm_source ?? '', 30) }}
                    @elseif(isset($detail['utm_source']))
                        <span class="text-secondary">отсутствовал</span>
                    @else
                        <span class="text-secondary">все</span>
                    @endif

                </td>

                <td>
                    @if(isset($stat->utm_medium))
                        {{ Str::limit($stat->utm_medium ?? '', 30) }}
                    @elseif(isset($detail['utm_medium']))
                        <span class="text-secondary">отсутствовал</span>
                    @else
                        <span class="text-secondary">все</span>
                    @endif
                </td>

                <td>
                    @if(isset($stat->utm_campaign))
                        {{ Str::limit($stat->utm_campaign ?? '', 30) }}
                    @elseif(isset($detail['utm_campaign']))
                        <span class="text-secondary">отсутствовал</span>
                    @else
                        <span class="text-secondary">все</span>
                    @endif

                </td>

                <td>
                    @if(isset($stat->utm_term))
                        {{ Str::limit($stat->utm_term ?? '', 30) }}
                    @elseif(isset($detail['utm_term']))
                        <span class="text-secondary">отсутствовал</span>
                    @else
                        <span class="text-secondary">все</span>
                    @endif
                </td>

                <td>
                    @if(isset($stat->utm_content))
                        {{ Str::limit($stat->utm_content ?? '', 30) }}
                    @elseif(isset($detail['utm_content']))
                        <span class="text-secondary">отсутствовал</span>
                    @else
                        <span class="text-secondary">все</span>
                    @endif
                </td>

                <td class="text-right">{!! number_format($stat->count * 1, 0, '.', '&nbsp;') !!}</td>
            </tr>
        @endforeach
    </table>
@endsection
