@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.yandex_metrica_goals.clone_goals_to_yandex') !!}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="token_id" value="{{ $token->id }}">
        <div class="form-group">
            <label>Проект админки (набор целей)</label>
            <div class="form-check">
                @php
                    $forId = 'project_1';
                @endphp
                <input class="form-check-input" type="radio" name="project_id" id="{{ $forId }}"
                       value="1" required checked>
                <label class="form-check-label" for="{{ $forId }}">Лендинги стран</label>
            </div>
        </div>

        <div class="form-group">
            <label>Счётчик в котором создать цели {{ $token->login . '@yandex.ru' }}</label>
            @foreach($counters as $k => $counter)
                @php
                    $forId = 'counter_' . $k;
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="counter_id[]" value="{{ $counter['id'] }}" id="{{ $forId }}">
                    <label class="form-check-label" for="{{ $forId }}">
                        {{ $counter['name'] }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Создать цели</button>
    </form>


@endsection
