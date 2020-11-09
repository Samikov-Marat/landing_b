@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.sites.save_page_list') !!}">
        @csrf

        <input type="hidden" name="id" value="{{ $site->id }}">
        <div class="form-group">
            @foreach($pages as $page)
                <div class="form-check">
                    <input type="checkbox" name="page_id[]" value="{{ $page->id }}"
                           id="check{{ $page->id }}" {{ $site->pages->contains('id', $page->id)?'checked':'' }}
                           class="form-check-input">
                    <label for="check{{ $page->id }}" class="form-check-label">
                        {{ $page->name }} <span class="badge badge-secondary">{{ $page->url }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
