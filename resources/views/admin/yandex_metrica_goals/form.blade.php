@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.yandex_metrica_goals.save') !!}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if(isset($yandexMetricaGoal))
            <input type="hidden" name="id" value="{{ $yandexMetricaGoal->id }}">
        @endif

        <div class="form-group">
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
            <label for="id_name">Название</label>
            <input type="text" class="form-control" name="name" id="id_name"
                   value="{{ isset($yandexMetricaGoal) ? $yandexMetricaGoal->name : '' }}"
                   placeholder="Кодовое название цели" autocomplete="off">
            <small id="id_name_help" class="form-text text-muted">Название цели</small>
        </div>

        <div class="form-group">
            <label for="id_description">Описание</label>
            <textarea class="form-control" id="id_description" name="description"
                      rows="3">{{ isset($yandexMetricaGoal) ? $yandexMetricaGoal->description : '' }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
