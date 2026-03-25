@extends('layouts.admin')

@section('content')
@section('title', 'Show Donation Categories')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Donation Category Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $category->id }}
            </div>
            <div class="mb-3">
                <strong>Name:</strong> {{ $category->name }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge {{ $category->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                    {{ $category->status == 0 ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <a href="{{ url('donation-categories') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
