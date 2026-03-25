@extends('layouts.admin')

@section('content')
@section('title', 'Create Role')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Roles</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('roles/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                </div>

                {{-- <div class="mt-2">
                    <h3>Permissions</h3>
                    @foreach ($permissions as $permission)
                    <label for=""><input type="checkbox" name="permissions[{{ $permission->name }}]" value="{{ $permission->name }}">{{ $permission->name }}</label>
                    @endforeach
                </div> --}}
                <div class="mt-4">
                    <h5 class="mb-3">Permissions</h5>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="perm_{{ $loop->index }}"
                                        name="permissions[{{ $permission->name }}]"
                                        value="{{ $permission->name }}"
                                        {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="perm_{{ $loop->index }}">
                                        {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('roles') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
