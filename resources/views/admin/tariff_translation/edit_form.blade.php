@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariff_translation.save') !!}">
        {{ csrf_field() }}
        @if($translationItems->isNotEmpty())
            @foreach($translationItems as $translationItem)
                <input type="hidden" name="id" value="{{ $translationItem->id }}">
                <input type="hidden" name="tariff_id" value="{{ $translationItem->tariff_id }}">
                <input type="hidden" name="language_code_iso" value="{{ $translationItem->language_code_iso }}">
                <div class="form-group">
                    <label for="id_url">Название тарифа</label>
                    <input type="text" class="form-control" name="name"
                           value="{{ $translationItem->name }}"
                           placeholder="Название тарифа" autocomplete="off"
                           required>
                    <small id="id_url_help" class="form-text text-muted">Описание</small>
                </div>

                <div class="form-group">
                    <label for="id_name">Описание</label>
                    <input type="text" class="form-control" name="description"
                           value="{{ $translationItem->description }}"
                           placeholder="название" autocomplete="off">
                    <small id="id_name_help" class="form-text text-muted">Описание</small>
                </div>
            @endforeach
        @else
            <input type="hidden" name="tariff_id" value="{{ $id }}">
            <input type="hidden" name="language_code_iso" value="{{ $language }}">
            <div class="form-group">
                <label for="id_url">Название тарифа</label>
                <input type="text" class="form-control" name="name"
                       value=""
                       placeholder="Название тарифа" autocomplete="off"
                       required>
                <small id="id_url_help" class="form-text text-muted">Описание</small>
            </div>
            <div class="form-group">
                <label for="id_name">Описание</label>
                <input type="text" class="form-control" name="description"
                       value=""
                       placeholder="название" autocomplete="off">
                <small id="id_name_help" class="form-text text-muted">Описание</small>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
