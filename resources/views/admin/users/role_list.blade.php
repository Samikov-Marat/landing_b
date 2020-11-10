@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.users.save_role_list') !!}">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
            @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
                           id="check{{ $loop->index }}" {{ $user->roles->contains('id', $role->id)?'checked':'' }}
                           class="form-check-input">
                    <label for="check{{ $loop->index }}" class="form-check-label">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
