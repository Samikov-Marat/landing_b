@extends('admin.layout')

@section('header')
    Страница поддержки. Категории.
@endsection

@can('admin.support_categories.add')
    @push('buttons2')
        <a href="{!! route('admin.support_categories.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i>
            Создать</a>
    @endpush
@endcan

@section('content')

    @if($tree->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Название
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @include('admin.support_categories.branch', ['site' => $site, 'tree' => $tree, 'level' => 0])
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif

@endsection
