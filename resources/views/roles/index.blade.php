@extends('layouts.admin')

@section('content')
@section('title', 'Role')

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
            <h5 class="mx-1 mt-3">Roles</h5>
            @can('roles_create')
            <a href="{{ url('roles/create') }}" class="btn btn-danger ms-auto m-2">Add new Role</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th width="60px">ID</th>
                            <th>Name</th>
                            @canany(['roles_edit', 'roles_delete', 'roles_show'])
                            <th width="200px">Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>

                                @canany(['roles_edit', 'roles_delete', 'roles_show'])
                                <td width="200px">
                                    @can('roles_show')
                                    <a href="{{ url('roles/show/' . $role->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('roles_edit')
                                    <a href="{{ url('roles/edit/' . $role->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('roles_delete')
                                    <a href="{{ url('roles/delete/' . $role->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Role?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
