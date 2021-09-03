@extends('admin.layout')

@section('header')
    @isset($ourWorker)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Наши сотрудники'],
        ['text' => isset($ourWorker)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.our_workers.save') !!}" enctype="multipart/form-data">
        @csrf
        @if(isset($ourWorker))
            <input type="hidden" name="id" value="{{ $ourWorker->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_photo">Фото</label>
            <input type="file" name="photo" class="form-control-file" id="id_photo">
            {{ isset($ourWorker, $ourWorker->photo) ? $ourWorker->photo : '' }}
        </div>

        @include('admin.our_workers.form_texts')

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
