@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.sites.add') !!}" class="btn btn-primary">+ Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    <form method="post" action="{!! route('admin.sites.save') !!}">
        {{ csrf_field() }}
        @if(isset($site))
            <input type="hidden" name="id" value="{{ $site->id }}">
        @endif

        <div class="form-group">
            <label for="id_domain">Домен</label>
            <input type="text" class="form-control" name="domain" id="id_domain"
                   value="{{ isset($site) ? $site->domain : '' }}" placeholder="домен">
            <small id="id_domain_help" class="form-text text-muted">Адрес сайта, доменное имя</small>
        </div>
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($site) ? $site->name : '' }}"
                   placeholder="название">
            <small id="id_name_help" class="form-text text-muted">Понятное название сайта</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
