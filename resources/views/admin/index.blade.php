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

    <h1>Проверка сертификатов</h1>

    <table class="table">
    @foreach($siteCertification as $site)
        <tr>
            <td>{{ $site->id }}</td>
            <td>{{ $site->name }}</td>
            <td>{{ $site->domain }}</td>
            <td>
                @if(isset($site->certificateChecks))
                    @if($site->certificateChecks->error)
                        <div class="alert alert-danger" role="alert">
                            {{ $site->certificateChecks->error }}
                        </div>
                    @else
                        @if($now->greaterThan($site->certificateChecks->valid_to))
                            <div class="alert alert-danger" role="alert">
                                Просрочен
                            </div>
                        @elseif($now->greaterThan($site->certificateChecks->valid_to))
                            <div class="alert alert-warning" role="alert">
                                Будет просрочен в течении месяца
                            </div>
                        @else
                            Годен до {{ $site->certificateChecks->valid_to->format('d.m.Y') }}
                        @endif
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
    </table>

@endsection
