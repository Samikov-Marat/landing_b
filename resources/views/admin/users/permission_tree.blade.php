@extends('admin.layout')

@section('header')
    Дерево разрешений
@endsection


@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.users.index'), 'text' => 'Пользователи'],
        ['text' => 'Дерево разрешений'],
    ]])
@endsection

@section('content')

    <table class="table table-bordered table-hover">
        <tr>
            <th>Пользователь</th>
            <th>Роли</th>
            <th>Разрешения</th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($user->roles as $role)
                            <li>
                                {{ $role->name }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($user->allPermissions as $permission)
                            <li>
                                <strong>{{ $permission->text_id }}</strong> - {{ $permission->name }}
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
