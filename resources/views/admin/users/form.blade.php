@extends('admin.layout')
@section('buttons')
@endsection


@section('content')

    <form method="post" action="{!! route('admin.users.save') !!}">
        @csrf
        @if(isset($user))
            <input type="hidden" name="id" value="{{ $user->id }}">
        @endif

        <div class="form-group">
            <label for="id_name">Имя</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($user) ? $user->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Понятное название сайта</small>
        </div>
        <div class="form-group">
            <label for="id_email">Email</label>
            <input type="text" class="form-control" name="email" id="id_email"
                   value="{{ isset($user) ? $user->email : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_email_help" class="form-text text-muted">Понятное название сайта</small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
