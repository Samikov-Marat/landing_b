@extends('admin.layout')

@section('header')
    Сайты
@endsection

@section('content')
    <div class="row">
        @foreach ($errors->all() as $error)
            <h3 class="text-danger">{{ $error }}</h3>
        @endforeach
    </div>
    <form class="mb-3" method="get" action="{{ route('countries.create') }}">
        @csrf
        <div class="row">
            <div class="col-5">
                <input type="text" id="inputText" class="form-control" name="jira_code" value="">
            </div>

            <div class="col-auto d-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedSend" name="can_send">
                    <label class="form-check-label" for="flexCheckCheckedSend">
                        Страна отправитель
                    </label>
                </div>
            </div>

            <div class="col-auto d-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedReceive" name="can_receive">
                    <label class="form-check-label" for="flexCheckCheckedReceive">
                        Страна получатель
                    </label>
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-success">Создать</button>
            </div>
        </div>
    </form>
    @foreach($countries as $country)
        <form class="mb-1" method="post" action="{{ route('countries.update', ['country' => $country->id])  }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-5">
                    <input type="text" id="inputText" class="form-control" name="jira_code" value="{{ $country->jira_code }}">
                </div>

                <div class="col-auto d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedSend" name="can_send" {{ $country->can_send ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckCheckedSend">
                            Страна отправитель
                        </label>
                    </div>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedReceive" name="can_receive" {{ $country->can_receive ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckCheckedReceive">
                            Страна получатель
                        </label>
                    </div>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('lang.index', ['country' => $country->id]) }}" class="btn btn-link">Переводы</a>
                </div>
            </div>
        </form>
    @endforeach
@endsection