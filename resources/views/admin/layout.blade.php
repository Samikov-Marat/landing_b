@extends('adminlte::page')

@section('title', 'Лендинг. Админка.')

@section('content_header')
    @include('admin.content_header')
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

{{--@section('css')--}}
{{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
{{--@stop--}}

@section('js')
    <script src="/admin_files/admin.js"></script>
    <script src="/admin_files/texts.js"></script>
@stop

@section('footer')
    @include('admin.delete_confirm')
@stop
