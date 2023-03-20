@extends('admin.layout')

@section('content')

    <i class="fa fa-arrow-left" aria-hidden="true"></i>
    Меню слева.

    @can('admin.index.errors')
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

    @foreach($problems['textsDoubles'] as $textsDoubles)
            <div class="alert alert-danger">
                <h4 class="alert-heading">Дублирование текстов</h4>
                <p>
                    text_type_id {{ $textsDoubles->text_type_id }}<br>
                    language_id {{ $textsDoubles->language_id }}
                </p>
                <hr>
                <p class="mb-0">
                    Могут быть не видны изменения текста.
                </p>
            </div>
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
                        <span class="badge badge-danger">
                            {{ $site->certificateChecks->error }}
                        </span>
                    @else
                        @if($now->greaterThan($site->certificateChecks->valid_to))
                            <span class="badge badge-danger">
                                Просрочен
                            </span>
                        @elseif($tooClose->greaterThan($site->certificateChecks->valid_to))
                            <span class="badge badge-warning">
                                Будет просрочен в течении недели. Годен до {{ $site->certificateChecks->valid_to->format('d.m.Y') }}
                            </span>
                        @endif
                    @endif
                @endif
            </td>
            <td>
                @if(isset($site->certificateChecks))
                    @if(!$site->certificateChecks->error)
                        Годен до {{ $site->certificateChecks->valid_to->format('d.m.Y') }}
                    @endif
                @endif

            </td>
        </tr>
    @endforeach
    </table>
@endcan
@endsection
