@extends('admin.layout')

@section('header')
    @if($supportCategory->exists)
        Редактирование категории вопросов
    @else
        Добавление категории вопросов
    @endisset
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['href' => route('admin.support_categories.index', ['site_id' => $site->id]), 'text' => 'Техподдержка. Категории'],
        ['text' => $supportCategory->exists ? 'Редактирование' : 'Добавление'],
    ]])
@endsection


@section('content')

    <form method="post" action="{!! route('admin.support_categories.save') !!}">
        @csrf
        <input type="hidden" name="site_id" value="{{ $site->id }}">

        @if($supportCategory->exists && !is_null($supportCategory->parent_id))
            {{-- Редактирование не корневой категории --}}
            <input type="hidden" name="parent_id" value="{{ $supportCategory->parent_id }}">
        @elseif(!is_null($parent_id))
            {{-- Добавление не корневой категории --}}
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
        @endif

        @if($supportCategory->exists)
            <input type="hidden" name="id" value="{{ $supportCategory->id }}">
        @endif

        <div class="form-group">
            <label for="id_name">Родительская категория</label>
            <select class="form-select form-control" name="parent_id">
                <option value="root" title="Воображаемый корневой узел, к которому относятся категории 1 уровня">Корень</option>
                @include('admin.support_categories.select', ['tree' => $tree, 'level' => 0])
            </select>
        </div>

        <h5>Название на разных языках</h5>
        @php
            if($supportCategory->exists){
                $names = $supportCategory->supportCategoryTexts->pluck('name', 'language_id');
            }
            else{
                $names=collect();
            }
        @endphp

        <div class="row">
            @foreach($site->languages as $language)
                <div class="form-group col">
                    <label>{{ $language->name }}</label>
                    <input type="text" class="form-control" name="name[{{ $language->id }}]"
                           value="{{  $names->has($language->id) ? $names[$language->id] : '' }}"
                           placeholder="Название" autocomplete="off">
                </div>
            @endforeach
        </div>



        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
