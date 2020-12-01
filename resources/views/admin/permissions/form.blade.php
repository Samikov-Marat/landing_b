@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.permissions.save') !!}">
        {{ csrf_field() }}
        @if(isset($permission))
            <input type="hidden" name="text_id" value="{{ $permission->text_id }}">
            <input type="hidden" name="mode" value="old">
        @else
            <div class="form-group">
                <label for="id_text_id">Уникальный ключ</label>
                <input type="text" class="form-control" name="text_id" id="id_text_id"
                       value=""
                       placeholder="module.permission" autocomplete="off">
                <small id="id_name_help" class="form-text text-muted">Английский язык, нижний регистр. Точка и
                    подчёркивание.</small>
            </div>
            <input type="hidden" name="mode" value="new">
        @endif

        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($permission) ? $permission->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название права</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
