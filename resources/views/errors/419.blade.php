@extends('errors::custom-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message')
    Страница с формой была открыта слишком долго.<br>
    Вернитесь и заполните форму снова
@endsection
