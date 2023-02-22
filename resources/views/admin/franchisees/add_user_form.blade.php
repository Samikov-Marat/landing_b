@extends('admin.layout')

@section('header')
    Добавление редактора
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.franchisees.index'), 'text' => 'Франчайзи'],
        ['text' => 'Добавление редактора'],
    ]])
@endsection

@section('content')

    <form method="post" action="{!! route('admin.franchisees.save_user') !!}">
        {{ csrf_field() }}
        <input type="hidden" name="franchisee_id" value="{{ $franchisee->id }}">

        <div class="form-group">
            <label for="id_user_name">Имя</label>
            <input type="text" class="form-control" name="user_name" id="id_user_name"
                   value=""
                   placeholder="Имя и фамилия пользователя" autocomplete="off">
            <small id="id_user_name_help" class="form-text text-muted">Имя и фамилия пользователя</small>
        </div>
        <div class="form-group">
            <label for="id_user_email">Email</label>
            <input type="email" class="form-control" name="user_email" id="id_user_email"
                   value=""
                   placeholder="email" autocomplete="off">
            <small id="id_user_email_help" class="form-text text-muted">email</small>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
