@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariff_translation.save') !!}">
        {{ csrf_field() }}
        @if($translationItem->exists)
            <input type="hidden" name="id" value="{{ $translationItem->id }}">
        @endif
        <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
        <input type="hidden" name="language_code_iso" value="{{ $translationItem->exists ? $translationItem->language_code_iso : $language }}">


        <table class="table table-hover table-bordered">
            <tr>
                <th>Название тарифа</th>
                <th>Перевод</th>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form-control" name="name"
                           value="" disabled></br>
                    <input type="text" class="form-control" name="name"
                           value="{{ $translationItem->exists ? $translationItem->name:'' }}">
                </td>
                <td>
                    <input type="text" class="form-control" name="name"
                           value="" disabled></br>
                    <input type="text" class="form-control" name="name"
                           value="{{ $translationItem->exists ? $translationItem->description:'' }}">
                </td>
            </tr>
        </table>
        {{--        <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">--}}
        {{--        <input type="hidden" name="language_code_iso"--}}
        {{--               value="{{ $translationItem->exists ? $translationItem->language_code_iso : $language }}">--}}
        {{--        <div class="form-group">--}}
        {{--            <label for="id_url">Название тарифа</label>--}}
        {{--            <input type="text" class="form-control" name="name"--}}
        {{--                   value="{{ $translationItem->exists ? $translationItem->name:'' }}"--}}
        {{--                   placeholder="Название тарифа" autocomplete="off"--}}
        {{--                   disabled></div>--}}
        {{--        </br>--}}
        {{--        <input type="text" class="form-control" name="name"--}}
        {{--               value="{{ $translationItem->exists ? $translationItem->name:'' }}"--}}
        {{--               placeholder="Название тарифа" autocomplete="off"--}}
        {{--               required>--}}
        {{--        <small id="id_url_help" class="form-text text-muted">Название</small>--}}
        {{--        </div>--}}

        {{--        <div class="form-group">--}}
        {{--            <label for="id_name">Описание</label>--}}
        {{--            <input type="text" class="form-control" name="description"--}}
        {{--                   value="{{ $translationItem->exists ? $translationItem->description : '' }}"--}}
        {{--                   placeholder="название" autocomplete="off">--}}
        {{--            <small id="id_name_help" class="form-text text-muted">Описание</small>--}}
        {{--        </div>--}}

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
