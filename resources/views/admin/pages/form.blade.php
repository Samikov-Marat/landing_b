@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.pages.save') !!}">
        {{ csrf_field() }}
        @if(isset($page))
            <input type="hidden" name="id" value="{{ $page->id }}">
        @endif

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="is_layout" value="1"
                       id="check_is_layout" {{ $page->is_layout?'checked':'' }}
                       class="form-check-input js-page-is-layout-checkbox"
                       data-url_field="#id_url">
                <label for="check_is_layout" class="form-check-label">
                    Фрагмент общей части шаблона (шапка, подвал сайта, меню)
                </label>
            </div>
        </div>


        <div class="form-group">
            <label for="id_url">URL</label>
            <input type="text" class="form-control" name="url" id="id_url"
                   value="{{ isset($page) ? $page->url : '' }}"
                   placeholder="URL" autocomplete="off"
                   required
                {{ $page->is_layout?'disabled':'' }}>
            <small id="id_url_help" class="form-text text-muted">URL</small>
        </div>

        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($page) ? $page->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название страницы</small>
        </div>
        <div class="form-group">
            <label for="id_template">Шаблон</label>
            <input type="text" class="form-control" name="template" id="id_template"
                   value="{{ isset($page) ? $page->template : '' }}"
                   placeholder="путь до файла" autocomplete="off">
            <small id="id_template_help" class="form-text text-muted">Путь до файла</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
