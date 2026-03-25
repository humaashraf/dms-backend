@extends('layouts.admin')

@section('content')
@section('title', 'Show Users')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">User Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $user->id }}
            </div>
            <div class="mb-3">
                <strong>Name:</strong> {{ $user->name }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $user->email}}
            </div>
            <div class="mb-3">
                <strong>Role:</strong>
                <ul class="mt-2">
                    @forelse ($user->roles as $role)
                        <li>{{ ucwords(str_replace('_', ' ', $role->name)) }}</li>
                    @empty
                        <li class="text-muted">No roles assigned</li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ url('users') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection

