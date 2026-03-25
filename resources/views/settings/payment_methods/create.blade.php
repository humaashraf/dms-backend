@extends('layouts.admin')

@section('content')
@section('title', 'Create Payment Method')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Payment Method</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('payment-methods/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('payment-methods') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
