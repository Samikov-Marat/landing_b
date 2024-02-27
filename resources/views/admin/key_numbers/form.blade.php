@extends('admin.layout')

@section('header')
    @if($keyNumber->exists)
        Редактирование псевдонима
    @else
        Добавление псевдонима
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.key_numbers.index'), 'text' => 'Ключевые числа'],
        ['text' => $keyNumber->exists?'Редактирование':'Добавление'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.key_numbers.save') !!}">
        @csrf
        @if($keyNumber->exists)
            <input type="hidden" name="id" value="{{ $keyNumber->id }}">
        @endif

        <div class="form-group">
            <label for="id_name">Системное имя</label>
            <input type="text" class="form-control" name="shortname" id="id_shortname"
                   value="{{ $keyNumber->exists ? $keyNumber->shortname : '' }}"
            @if($keyNumber->exists)
                readonly
            @endif
                   placeholder="Системное имя" autocomplete="off">
            <small id="id_shortname_help" class="form-text text-muted">Системное имя</small>
        </div>

        <div class="form-group">
            <label for="id_name">Значение</label>
            <input type="text" class="form-control" name="value" id="id_value"
                   value="{{ $keyNumber->exists ? $keyNumber->value : '' }}"
                   placeholder="Значение" autocomplete="off">
            <small id="id_value_help" class="form-text text-muted">Значение</small>
        </div>

        <div class="form-group">
            <label for="id_name">Описание</label>
            <input type="text" class="form-control" name="description" id="id_description"
                   value="{{ $keyNumber->exists ? $keyNumber->description : '' }}"
                   placeholder="Описание" autocomplete="off">
            <small id="id_description_help" class="form-text text-muted">Описание</small>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
