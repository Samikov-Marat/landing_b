@extends('admin.layout')

@section('header')
    Карта
@endsection

@section('content')
    @foreach($sites as $site)
        <div class="row">
            <a href="{{ route('admin.map.show', ['site' => $site]) }}" class="btn btn-link">{{ $site->name }} | {{ $site->domain }}</a>
        </div>
    @endforeach
@endsection