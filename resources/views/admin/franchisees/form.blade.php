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
            <label for="id_text">Описание, заметки</label>
            <textarea class="form-control" id="id_text" name="text"
                      rows="7">{{ $franchisee->exists ? $franchisee->description : '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
