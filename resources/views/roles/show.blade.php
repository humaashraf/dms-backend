@extends('layouts.admin')

@section('content')
@section('title', 'Show roles')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Role Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $role->id }}
            </div>
            <div class="mb-3">
                <strong>Name:</strong> {{ $role->name }}
            </div>
            {{-- <strong>Permissions:</strong>
            @foreach ($role->permissions as $permission)
            {{ $permission->name }}
            @endforeach --}}

<div class="mb-3">
    <strong>Permissions:</strong>
    @forelse ($role->permissions->chunk(4) as $chunk)
        <div class="row mt-2">
            @foreach ($chunk as $permission)
                <div class="col-md-2">
                    • {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-muted mt-2">No permissions assigned.</p>
    @endforelse
</div>




            <a href="{{ url('roles') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
