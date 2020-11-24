@extends('admin.layout')

@section('content')
    @php
        $blockTextId = '';
    @endphp

    <form method="post" action="{!! route('admin.roles.save_permission_list') !!}">
        @csrf
        <input type="hidden" name="id" value="{{ $role->id }}">
        <div class="form-group">
            @foreach($permissions as $permission)
                @php
                    $changeBlock = false;
                    $currentBlockTextId = preg_replace('#.*?\.(.*?)\..*#', '$1', $permission->text_id);
                    if($currentBlockTextId != $blockTextId){
                        $blockTextId = $currentBlockTextId;
                        $changeBlock = true;
                    }
                @endphp
                @if($changeBlock)
                    <h1></h1>
                    <div class="form-check">
                        <input type="checkbox" id="block_{{ $loop->index }}"
                               class="form-check-input js-admin-role-permission-block" data-block="{{ $blockTextId }}">
                        <label for="block_{{ $loop->index }}" class="form-check-label">{{ $blockTextId }}</label>
                    </div>
                @endif

                <div class="form-check">
                    <input type="checkbox" name="permission_text_id[]" value="{{ $permission->text_id }}"
                           id="check{{ $loop->index	}}"
                           {{ $role->permissions->contains('text_id', $permission->text_id)?'checked':'' }}
                           class="form-check-input js-admin-role-permission"
                           data-block="{{ $blockTextId }}">
                    <label for="check{{ $loop->index }}" class="form-check-label">
                        {{ $permission->name }} <span class="badge badge-secondary">{{ $permission->text_id }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
