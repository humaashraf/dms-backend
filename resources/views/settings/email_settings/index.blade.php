@extends('layouts.admin')

@section('content')
@section('title', 'Email Settings')

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Email Settings</h5>
        </div>

        <div class="card-body">
                <form action="{{ url('email-settings/update/' . $setting->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">SMTP Host</label>
                    <input type="text" name="smtp_host" value="{{ old('smtp_host', $setting->smtp_host) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username', $setting->username) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" value="{{ old('password', $setting->password) }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">SMTP Secure</label>
                    <input type="text" name="smtp_secure" value="{{ old('smtp_secure', $setting->smtp_secure) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Port</label>
                    <input type="number" name="port" value="{{ old('port', $setting->port) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">From Email</label>
                    <input type="email" name="from_email" value="{{ old('from_email', $setting->from_email) }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
