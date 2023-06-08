@extends('admin.layout')

@section('header')
    Валюты
@endsection

@section('content')
    @include('admin.currency.create')
    @foreach($currencies as $currency)
        <form method="post" action="{!! route('admin.currency.update', ['currency' => $currency->code]) !!}">
            @csrf
            @method('PUT')

            <div class="row mt-3 mb-3">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Код валюты</span>
                        <input type="number"
                               class="form-control"
                               aria-describedby="addon-wrapping"
                               value="{{ $currency->code }}"
                               name="code"
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Название</span>
                        <input type="text"
                               class="form-control"
                               aria-describedby="addon-wrapping"
                               value="{{ $currency->name }}"
                               name="name"
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Символ</span>
                        <input type="text"
                               class="form-control"
                               aria-describedby="addon-wrapping"
                               value="{{ $currency->symbol }}"
                               name="symbol"
                        >
                    </div>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </form>
    @endforeach
    {{ $currencies->links() }}
@endsection