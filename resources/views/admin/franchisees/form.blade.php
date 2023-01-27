@extends('admin.layout')

@section('header')
    @if($franchisee->exists)
        Редактирование франчайзи
    @else
        Добавление франчайзи
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.franchisees.index'), 'text' => 'Франчайзи'],
        ['text' => $franchisee->exists?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')

    <form method="post" action="{!! route('admin.franchisees.save') !!}">
        {{ csrf_field() }}
        @if($franchisee->exists)
            <input type="hidden" name="id" value="{{ $franchisee->id }}">
        @endif
        <div class="form-group">
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ $franchisee->exists ? $franchisee->name : '' }}"
                   placeholder="название" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Название</small>
        </div>

        <div class="form-group">
            <label for="id_description">Описание, заметки</label>
            <textarea class="form-control" id="id_description" name="description"
                      rows="7">{{ $franchisee->exists ? $franchisee->description : '' }}</textarea>
        </div>


        @if(!$franchisee->exists)
        <div class="form-group form-check">
            <input type="checkbox" name="add_user" class="form-check-input js-franchisees-user-handler" id="id_add_user">
            <label class="form-check-label" for="id_add_user">Добавить пользователя</label>
        </div>

        <div class="form-group d-none js-franchisees-user-hidden">
            <label for="id_user_name">Имя</label>
            <input type="text" class="form-control" name="user_name" id="id_user_name"
                   value=""
                   placeholder="Имя и фамилия пользователя" autocomplete="off">
            <small id="id_user_name_help" class="form-text text-muted">Имя и фамилия пользователя</small>
        </div>
        <div class="form-group d-none js-franchisees-user-hidden">
            <label for="id_user_email">Email</label>
            <input type="email" class="form-control" name="user_email" id="id_user_email"
                   value=""
                   placeholder="email" autocomplete="off">
            <small id="id_user_email_help" class="form-text text-muted">email</small>
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
