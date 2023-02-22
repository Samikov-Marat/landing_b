@extends('admin.layout')

@section('header')
    Редактирование текста
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.franchisee_admin.texts.index'), 'text' => 'Тексты сайта'],
        ['text' => 'Редактирование'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.franchisee_admin.texts.save') !!}">
        @csrf
        <input type="hidden" name="site_id" value="{{ $site->id }}">
        <input type="hidden" name="text_type_id" value="{{ $textType->id }}">

        @php
            $textsByLanguage = $textType->texts->keyBy('language_id');
            $franchiseeTextsByLanguage = $textType->franchiseeTexts->keyBy('language_id');
        @endphp
        @foreach($site->languages as $language)
            @php
                $labelId = 'id-language-' . $language->id;
                if($franchiseeTextsByLanguage->has($language->id)){
                    $value = $franchiseeTextsByLanguage->get($language->id)->value;
                }
                elseif($textsByLanguage->has($language->id)){
                    $value = $textsByLanguage->get($language->id)->value;
                }
                else{
                    $value = '';
                }
            @endphp

            <div class="form-group">
                <label for="{{ $labelId }}">{{ $language->name }}</label>
                <textarea class="form-control" id="{{ $labelId }}" name="values[{{ $language->id }}]"
                          rows="7">{{ $value }}</textarea>
            </div>

        @endforeach

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
