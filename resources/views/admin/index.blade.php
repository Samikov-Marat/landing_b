@extends('admin.layout')

@section('content')

    Главная страница админки.

    @foreach($problems['absentOffice'] as $site)
        <div class="alert alert-danger">
            <h4 class="alert-heading">На сайте нет ни одного офиса</h4>
            <p>
                {{ $site->domain }} {{ $site->name }}
            </p>
            <hr>
            <p class="mb-0">
                При заполнении и отправке форм произойдёт ошибка
            </p>
        </div>
    @endforeach

    @foreach($problems['absentOfficeCategory'] as $site)
        @foreach($site->localOffices as $office)
            <div class="alert alert-danger">
                <h4 class="alert-heading">В одном из офисов не указана категория</h4>
                <p>
                    {{ $site->domain }} {{ $site->name }}<br>
                    Офисе {{ $office->code }}
                </p>
                <hr>
                <p class="mb-0">
                    При заполнении и отправке форм произойдёт ошибка
                </p>
            </div>
        @endforeach
    @endforeach

@endsection
