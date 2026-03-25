@extends('layouts.admin')

@section('content')
@section('title', 'Create Users')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Users</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('users/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="First Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="staff" {{ old('type', 'staff') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="user"  {{ old('type') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" class="form-control" required>
                </div>



                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
