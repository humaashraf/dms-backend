@extends('layouts.admin')

@section('content')
@section('title', 'Create Permissions')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Permissions</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('permissions/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('permissions') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
