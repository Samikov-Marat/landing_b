@extends('admin.layout')

@section('content')
    <form method="post" action="{!! route('admin.roles.save') !!}">
        {{ csrf_field() }}
        @if(isset($role))
            <input type="hidden" name="id" value="{{ $role->id }}">
        @endif

        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($role) ? $role->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название роли</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
