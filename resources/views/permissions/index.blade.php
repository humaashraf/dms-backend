@extends('layouts.admin')

@section('content')
@section('title', 'Permissions')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif

    @if($errors->has('delete_error'))
    <div class="alert alert-danger">
        {{ $errors->first('delete_error') }}
    </div>
@endif

    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Permissions</h5>
            @can('permissions_create')
            <a href="{{ url('permissions/create') }}" class="btn btn-danger ms-auto m-2">Add new Permissions</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Assigned To</th>
                            <th>Created Date</th>
                            @canany(['permissions_edit', 'permissions_delete'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>

                                <td>
                                    @if ($permission->roles->isNotEmpty())
                                        @foreach ($permission->roles as $role)
                                            <span class="badge bg-success">{{ ucwords(str_replace('_', ' ', $role->name)) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <td>{{ $permission->created_at }}</td>

                                @canany(['permissions_edit', 'permissions_delete'])
                                <td width="200px">
                                    @can('permissions_edit')
                                    <a href="{{ url('permissions/edit/' . $permission->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('permissions_delete')
                                    <a href="{{ url('permissions/delete/' . $permission->id) }}" class="text-danger px-3" onclick="return confirm('Delete this permission?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Permissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $permissions->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
