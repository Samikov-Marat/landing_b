@extends('admin.layout')

@section('content')

    <form method="post" action="{!! route('admin.roles.save_permission_list') !!}">
        @csrf
        <input type="hidden" name="id" value="{{ $role->id }}">
        <div class="form-group">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permission_text_id[]" value="{{ $permission->text_id }}"
                           id="check{{ $loop->index	}}"
                           {{ $role->permissions->contains('text_id', $permission->text_id)?'checked':'' }}
                           class="form-check-input">
                    <label for="check{{ $loop->index }}" class="form-check-label">
                        {{ $permission->name }} <span class="badge badge-secondary">{{ $permission->url }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
