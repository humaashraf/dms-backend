@extends('layouts.admin')

@section('content')
@section('title', 'Edit Payment Methods')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Payment Methods</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('payment-methods/update/' . $method->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $method->name) }}" placeholder="Name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('payment-methods') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
