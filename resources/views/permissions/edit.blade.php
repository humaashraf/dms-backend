@extends('layouts.admin')

@section('content')
@section('title', 'Edit Permissions')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Permissions</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('permissions/update/' . $permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $permission->name) }}" placeholder="Name" class="form-control" required>
                        @error('update_error')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('permissions') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
