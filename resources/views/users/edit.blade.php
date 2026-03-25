@extends('layouts.admin')

@section('title', 'Edit User')
@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit User</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('users/update/' . $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="First Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Last Name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Username" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone Number" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ old('role', $user->roles->pluck('name')->first()) == $role->name ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="staff" {{ old('type', $user->type) == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="user"  {{ old('type', $user->type) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current" class="form-control">
                    <small class="text-muted">Leave blank if you don't want to change the password.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
