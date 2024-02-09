@extends('admin.layout')

@section('header')
    Загрузка списка uuid
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['text' => 'Загрузка списка uuid'],
    ]])
@endsection

@section('content')
    @if($showMessage)
        <div class="alert alert-success js-office-esb-old" role="alert">
            Файл загружен
        </div>
    @endif

    Сейчас загружено {{ $officeUuidCount }} uuid

    <form method="post" action="{!! route('admin.office_esb.save') !!}" enctype="multipart/form-data" class="js-office-esb-form">
        @csrf
        <div class="form-group">
            <label for="id_csv_file">CSV файл с UUID</label>
            <input name="file" type="file" class="form-control-file js-office-esb-file" id="id_csv_file" required>
        </div>
        <button type="submit" class="btn btn-primary js-office-esb-submit">Запросить данные</button>
    </form>
    <div class="alert alert-info d-none js-office-esb-process" role="alert">
        Файл загружается. Ждём...
    </div>

@endsection
