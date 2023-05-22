@extends('admin.layout')

@section('header')
    @isset($localOffice)
        Редактирование
    @else
        Добавление
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Местные офисы'],
        ['text' => isset($localOffice)?'Редактирование':'Добавление'],
    ]])
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{!! route('admin.local_offices.update', ['site' => $site, 'localOffice' => $localOffice]) !!}">
        @csrf
        @method('put')
        @if(isset($localOffice))
            <input type="hidden" name="id" value="{{ $localOffice->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="disabled" value="1"
                   id="disabled_checkbox" {{ isset($localOffice) && $localOffice->disabled ? 'checked' : '' }}>
            <label class="form-check-label" for="disabled_checkbox">
                Скрыть
            </label>
        </div>

        <div class="form-group">
            <label for="id_code">Код офиса</label>
            <input type="text" class="form-control" name="code" id="id_code"
                   value="{{ isset($localOffice) ? $localOffice->code : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_code_help" class="form-text text-muted">4 буквы из справочника офисов</small>
        </div>

        <div class="form-group">
            <label for="id_subdomain">Поддомен</label>
            <input type="text" class="form-control" name="subdomain" id="id_subdomain"
                   value="{{ isset($localOffice) ? $localOffice->subdomain : '' }}"
                   placeholder="Поддомен" autocomplete="off">
            <small id="id_subdomain_help" class="form-text text-muted">Как правило, код офиса в нижнем регистре</small>
        </div>

        <div class="form-group">
            <label for="id_map_preset">Настройки карты поддомена</label>
            <textarea type="text" class="form-control" name="map_preset" id="id_map_preset"
                      placeholder="Настройки карты поддомена"
                      autocomplete="off">{{ isset($localOffice) ? $localOffice->map_preset : '' }}</textarea>
            <small id="id_map_preset_help" class="form-text text-muted">JSON для Yandex-карты</small>
        </div>

        {{-- форму разбил на несколько файлов для группировки по вкладкам --}}
        @include('admin.local_offices.form_utm')
        @include('admin.local_offices.form_texts')
        @include('admin.local_offices.form_phones')
        @include('admin.local_offices.form_emails')

        <div class="form-group col-md-6">
            <label for="id_franchisee_id">Франчайзи</label>
            <select class="form-select form-control js-select2-local-office-franchisee" name="franchisee_id"
                    id="id_franchisee_id">
                @php
                    $selected = (isset($localOffice) && !is_null($localOffice->franchisee_id))?'':'selected';
                @endphp
                <option value="0" {{ $selected }}>Нет</option>
                @foreach($franchisees as $franchisee)
                    @php
                        $selected = (isset($localOffice) && ($franchisee->id == $localOffice->franchisee_id))?'selected':'';
                    @endphp
                    <option value="{{ $franchisee->id }}" {{ $selected }}>
                        {{ $franchisee->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <div class="d-none js-local-office-phone-template">
        @include('admin.local_offices.form_phones_item', ['phone'=>null, 'name' => 'phone_new'])
    </div>

    <div class="d-none js-local-office-email-template">
        @include('admin.local_offices.form_emails_item', ['email'=>null, 'name' => 'email_new'])
    </div>

@endsection
