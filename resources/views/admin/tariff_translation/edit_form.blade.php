@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.tariff_translation.save') !!}">
        {{ csrf_field() }}
        {{--        @dump($translationItems)--}}
        @foreach($translationItems as $translationItem)
            {{--            @if($translationItem->exists)--}}
            {{--                <input type="hidden" name="id" value="{{ $translationItem->id }}">--}}
            {{--            @endif--}}
            {{--            <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">--}}
            {{--            <input type="hidden" name="language_code_iso"--}}
            {{--                   value="{{ $language }}">--}}
            <div class="row">
                @dump($translationItem->language_code_iso)
                @if($translationItem->language_code_iso == config('app.tariff_default_language'))
                    <div class="form-group col">
                        <label>Название тарифа {{ config('app.tariff_default_language') }}</label>
                        <input type="text" class="form-control"

                               placeholder="{{ $translationItem->name}}" autocomplete="off" disabled>
                        <label>Описание тарифа {{ config('app.tariff_default_language') }}</label>
                        <input type="text" class="form-control"
                               placeholder="{{ $translationItem->description }}" autocomplete="off" disabled>
                    </div>
                @endif

                @if($translationItem->language_code_iso == $language)
                    <div class="form-group col">
                        <input type="hidden" name="id" value="{{ $translationItem->id }}">
                        <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
                        <input type="hidden" name="language_code_iso"
                               value="{{ $language }}">
                        <label>Название тарифа {{ $language }}</label>
                        <input type="text" class="form-control" name="name"
                               value="{{$translationItem->name }}"
                               placeholder="Название" autocomplete="off">
                        <label>Описание тарифа {{ $language }}</label>
                        <input type="text" class="form-control" name="description"
                               value="{{ $translationItem->description}}"
                               placeholder="Описание" autocomplete="off">
                    </div>
                @else
                    <div class="form-group col">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
                        <input type="hidden" name="language_code_iso"
                               value="{{ $language }}">
                        <label>Название тарифа {{ $language }}</label>
                        <input type="text" class="form-control" name="name"
                               value=""
                               placeholder="Название" autocomplete="off" required>
                        <label>Описание тарифа {{ $language }}</label>
                        <input type="text" class="form-control" name="description"
                               value=""
                               placeholder="Описание" autocomplete="off" required>
                    </div>
                @endif
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
