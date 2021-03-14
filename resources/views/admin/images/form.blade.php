@extends('admin.layout')

@section('header')
    @isset($image)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Картинки'],
        ['text' => isset($image)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.images.save') !!}" enctype="multipart/form-data">
        @csrf
        @if(isset($image))
            <input type="hidden" name="id" value="{{ $image->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_url">URL (после /images)</label>
            <input type="text" class="form-control" name="url" id="id_url"
                   value="{{ isset($image) ? $image->url : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_url_help" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
            <label for="id_page_id">Страница</label>
            <input type="text" class="form-control" name="page_id" id="id_page_id"
                   value="{{ isset($image) ? $image->page_id : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_page_id_help" class="form-text text-muted">Пока id страницы</small>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Из файла</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Выбрать файл на диске</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
