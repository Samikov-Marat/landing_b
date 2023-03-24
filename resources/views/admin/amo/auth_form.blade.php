@extends('admin.layout')

@section('content')

    <div class="px-5 py-5">
        <ol>
            <li>В АМО зайти в <a href="https://cdeknew.amocrm.ru/amo-market" target="_blank">АМО-маркет</a>.</li>
            <li>Найти во вкладке "Установленные" нужную интеграцию.</li>
            <li>Если интеграции нет - создать её. Меню в виде трёх точек в верхней правой части экрана.</li>
            <li>Взять из интеграции все нужные данные.</li>
        </ol>
        Подробнее: <a href="https://www.amocrm.ru/developers/content/oauth/step-by-step" target="_blank">пример по шагам</a><br>
        <span class="badge badge-danger">Внимание!</span> При использовании одной интеграции на разных серверах, проектах, работать будет только на одной (последней удачно настроенной).
    </div>

    <form method="post" action="{!! route('admin.amo.auth_save') !!}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="id_client_secret">Секретный ключ</label>
            <input type="text" class="form-control" name="client_secret" id="id_client_secret"
                   value="{{ $clientSecret }}"
                   autocomplete="off"
                   required>
        </div>


        <div class="form-group">
            <label for="id_client_id">ID интеграции</label>
            <input type="text" class="form-control" name="client_id" id="id_client_id"
                   value="{{ $clientId }}"
                   autocomplete="off"
                   required>
        </div>


        <div class="form-group">
            <label for="id_authorization_code">Код авторизации (действителен 20 минут)</label>
            <input type="text" class="form-control" name="authorization_code" id="id_authorization_code"
                   value=""
                   autocomplete="off"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Обновить токен</button>
    </form>

@endsection
