@extends('admin.layout')

@section('header')
    Логины Яндекс-метрики
@endsection

@section('content')

    <h2>Список авторизованных пользователей</h2>
    <ul class="list-group">
        @foreach($tokens as $token)
            <li class="list-group-item">
                <a href="{!! route('admin.yandex_metrica_goals.yandex_form', ['token_id' => $token->id]) !!}">
                    {{ $token->login . '@yandex.ru' }}
                </a>
            </li>
        @endforeach
        <li class="list-group-item">
            <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id=0180b7d8d6684cabbeaba0a7fd26975d"
            >Новая авторизация</a> (пользователя нет в списке)
        </li>
    </ul>

@endsection
