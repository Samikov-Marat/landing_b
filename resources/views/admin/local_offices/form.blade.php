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
    <form method="post" action="{!! route('admin.local_offices.save') !!}">
        @csrf
        @if(isset($localOffice))
            <input type="hidden" name="id" value="{{ $localOffice->id }}">
        @endif
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <div class="form-group">
            <label for="id_code">Код офиса</label>
            <input type="text" class="form-control" name="code" id="id_code"
                   value="{{ isset($localOffice) ? $localOffice->code : '' }}"
                   placeholder="Обозначение" autocomplete="off">
            <small id="id_code_help" class="form-text text-muted">4 буквы из справочника офисов</small>
        </div>

        {{-- форму разбил на несколько файлов для группировки по вкладкам --}}
        @include('admin.local_offices.form_utm')
        @include('admin.local_offices.form_texts')
        @include('admin.local_offices.form_phones')
        @include('admin.local_offices.form_emails')


        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <div class="d-none js-local-office-phone-template">
        @include('admin.local_offices.form_phones_item', ['phone'=>null, 'name' => 'phone_new'])
    </div>

    <div class="d-none js-local-office-email-template">
        @include('admin.local_offices.form_emails_item', ['email'=>null, 'name' => 'email_new'])
    </div>


@endsection
