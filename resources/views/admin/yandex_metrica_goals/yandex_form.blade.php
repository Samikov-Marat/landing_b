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
                <div class="form-check">
                    @php
                        $forId = 'counter_' . $k;
                    @endphp
                    <input class="form-check-input" type="radio" name="counter_id" id="{{ $forId }}"
                           value="{{ $counter['id'] }}" required>
                    <label class="form-check-label" for="{{ $forId }}">{{ $counter['name'] }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Создать цели</button>
    </form>


@endsection
