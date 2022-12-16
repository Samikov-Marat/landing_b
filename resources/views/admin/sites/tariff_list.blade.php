@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.sites.save_tariff_list') !!}">
        @csrf

        <input type="hidden" name="id" value="{{ $site->id }}">
        <div class="form-group">
            @foreach($tariffs as $tariff)
                <div class="form-check">
                    <input type="checkbox" name="tariff_id[]" value="{{ $tariff->id }}"
                           id="check{{ $tariff->id }}" {{ $site->tariffs->contains('id', $tariff->id)?'checked':'' }}
                           class="form-check-input">
                    <label for="check{{ $tariff->id }}" class="form-check-label">
                        {{ $tariff->tariffTexts->pluck('name')->join(', ') }} <span class="badge badge-secondary">{{ $tariff->ek_id }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>


@endsection
