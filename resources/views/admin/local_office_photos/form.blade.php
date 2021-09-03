@extends('admin.layout')

@section('header')
    @isset($localOfficePhoto)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Локальные офисы'],
        ['text' => $localOffice->code],
        ['text' => 'Фотографии локальных офисов'],
        ['text' => isset($localOfficePhoto)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    <form method="post" action="{!! route('admin.local_office_photos.save') !!}" enctype="multipart/form-data">
        @csrf
        @if(isset($localOfficePhoto))
            <input type="hidden" name="id" value="{{ $localOfficePhoto->id }}">
        @endif
        <input type="hidden" name="local_office_id" value="{{ $localOffice->id }}">

        <div class="form-group">
            <label for="id_sample">Основной размер 599x400</label>
            <input type="file" name="sample" class="form-control-file" id="id_sample">
            {{ isset($localOfficePhoto, $localOfficePhoto->sample) ? $localOfficePhoto->sample : '' }}
        </div>

        <div class="form-group">
            <label for="id_sample2">Основной размер двойной 1198x800</label>
            <input type="file" name="sample2" class="form-control-file" id="id_sample2">
            {{ isset($localOfficePhoto, $localOfficePhoto->sample2) ? $localOfficePhoto->sample2 : '' }}
        </div>

        <div class="form-group">
            <label for="id_mobile">Мобильный 320x280</label>
            <input type="file" name="mobile" class="form-control-file" id="id_mobile">
            {{ isset($localOfficePhoto, $localOfficePhoto->mobile) ? $localOfficePhoto->mobile : '' }}
        </div>

        <div class="form-group">
            <label for="id_mobile2">Мобильный двойной 640x559</label>
            <input type="file" name="mobile2" class="form-control-file" id="id_mobile2">
            {{ isset($localOfficePhoto, $localOfficePhoto->mobile2) ? $localOfficePhoto->mobile2 : '' }}
        </div>

        <div class="form-group">
            <label for="id_tablet">Планшетный 320x280</label>
            <input type="file" name="tablet" class="form-control-file" id="id_tablet">
            {{ isset($localOfficePhoto, $localOfficePhoto->tablet) ? $localOfficePhoto->tablet : '' }}
        </div>

        <div class="form-group">
            <label for="id_tablet2">Планшетный двойной 640x559</label>
            <input type="file" name="tablet2" class="form-control-file" id="id_tablet2">
            {{ isset($localOfficePhoto, $localOfficePhoto->tablet2) ? $localOfficePhoto->tablet2 : '' }}
        </div>


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
