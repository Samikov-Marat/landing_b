@extends('admin.layout')
@section('buttons')
    <div class="float-right">
        <a href="{!! route('admin.sites.add') !!}" class="btn btn-primary">+ Создать</a>
    </div>
    <div class="clearfix"></div>
@endsection


@section('content')

    <form method="post" action="{!! route('admin.sites.save_page_list') !!}">
        @csrf

        <input type="hidden" name="id" value="{{ $site->id }}">

        @foreach($pages as $page)
            <div class="form-check">
                <input type="checkbox" name="page_id[]" value="{{ $page->id }}"
                       id="check{{ $page->id }}" {{ $site->pages->contains('id', $page->id)?'checked':'' }}>
                <label class="form-check-label" for="check{{ $page->id }}">
                    {{ $page->name }} <span class="badge badge-secondary">{{ $page->url }}</span>
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
