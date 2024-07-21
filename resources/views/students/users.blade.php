<!-- resources/views/admin/users.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Users</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                <td>{{ implode(', ', $user->permissions->pluck('name')->toArray()) }}</td>
                <td>
                    <form action="{{ route('admin.users.assign-role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="role_name" class="form-control">
                            @foreach(Role::all() as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Assign Role</button>
                    </form>

                    <form action="{{ route('admin.users.remove-role') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="role_name" class="form-control">
                            @foreach($user->roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-danger btn-sm">Remove Role</button>
                    </form>

                    <form action="{{ route('admin.users.give-permission') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="permission_name" class="form-control">
                            @foreach(Permission::all() as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Grant Permission</button>
                    </form>

                    <form action="{{ route('admin.users.revoke-permission') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="permission_name" class="form-control">
                            @foreach($user->permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-danger btn-sm">Revoke Permission</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection