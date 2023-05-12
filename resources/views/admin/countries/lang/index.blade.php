@extends('admin.layout')

@section('header')
    Переводы стран
@endsection

@section('content')
    <a href="{{ route('countries.index') }}" class="mb-3 d-block"><< Назад</a>
    <div class="accordion" id="accordionExample">
        @foreach($sites as $site)
            <div class="card">
                <div class="card-header" id="heading{{ $site->id }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $site->id }}" aria-expanded="true" aria-controls="collapseOne">
                            {{ $site->name }} ({{ $site->domain }})
                        </button>
                    </h2>
                </div>

                <div id="collapse{{ $site->id }}" class="collapse" aria-labelledby="heading{{ $site->id }}" data-parent="#accordionExample">
                    <div class="card-body">
                            @foreach($site->languages as $language)
                                <div class="mb-3">
                                    <form method="post" action="{{ route('lang.update', ['country' => $countryId, 'lang' => $language->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-10">
                                                <label for="exampleFormControlInput1" class="form-label">{{ $language->shortname }} / {{ $language->name }}</label>

                                                @if($countriesTexts[$language->id])
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="lang" value="{{$countriesTexts[$language->id]}}">
                                                @else
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="lang" value="">
                                                @endif
                                            </div>
                                            <div class="col-2 mb-0 mt-auto">
                                                <button type="submit" class="btn btn-secondary">Обновить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection