@extends('admin.layout')

@section('header')
    @isset($localOffice)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Местные офисы'],
        ['text' => isset($localOffice)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.local_offices.save') !!}">
        @csrf
        @if(isset($localOffice))
            <input type="hidden" name="id" value="{{ $localOffice->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_code">Код офиса</label>
            <input type="text" class="form-control" name="code" id="id_code"
                   value="{{ isset($localOffice) ? $localOffice->code : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_code_help" class="form-text text-muted">3 буквы из справочника офисов</small>
        </div>

        <div class="form-group">
            <label for="id_utm_tag">UTM-параметр</label>
            <input type="text" class="form-control" name="utm_tag" id="id_utm_tag"
                   value="{{ isset($localOffice) ? $localOffice->utm_tag : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_utm_tag_help" class="form-text text-muted">UTM параметр, например <q>utm_campaign</q></small>
        </div>

        <div class="form-group">
            <label for="id_utm_value">Значение UTM-параметра</label>
            <input type="text" class="form-control" name="utm_value" id="id_utm_value"
                   value="{{ isset($localOffice) ? $localOffice->utm_value : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_utm_value_help" class="form-text text-muted">Из метрики</small>
        </div>

        <div class="form-group">
            <label for="id_category">Код категории трекинга</label>
            <input type="text" class="form-control" name="category" id="id_category"
                   value="{{ isset($localOffice) ? $localOffice->category : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_category_help" class="form-text text-muted">Строка. Например, <q>es</q> или <q>gb-ipswich</q></small>
        </div>


        <h5>Название на разных языках</h5>

        @php
            $names = [];
            if(isset($localOffice)){
                foreach ($localOffice->localOfficeTexts as $text) {
                    $names[$text->language_id] = $text->name;
                }
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="col">
                    <div class="form-group">
                        <label>{{ $language->name }}</label>
                        <input type="text" class="form-control" name="name[{{ $language->id }}]"
                               value="{{ isset($names[$language->id]) ? $names[$language->id] : '' }}"
                               placeholder="Название" autocomplete="off">
                    </div>
                </div>
            @endforeach
        </div>


        <h5>Адрес на разных языках</h5>

        @php
            $addresses = [];
            if(isset($localOffice)){
                foreach ($localOffice->localOfficeTexts as $text) {
                    $addresses[$text->language_id] = $text->address;
                }
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="col">
                    <div class="form-group">
                        <label>{{ $language->name }}</label>
                        <input type="text" class="form-control" name="address[{{ $language->id }}]"
                               value="{{ isset($addresses[$language->id]) ? $addresses[$language->id] : '' }}"
                               placeholder="Адрес" autocomplete="off">
                    </div>
                </div>
            @endforeach
        </div>


        <h5>Ориентир, подсказка пути на разных языках</h5>

        @php
            $paths = [];
            if(isset($localOffice)){
                foreach ($localOffice->localOfficeTexts as $text) {
                    $paths[$text->language_id] = $text->path;
                }
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="col">
                    <div class="form-group">
                        <label>{{ $language->name }}</label>
                        <input type="text" class="form-control" name="path[{{ $language->id }}]"
                               value="{{ isset($paths[$language->id]) ? $paths[$language->id] : '' }}"
                               placeholder="Ориентир" autocomplete="off">
                    </div>
                </div>
            @endforeach
        </div>

        <h5>Время работы офиса на разных языках</h5>

        @php
            $worktimes = [];
            if(isset($localOffice)){
                foreach ($localOffice->localOfficeTexts as $text) {
                    $worktimes[$text->language_id] = $text->worktime;
                }
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="col">
                    <div class="form-group">
                        <label>{{ $language->name }}</label>
                        <input type="text" class="form-control" name="worktime[{{ $language->id }}]"
                               value="{{ isset($worktimes[$language->id]) ? $worktimes[$language->id] : '' }}"
                               placeholder="Время работы" autocomplete="off">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
