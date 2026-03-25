@extends('layouts.admin')

@section('content')
@section('title', 'Create Expense Categories')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Expense Category</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('expense-categories/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('expense-categories') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
