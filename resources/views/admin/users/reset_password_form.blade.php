@extends('admin.layout')


@section('header')
    Обновление пароля
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.users.index'), 'text' => 'Пользователи'],
        ['text' => 'Обновление пароля'],
    ]])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">{{ $user->email }}</p>
            <form method="post" action="{!! route('admin.users.reset_password') !!}" class="d-inline">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-primary">Обновить пароль</button>
            </form>

        </div>
    </div>
@endsection
