@extends('admin.layout')

@section('header')
    Валюта лендинга
@endsection

@section('content')
    <form method="post" action="{!! route('admin.site.currency.update', ['site' => $site]) !!}">
        @csrf
        @method('PUT')
        @foreach($currencies as $currency)
            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="currencyCode"
                       id="{{ $currency->code }}"
                       value="{{ $currency->code }}"
                       {{ $currency->code === $currentCurrency->code ? 'checked' : '' }}
                >
                <label class="form-check-label" for="{{ $currency->code }}">
                    {{ $currency->symbol }} / {{ $currency->name }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
    </form>
@endsection