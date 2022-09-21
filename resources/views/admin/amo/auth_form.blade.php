@extends('admin.layout')

@section('content')

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
