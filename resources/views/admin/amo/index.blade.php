@extends('admin.layout')

@section('header')
    AMO CRM
@endsection

@can('admin.amo.auth_form')
    @push('buttons2')
        <a href="{!! route('admin.amo.auth_form') !!}" class="btn btn-primary"><i class="fa fa-user-secret" aria-hidden="true"></i> Ключи и доступы</a>
    @endpush
@endcan

@section('content')




@endsection
