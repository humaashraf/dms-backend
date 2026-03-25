@extends('layouts.admin')

@section('content')
@section('title', 'Users')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif

    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Users</h5>
            @can('user_create')
            <a href="{{ url('users/create') }}" class="btn btn-danger ms-auto m-2">Add new user</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Status</th>
                            @canany(['user_edit', 'user_delete', 'user_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    {{ optional($user->roles->first())->name ?? 'No Role Assigned' }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    <span class="badge {{ $user->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $user->status == 0 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                @canany(['user_edit', 'user_delete', 'user_show'])
                                <td width="200px">
                                    @can('user_show')
                                    <a href="{{ url('users/show/' . $user->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ url('users/edit/' . $user->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('user_delete')
                                    <a href="{{ url('users/delete/' . $user->id) }}" class="text-danger px-3" onclick="return confirm('Delete this User?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No User found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
