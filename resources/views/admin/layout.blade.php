@extends('adminlte::page')

@section('title', 'Лендинг. Админка.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('content_header')
    @include('admin.content_header')
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('js')
    <script src="{{ mix('admin_files/new_admin.js') }}"></script>
@stop

@section('footer')
    @include('admin.delete_confirm')
@stop
